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

    public function jadwal()
    {
        $jadwals = Jadwal::orderBy('order')->get();
        $pengaturan = Pengaturan::first();
        
        return view('jadwal', compact('jadwals', 'pengaturan'));
    }

    public function kontak()
    {
        $pengaturan = Pengaturan::first();
        return view('kontak', compact('pengaturan'));
    }

    public function about()
    {
        return view('partials.about');
    }

    public function visi()
    {
        return view('partials.visi-misi');
    }

}
