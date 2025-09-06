<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman depan (landing page).
     */
    public function index()
    {
        // Hanya mengambil data pengaturan untuk halaman depan
        $pengaturan = Pengaturan::first();
        return view('home', compact('pengaturan'));
    }

    /**
     * Menampilkan halaman jadwal pendaftaran.
     */
    public function jadwal()
    {
        // Mengambil data jadwal dari database
        $jadwals = Jadwal::orderBy('order')->get();
        return view('jadwal', compact('jadwals'));
    }
}

