<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan ringkasan data.
     */
    public function index()
    {
        // 1. Mengambil data untuk Kartu Statistik Utama
        $totalPendaftar = Siswa::count();
        $pendaftarPending = Siswa::where('status_pendaftaran', 'Pending')->count();
        $pendaftarDiterima = Siswa::where('status_pendaftaran', 'Diterima')->count();
        $pendaftarDitolak = Siswa::where('status_pendaftaran', 'Ditolak')->count();

        // 2. Mengambil data untuk Grafik Pendaftaran (7 hari terakhir)
        $pendaftaranPerHari = Siswa::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('count(*) as jumlah')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Memformat data agar bisa dibaca oleh Chart.js
        $chartLabels = $pendaftaranPerHari->pluck('tanggal')->map(function ($tanggal) {
            return Carbon::parse($tanggal)->isoFormat('D MMM');
        });
        $chartData = $pendaftaranPerHari->pluck('jumlah');

        // 3. Mengambil data Aktivitas Pendaftar Terbaru (5 terakhir)
        $pendaftarTerbaru = Siswa::latest()->take(5)->get();

        // 4. Mengambil data Ringkasan Pengaturan
        $pengaturan = Pengaturan::first();

        // Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pendaftarPending',
            'pendaftarDiterima',
            'pendaftarDitolak',
            'chartLabels',
            'chartData',
            'pendaftarTerbaru',
            'pengaturan'
        ));
    }
}
