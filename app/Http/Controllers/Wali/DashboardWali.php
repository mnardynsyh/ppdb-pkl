<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWali extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard wali
        return view('wali.dashboard');
    }
}
