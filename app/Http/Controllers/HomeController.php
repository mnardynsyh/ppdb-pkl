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
        $pengaturan = Pengaturan::first();
        return view('home', compact('pengaturan'));
    }

    /**
     * [PENTING] Menampilkan halaman jadwal pendaftaran yang terpisah.
     * Metode ini mengambil data jadwal dan juga data pengaturan untuk banner status.
     */
    public function jadwal()
    {
        $jadwals = Jadwal::orderBy('order')->get();
        $pengaturan = Pengaturan::first();
        
        return view('jadwal', compact('jadwals', 'pengaturan'));
    }

    public function kontak()
    {
        return view('kontak');
    }
}

