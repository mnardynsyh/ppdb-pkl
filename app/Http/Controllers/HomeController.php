<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $jadwals = Jadwal::orderBy('order')->get();

        return view('dashboard', compact('jadwals'));
    }
}