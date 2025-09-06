<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $jadwals = Jadwal::orderBy('order')->get();
        $pengaturan = Pengaturan::first();

        return view('dashboard', compact('jadwals', 'pengaturan'));
    }
}