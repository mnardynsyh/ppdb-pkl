<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalPendaftar = Siswa::count();
        $pendaftarPending = Siswa::where('status_pendaftaran', 'Pending')->count();
        $pendaftarDiterima = Siswa::where('status_pendaftaran', 'Diterima')->count();
        $pendaftarDitolak = Siswa::where('status_pendaftaran', 'Ditolak')->count();


        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(29);

        $dataHarian = Siswa::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $chartLabels = [];
        $chartData = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');
            
            $chartLabels[] = $date->isoFormat('D MMM');
            $chartData[] = $dataHarian->get($formattedDate, 0);
        }

        $pendaftarTerbaru = Siswa::latest()
            ->take(5)
            ->get();

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