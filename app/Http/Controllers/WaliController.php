<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliController extends Controller
{
    // Form Registrasi
    public function create()
    {
        return view('auth.register');
    }

    // Proses Registrasi
    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'email'     => 'required|email|unique:wali,email',
            'password'  => 'required|min:6|confirmed',
            'no_hp'     => 'nullable|string|max:20',
            'alamat'    => 'nullable|string',
        ]);

        Wali::create([
            'nama_wali' => $request->nama_wali,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'no_hp'     => $request->no_hp,
            'alamat'    => $request->alamat,
        ]);

        return redirect()->route('auth.login')->with('success', 'Akun wali berhasil dibuat, silakan login.');
    }
}
