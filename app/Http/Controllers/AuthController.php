<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('siswa.register');
    }

    
    public function register(Request $request)
    {
        $request->validate([
            'email'         => 'required|email|unique:siswa,email',
            'password'      => 'required|min:5',
            'nik'           => 'required|unique:siswa,nik',
            'nisn'          => 'required|unique:siswa,nisn',
            'nama_lengkap'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
        ]);

        
        $siswa = Siswa::create([
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'nik'           => $request->nik,
            'nisn'          => $request->nisn,
            'nama_lengkap'  => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir'  => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'status_pendaftaran' => 'pending'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Login Admin
        if (Auth::guard('web')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin');
        }

        // Login Siswa
        if (Auth::guard('siswa')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) {
            $request->session()->regenerate();
            return redirect()->route('siswa.dashboard')->with('success', 'Login berhasil sebagai Siswa');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
