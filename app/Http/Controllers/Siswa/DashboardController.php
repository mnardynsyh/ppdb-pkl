<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Agama;
use App\Models\Siswa;
use App\Models\Pendidikan;
use App\Models\Penghasilan;
use App\Models\OrangTuaWali;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Job as Pekerjaan;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pendaftaran siswa.
     */
    public function index()
    {
        // Mengambil data siswa yang sedang login beserta relasi orangTuaWali
        $siswa = Siswa::with('orangTuaWali')->find(Auth::id());

        // Mengambil data yang diperlukan untuk dropdown/select options
        $agamas = Agama::all();
        $pendidikans = Pendidikan::all();
        $pekerjaans = Pekerjaan::all();
        $penghasilans = Penghasilan::all();

        // Mengirim data ke view
        return view('siswa.dashboard', compact(
            'siswa',
            'agamas',
            'pendidikans',
            'pekerjaans',
            'penghasilans'
        ));
    }

    /**
     * Menyimpan atau memperbarui data pendaftaran siswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Step 1: Data Diri Siswa
            'nama_lengkap'    => 'required|string|max:255',
            'nik'             => ['required', 'string', 'digits:16', Rule::unique('siswa')->ignore(Auth::id())],
            'nisn'            => ['required', 'string', 'digits:10', Rule::unique('siswa')->ignore(Auth::id())],
            'jenis_kelamin'   => 'required|in:L,P',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'agama_id'        => 'required|exists:agama,id',
            'anak_ke'         => 'nullable|integer|min:1',
            'alamat'          => 'required|string',

            // Step 2: Data Orang Tua / Wali
            'nama_ayah'             => 'required|string|max:255',
            'nik_ayah'              => 'required|string|digits:16',
            'tempat_lahir_ayah'     => 'required|string|max:100',
            'tanggal_lahir_ayah'    => 'required|date',
            'pekerjaan_ayah_id'     => 'required|exists:job,id',
            'penghasilan_ayah_id'   => 'required|exists:penghasilan,id',
            'pendidikan_ayah_id'    => 'required|exists:pendidikan,id',
            'agama_ayah_id'         => 'required|exists:agama,id',
            
            'nama_ibu'              => 'required|string|max:255',
            'nik_ibu'               => 'required|string|digits:16',
            'tempat_lahir_ibu'      => 'required|string|max:100',
            'tanggal_lahir_ibu'     => 'required|date',
            'pekerjaan_ibu_id'      => 'required|exists:job,id',
            'penghasilan_ibu_id'    => 'required|exists:penghasilan,id',
            'pendidikan_ibu_id'     => 'required|exists:pendidikan,id',
            'agama_ibu_id'          => 'required|exists:agama,id',
            
            // Wali (Opsional, validasi 'nullable' atau 'required_if')
            'nama_wali'             => 'nullable|string|max:255',
            'nik_wali'              => 'nullable|string|digits:16',
            // ... validasi untuk wali lainnya ...

            // Step 3: Sekolah Asal
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus'  => 'required|digits:4|integer|min:2000',
            
            // Step 4: Dokumen (validasi file)
            'pas_foto'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
            // ... validasi untuk file lainnya ...
        ]);

        $siswa = Siswa::find(Auth::id());

        // --- 2. Proses Upload File (jika ada) ---
        $pasFotoPath = $siswa->pas_foto;
        if ($request->hasFile('pas_foto')) {
            // Hapus file lama jika ada
            // if($siswa->pas_foto) { Storage::disk('public')->delete($siswa->pas_foto); }
            $pasFotoPath = $request->file('pas_foto')->store('pas_foto', 'public');
        }

        // --- 3. Update Data Siswa (Step 1 & 3) ---
        $siswa->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'nik'           => $request->nik,
            'nisn'          => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama_id'      => $request->agama_id,
            'anak_ke'       => $request->anak_ke,
            'alamat'        => $request->alamat,
            'asal_sekolah'  => $request->asal_sekolah,
            'tahun_lulus'   => $request->tahun_lulus,
            'pas_foto'      => $pasFotoPath,
        ]);
        
        // --- 4. Update/Create Data Ortu/Wali (Step 2) ---
        OrangTuaWali::updateOrCreate(
            ['siswa_id' => $siswa->id], // Kunci untuk mencari record
            [ // Data yang akan diisi/diperbarui
                'nama_ayah'             => $request->nama_ayah,
                'nik_ayah'              => $request->nik_ayah,
                'tempat_lahir_ayah'     => $request->tempat_lahir_ayah,
                'tanggal_lahir_ayah'    => $request->tanggal_lahir_ayah,
                'pekerjaan_ayah_id'     => $request->pekerjaan_ayah_id,
                'penghasilan_ayah_id'   => $request->penghasilan_ayah_id,
                'pendidikan_ayah_id'    => $request->pendidikan_ayah_id,
                'agama_ayah_id'         => $request->agama_ayah_id,
                'nama_ibu'              => $request->nama_ibu,
                'nik_ibu'               => $request->nik_ibu,
                'tempat_lahir_ibu'      => $request->tempat_lahir_ibu,
                'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                'pekerjaan_ibu_id'      => $request->pekerjaan_ibu_id,
                'penghasilan_ibu_id'    => $request->penghasilan_ibu_id,
                'pendidikan_ibu_id'     => $request->pendidikan_ibu_id,
                'agama_ibu_id'          => $request->agama_ibu_id,
                'nama_wali'             => $request->nama_wali,
                // ...Lengkapi field wali lainnya
            ]
        );

        return redirect()->route('siswa.dashboard')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }
}

