<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranRequest;
use App\Services\PendaftaranService;
use App\Models\Siswa;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FormulirController extends Controller
{
    /**
     * Opsi-opsi statis untuk dropdown form.
     */
    private array $agama = [
        'Islam', 'Kristen', 'Katolik', 
        'Hindu', 'Buddha', 'Konghucu'
    ];
    
    private array $pendidikan = [
        'Tidak Sekolah', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat',
        'Diploma (D1/D2/D3)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)'
    ];
    
    private array $penghasilan = [
        '< Rp 1 juta', 'Rp 1–3 juta', 'Rp 3–5 juta', 
        '> Rp 5 juta', 'Tidak Berpenghasilan'
    ];
    
    private array $pekerjaan = [
        'PNS', 'TNI/POLRI', 'Karyawan Swasta', 'Wiraswasta', 'Petani',
        'Buruh', 'Guru/Dosen', 'Nelayan', 'Tidak Bekerja'
    ];

    /**
     * Menampilkan halaman formulir pendaftaran.
     */
    public function showForm()
    {
        // 1. Ambil data siswa jika sudah pernah mendaftar (untuk mode edit)
        $siswa = Siswa::with(['orangTua', 'lampiran', 'sekolahAsal'])
            ->where('user_id', Auth::id())
            ->first();

        // Jika belum ada data, buat instance kosong agar form tidak error saat akses property
        $siswa = $siswa ?? new Siswa();

        $provinsi = Provinsi::orderBy('nama')->get();

        // 3. Return view dengan semua data yang dibutuhkan
        return view('siswa.form-pendaftaran', [
            'siswa'             => $siswa,
            'provinsi'          => $provinsi,
            'agamaOptions'      => $this->agama,
            'pendidikanOptions' => $this->pendidikan,
            'penghasilanOptions'=> $this->penghasilan,
            'pekerjaanOptions'  => $this->pekerjaan,
        ]);
    }

    /**
     * Memproses penyimpanan data pendaftaran (Store/Update).
     * * @param StorePendaftaranRequest $request (Menangani Validasi)
     * @param PendaftaranService $service (Menangani Logika Database & File)
     */
    public function store(StorePendaftaranRequest $request, PendaftaranService $service)
    {
        try {
            // ambil data yang sudah lolos validasi saja
            $validatedData = $request->validated();
            
            // Ambil file (jika ada upload baru), null safe
            $files = $request->file('berkas') ?? [];

            // Panggil Service untuk menyimpan ke database (Transaction terjadi di dalam service)
            $service->handleRegistration($validatedData, $files);

            return redirect()
                ->route('siswa.dashboard')
                ->with('success', 'Data pendaftaran berhasil disimpan. Silakan tunggu verifikasi admin.');

        } catch (\Exception $e) {
            // Log error untuk developer (storage/logs/laravel.log)
            Log::error('Gagal menyimpan pendaftaran user ID ' . Auth::id() . ': ' . $e->getMessage());

            // Redirect kembali ke form dengan input sebelumnya + pesan error
            return back()
                ->withInput() // Mengembalikan input user agar tidak perlu ketik ulang semua
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
}