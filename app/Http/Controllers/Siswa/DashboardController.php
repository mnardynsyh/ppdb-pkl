<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Agama;
use App\Models\Siswa;
use App\Models\Pendidikan;
use App\Models\Penghasilan;
use App\Models\OrangTuaWali;
use Illuminate\Http\Request;
use App\Models\Lampiran;
use Illuminate\Validation\Rule;
use App\Models\Job as Pekerjaan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pendaftaran siswa.
     */
    public function index()
    {
        // Mengambil data siswa yang sedang login beserta semua relasi yang diperlukan
        $siswa = Siswa::with(['orangTuaWali', 'lampiran'])->find(Auth::id());

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
        // --- 1. Validasi Semua Input dari Step 1-4 ---
        $validated = $request->validate([
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
            'nik_ayah'              => ['required', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_ayah')->ignore(Auth::user()->orangTuaWali->id ?? null)],
            'tempat_lahir_ayah'     => 'required|string|max:100',
            'tanggal_lahir_ayah'    => 'required|date',
            'pekerjaan_ayah_id'     => 'required|exists:job,id',
            'penghasilan_ayah_id'   => 'required|exists:penghasilan,id',
            'pendidikan_ayah_id'    => 'required|exists:pendidikan,id',
            'agama_ayah_id'         => 'required|exists:agama,id',
            'nama_ibu'              => 'required|string|max:255',
            'nik_ibu'               => ['required', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_ibu')->ignore(Auth::user()->orangTuaWali->id ?? null)],
            'tempat_lahir_ibu'      => 'required|string|max:100',
            'tanggal_lahir_ibu'     => 'required|date',
            'pekerjaan_ibu_id'      => 'required|exists:job,id',
            'penghasilan_ibu_id'    => 'required|exists:penghasilan,id',
            'pendidikan_ibu_id'     => 'required|exists:pendidikan,id',
            'agama_ibu_id'          => 'required|exists:agama,id',
            'tinggal_dengan_wali'   => 'nullable|string',
            'nama_wali'             => 'required_if:tinggal_dengan_wali,on|nullable|string|max:255',
            'nik_wali'              => ['required_if:tinggal_dengan_wali,on', 'nullable', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_wali')->ignore(Auth::user()->orangTuaWali->id ?? null)],
            'tempat_lahir_wali'     => 'required_if:tinggal_dengan_wali,on|nullable|string|max:100',
            'tanggal_lahir_wali'    => 'required_if:tinggal_dengan_wali,on|nullable|date',
            'pekerjaan_wali_id'     => 'required_if:tinggal_dengan_wali,on|nullable|exists:job,id',
            'penghasilan_wali_id'   => 'required_if:tinggal_dengan_wali,on|nullable|exists:penghasilan,id',
            'pendidikan_wali_id'    => 'required_if:tinggal_dengan_wali,on|nullable|exists:pendidikan,id',
            'agama_wali_id'         => 'required_if:tinggal_dengan_wali,on|nullable|exists:agama,id',

            // Step 3: Sekolah Asal
            'asal_sekolah'          => 'required|string|max:255',
            'alamat_sekolah_asal'   => 'nullable|string',
            'tahun_lulus'           => 'required|digits:4|integer|min:2000',

            // Step 4: Berkas Lampiran
            'berkas'                    => 'nullable|array',
            'berkas.pas_foto'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'berkas.kartu_keluarga'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'berkas.ijazah'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $siswa = Siswa::find(Auth::id());

        // --- 2. Update Data Siswa (Step 1 & 3) ---
        $siswa->update([
            'nama_lengkap'          => $validated['nama_lengkap'],
            'nik'                   => $validated['nik'],
            'nisn'                  => $validated['nisn'],
            'jenis_kelamin'         => $validated['jenis_kelamin'],
            'tempat_lahir'          => $validated['tempat_lahir'],
            'tanggal_lahir'         => $validated['tanggal_lahir'],
            'agama_id'              => $validated['agama_id'],
            'anak_ke'               => $validated['anak_ke'] ?? null,
            'alamat'                => $validated['alamat'],
            'asal_sekolah'          => $validated['asal_sekolah'],
            'alamat_sekolah_asal'   => $validated['alamat_sekolah_asal'] ?? null,
            'tahun_lulus'           => $validated['tahun_lulus'],
        ]);

        // --- 3. Update/Create Data Ortu/Wali (Step 2) ---
        $dataWali = $request->has('tinggal_dengan_wali') ? [
            'nama_wali'             => $validated['nama_wali'],
            'nik_wali'              => $validated['nik_wali'],
            'tempat_lahir_wali'     => $validated['tempat_lahir_wali'],
            'tanggal_lahir_wali'    => $validated['tanggal_lahir_wali'],
            'pekerjaan_wali_id'     => $validated['pekerjaan_wali_id'],
            'penghasilan_wali_id'   => $validated['penghasilan_wali_id'],
            'pendidikan_wali_id'    => $validated['pendidikan_wali_id'],
            'agama_wali_id'         => $validated['agama_wali_id'],
        ] : array_fill_keys(['nama_wali', 'nik_wali', 'tempat_lahir_wali', 'tanggal_lahir_wali', 'pekerjaan_wali_id', 'penghasilan_wali_id', 'pendidikan_wali_id', 'agama_wali_id'], null);

        OrangTuaWali::updateOrCreate(
            ['siswa_id' => $siswa->id],
            array_merge([
                'nama_ayah'             => $validated['nama_ayah'],
                'nik_ayah'              => $validated['nik_ayah'],
                'tempat_lahir_ayah'     => $validated['tempat_lahir_ayah'],
                'tanggal_lahir_ayah'    => $validated['tanggal_lahir_ayah'],
                'pekerjaan_ayah_id'     => $validated['pekerjaan_ayah_id'],
                'penghasilan_ayah_id'   => $validated['penghasilan_ayah_id'],
                'pendidikan_ayah_id'    => $validated['pendidikan_ayah_id'],
                'agama_ayah_id'         => $validated['agama_ayah_id'],
                'nama_ibu'              => $validated['nama_ibu'],
                'nik_ibu'               => $validated['nik_ibu'],
                'tempat_lahir_ibu'      => $validated['tempat_lahir_ibu'],
                'tanggal_lahir_ibu'     => $validated['tanggal_lahir_ibu'],
                'pekerjaan_ibu_id'      => $validated['pekerjaan_ibu_id'],
                'penghasilan_ibu_id'    => $validated['penghasilan_ibu_id'],
                'pendidikan_ibu_id'     => $validated['pendidikan_ibu_id'],
                'agama_ibu_id'          => $validated['agama_ibu_id'],
            ], $dataWali)
        );

        // --- 4. Proses Upload Berkas (Step 4) ---
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $jenisBerkas => $file) {
                // Cari data berkas lama
                $berkasLama = Lampiran::where('siswa_id', $siswa->id)
                                            ->where('jenis_berkas', $jenisBerkas)
                                            ->first();

                // Hapus file lama dari storage jika ada
                if ($berkasLama && Storage::disk('public')->exists($berkasLama->path_file)) {
                    Storage::disk('public')->delete($berkasLama->path_file);
                }

                // Simpan file baru dan dapatkan path-nya
                $path = $file->store("berkas_siswa/{$siswa->id}", 'public');

                // Update atau buat record baru di database
                Lampiran::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'jenis_berkas' => $jenisBerkas,
                    ],
                    [
                        'path_file' => $path,
                        'nama_file_asli' => $file->getClientOriginalName(),
                    ]
                );
            }
        }

        return redirect()->route('siswa.dashboard')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }
}

