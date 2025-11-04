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
    $sliders = \App\Models\Slider::where('is_active', true)
                ->orderBy('order')
                ->get();

    return view('home', compact('pengaturan', 'sliders'));
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
}

