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
        $totalPendaftar = Siswa::count();
        $pendaftarPending = Siswa::where('status_pendaftaran', 'Pending')->count();
        $pendaftarDiterima = Siswa::where('status_pendaftaran', 'Diterima')->count();
        $pendaftarDitolak = Siswa::where('status_pendaftaran', 'Ditolak')->count();

        $pendaftaranPerHari = Siswa::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('count(*) as jumlah')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $chartLabels = $pendaftaranPerHari->pluck('tanggal')->map(function ($tanggal) {
            return Carbon::parse($tanggal)->isoFormat('D MMM');
        });
        $chartData = $pendaftaranPerHari->pluck('jumlah');

        $pendaftarTerbaru = Siswa::latest()->take(5)->get();

        $pengaturan = Pengaturan::first();

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
