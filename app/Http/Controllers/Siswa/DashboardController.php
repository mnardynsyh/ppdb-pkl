<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use App\Models\Pengaturan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    /** Helper untuk mengambil data siswa yang sedang login */
    private function getSiswa()
    {
        return Siswa::with(['orangTua', 'lampiran', 'sekolahAsal', 'provinsi', 'kabupaten', 'kecamatan', 'desa'])
            ->where('user_id', Auth::id())
            ->first();
    }

    public function index()
    {
        $siswa = $this->getSiswa();
        $pengaturan = Pengaturan::first();
        $statusPendaftaran = $pengaturan ? $pengaturan->getStatusDetails() : null;

        // 1. Cek jika Pendaftaran DITUTUP
        if ($statusPendaftaran && $statusPendaftaran['status'] === 'Ditutup') {
            $statusSiswa = $siswa ? $siswa->status_pendaftaran : null;

            // Hanya siswa 'Diterima' yang boleh akses dashboard saat tutup.
            if ($statusSiswa !== 'Diterima') {
                return view('siswa.pendaftaran-ditutup', [
                    'pengaturan' => $pengaturan,
                    'status' => $statusPendaftaran,
                ]);
            }
        }

        // LOGIKA UTAMA
        if (!$siswa) {
            return redirect()->route('siswa.formulir')
                ->with('info', 'Silakan lengkapi data pendaftaran Anda terlebih dahulu.');
        }

        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'pengaturan' => $pengaturan,
        ]);
    }

    /** * Menampilkan Detail Biodata Siswa (Read Only)
     */
    public function showDetail()
    {
        $siswa = $this->getSiswa();

        if (!$siswa) {
            return redirect()->route('siswa.formulir');
        }
        return view('partials.siswa.detail-siswa', compact('siswa'));
    }

    /** * Mencetak Bukti Pendaftaran (PDF)
     */
    public function cetakBukti()
    {
        $siswa = $this->getSiswa();

        if (!$siswa || $siswa->status_pendaftaran !== 'Diterima') {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Belum dapat mencetak bukti. Status harus Diterima.');
        }

        $pdf = Pdf::loadView('siswa.cetak-bukti', compact('siswa'));
        return $pdf->stream('bukti-pendaftaran-' . $siswa->nisn . '.pdf');
    }
}