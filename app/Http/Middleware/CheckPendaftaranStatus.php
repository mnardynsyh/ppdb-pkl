<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class CheckPendaftaranStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $pengaturan = Pengaturan::first();
        $sekarang = Carbon::now();

        // Kondisi 1: Admin menutup pendaftaran secara manual
        if (!$pengaturan || $pengaturan->status === 'Ditutup') {
            return redirect()->route('home')->with('error', 'Pendaftaran saat ini sedang ditutup.');
        }

        // Kondisi 2: Pendaftaran belum dibuka sesuai jadwal
        if ($pengaturan->tanggal_buka && $sekarang->isBefore($pengaturan->tanggal_buka)) {
             return redirect()->route('home')->with('error', 'Pendaftaran belum dibuka. Akan dibuka pada tanggal ' . Carbon::parse($pengaturan->tanggal_buka)->isoFormat('D MMMM YYYY') . '.');
        }

        // Kondisi 3: Pendaftaran sudah ditutup sesuai jadwal
        if ($pengaturan->tanggal_tutup && $sekarang->isAfter($pengaturan->tanggal_tutup)) {
            return redirect()->route('home')->with('error', 'Periode pendaftaran telah berakhir.');
        }

        // Jika semua kondisi terpenuhi, izinkan akses ke halaman registrasi
        return $next($request);
    }
}
