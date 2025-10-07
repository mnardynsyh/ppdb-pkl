<?php

namespace App\Http\Controllers\Siswa;

use Barryvdh\DomPDF\Facade\Pdf;
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
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pendaftaran atau halaman status.
     */
    public function index()
    {
        $siswa = Siswa::with('orangTuaWali')->find(Auth::id());

        if (!$siswa->orangTuaWali) {
            return redirect()->route('siswa.formulir');
        }

        return view('siswa.dashboard', compact('siswa'));
    }

    /**
     * Menampilkan formulir pendaftaran (multi-step).
     */
    public function showForm(): View
    {
        $siswa = Siswa::with(['orangTuaWali', 'lampiran'])->find(Auth::id());
        
        $agamas = Agama::all();
        $pendidikans = Pendidikan::all();
        $pekerjaans = Pekerjaan::all();
        $penghasilans = Penghasilan::all();

        return view('siswa.form-pendaftaran', compact('siswa', 'agamas', 'pendidikans', 'pekerjaans', 'penghasilans'));
    }

    /**
     * Menampilkan halaman detail status pendaftaran.
     */
    public function showStatus(): View
    {
        $siswa = Siswa::with([
            'agama', 'lampiran',
            'orangTuaWali.agamaAyah', 'orangTuaWali.pekerjaanAyah', 'orangTuaWali.pendidikanAyah', 'orangTuaWali.penghasilanAyah',
            'orangTuaWali.agamaIbu', 'orangTuaWali.pekerjaanIbu', 'orangTuaWali.pendidikanIbu', 'orangTuaWali.penghasilanIbu',
            'orangTuaWali.agamaWali', 'orangTuaWali.pekerjaanWali', 'orangTuaWali.pendidikanWali', 'orangTuaWali.penghasilanWali'
        ])->find(Auth::id());
        
        return view('siswa.status', compact('siswa'));
    }

    /**
     * Menyimpan atau memperbarui data pendaftaran siswa.
     */
    public function store(Request $request)
    {
        $orangTuaWaliId = Auth::user()->orangTuaWali->id ?? null;

        // --- 1. Validasi Semua Input dengan Pesan & Atribut Bahasa Indonesia ---
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
            'provinsi_id'     => 'required|string|max:2',
            'kabupaten_id'    => 'required|string|max:4',
            'kecamatan_id'    => 'required|string|max:7',

            // Step 2: Data Orang Tua / Wali
            'nama_ayah'             => 'required|string|max:255',
            'nik_ayah'              => ['required', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_ayah')->ignore($orangTuaWaliId)],
            'tempat_lahir_ayah'     => 'required|string|max:100',
            'tanggal_lahir_ayah'    => 'required|date',
            'pekerjaan_ayah_id'     => 'required|exists:job,id',
            'penghasilan_ayah_id'   => 'required|exists:penghasilan,id',
            'pendidikan_ayah_id'    => 'required|exists:pendidikan,id',
            'agama_ayah_id'         => 'required|exists:agama,id',
            'nama_ibu'              => 'required|string|max:255',
            'nik_ibu'               => ['required', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_ibu')->ignore($orangTuaWaliId)],
            'tempat_lahir_ibu'      => 'required|string|max:100',
            'tanggal_lahir_ibu'     => 'required|date',
            'pekerjaan_ibu_id'      => 'required|exists:job,id',
            'penghasilan_ibu_id'    => 'required|exists:penghasilan,id',
            'pendidikan_ibu_id'     => 'required|exists:pendidikan,id',
            'agama_ibu_id'          => 'required|exists:agama,id',
            'tinggal_dengan_wali'   => 'nullable|string',
            'nama_wali'             => 'required_if:tinggal_dengan_wali,on|nullable|string|max:255',
            'nik_wali'              => ['required_if:tinggal_dengan_wali,on', 'nullable', 'string', 'digits:16', Rule::unique('orang_tua_wali', 'nik_wali')->ignore($orangTuaWaliId)],
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

            // Step 4: Berkas Lampiran (Gunakan wildcard untuk aturan yang sama)
            'berkas'                    => 'nullable|array',
            'berkas.*'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
        ], 
        // [BARU] Array untuk pesan custom dalam Bahasa Indonesia
        [
            'required' => 'Kolom :attribute wajib diisi.',
            'string'   => 'Kolom :attribute harus berupa teks.',
            'digits'   => ':attribute harus terdiri dari :digits digit.',
            'unique'   => ':attribute ini sudah terdaftar.',
            'date'     => 'Format :attribute tidak valid.',
            'integer'  => 'Kolom :attribute harus berupa angka.',
            'max'      => ':attribute tidak boleh lebih dari :max karakter.',
            'min'      => ':attribute minimal :min.',
            'file'     => ':attribute harus berupa file.',
            'mimes'    => ':attribute harus berformat: :values.',
            'berkas.*.max' => 'Ukuran file :attribute tidak boleh lebih dari 2MB.',
        ], 
        // [BARU] Array untuk mengganti nama atribut dalam pesan error
        [
            'nama_lengkap'    => 'Nama Lengkap Siswa',
            'nik'             => 'NIK Siswa',
            'nisn'            => 'NISN',
            'jenis_kelamin'   => 'Jenis Kelamin',
            'tempat_lahir'    => 'Tempat Lahir Siswa',
            'tanggal_lahir'   => 'Tanggal Lahir Siswa',
            'agama_id'        => 'Agama Siswa',
            'anak_ke'         => 'Anak Ke-',
            'alamat'          => 'Alamat Siswa',
            'provinsi_id'     => 'Provinsi',
            'kabupaten_id'    => 'Kabupaten/Kota',
            'kecamatan_id'    => 'Kecamatan',
            'nama_ayah'       => 'Nama Ayah',
            'nik_ayah'        => 'NIK Ayah',
            'pekerjaan_ayah_id' => 'Pekerjaan Ayah',
            'pendidikan_ayah_id' => 'Pendidikan Ayah',
            'penghasilan_ayah_id' => 'Penghasilan Ayah',
            'agama_ayah_id' => 'Agama Ayah',
            'nama_ibu'        => 'Nama Ibu',
            'nik_ibu'         => 'NIK Ibu',
            'pekerjaan_ibu_id' => 'Pekerjaan Ibu',
            'pendidikan_ibu_id' => 'Pendidikan Ibu',
            'penghasilan_ibu_id' => 'Penghasilan Ibu',
            'agama_ibu_id' => 'Agama Ibu',
            'nama_wali'       => 'Nama Wali',
            'nik_wali'        => 'NIK Wali',
            'asal_sekolah'    => 'Asal Sekolah',
            'tahun_lulus'     => 'Tahun Lulus',
            'berkas.pas_foto' => 'Pas Foto',
            'berkas.kartu_keluarga' => 'Kartu Keluarga',
            'berkas.ijazah' => 'Ijazah/SKL',
            'berkas.akta_kelahiran' => 'Akta Kelahiran',
            'berkas.ktp_ortu' => 'KTP Orang Tua',
            'berkas.afirmasi' => 'Dokumen Afirmasi',
            'berkas.sertifikat_prestasi' => 'Sertifikat Prestasi',
            'berkas.nilai_rapor' => 'Nilai Rapor',
            'berkas.pindah_tugas' => 'SK Pindah Tugas',
        ]);

        $siswa = Siswa::find(Auth::id());

        // --- 2. Update Data Siswa ---
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
            'provinsi_id'           => $validated['provinsi_id'],
            'kabupaten_id'          => $validated['kabupaten_id'],
            'kecamatan_id'          => $validated['kecamatan_id'],
            'asal_sekolah'          => $validated['asal_sekolah'],
            'alamat_sekolah_asal'   => $validated['alamat_sekolah_asal'] ?? null,
            'tahun_lulus'           => $validated['tahun_lulus'],
        ]);

        // --- 3. Update/Create Data Ortu/Wali ---
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
        
        // --- 4. Proses Upload Berkas ---
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $jenisBerkas => $file) {
                $berkasLama = Lampiran::where('siswa_id', $siswa->id)
                                        ->where('jenis_berkas', $jenisBerkas)
                                        ->first();
                if ($berkasLama && Storage::disk('public')->exists($berkasLama->path_file)) {
                    Storage::disk('public')->delete($berkasLama->path_file);
                }
                $path = $file->store("berkas_siswa/{$siswa->id}", 'public');
                Lampiran::updateOrCreate(
                    ['siswa_id' => $siswa->id, 'jenis_berkas' => $jenisBerkas],
                    ['path_file' => $path, 'nama_file_asli' => $file->getClientOriginalName()]
                );
            }
        }
        return redirect()->route('siswa.dashboard')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }

    public function cetakBukti()
    {
        $siswa = Siswa::with(['agama', 'orangTuaWali'])->find(Auth::id());
        if ($siswa->status_pendaftaran !== 'Diterima') {
            return redirect()->route('siswa.dashboard')->with('error', 'Anda tidak dapat mencetak bukti pendaftaran saat ini.');
        }
        $pdf = PDF::loadView('siswa.cetak-bukti', compact('siswa'));
        $fileName = 'bukti-pendaftaran-' . str_replace(' ', '-', strtolower($siswa->nama_lengkap)) . '.pdf';
        return $pdf->stream($fileName);
    }
}

