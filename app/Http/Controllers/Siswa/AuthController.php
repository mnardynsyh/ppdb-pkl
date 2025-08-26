<?php

namespace App\Http\Controllers\Siswa; // Namespace baru untuk Siswa

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form registrasi siswa.
     */
    public function showRegisterForm()
    {
        $agama = Agama::orderBy('agama')->get();
        return view('auth.register', compact('agama'));
    }

    /**
     * Memproses data registrasi siswa.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email'         => 'required|email|unique:siswa,email',
            'password'      => 'required|min:6|confirmed',
            'nama_lengkap'  => 'required|string|max:255',
            'nik'           => 'required|numeric|digits:16|unique:siswa,nik',
            'nisn'          => 'required|numeric|digits:10|unique:siswa,nisn',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'asal_sekolah'  => 'required|string|max:100',
            'agama_id'      => 'required|exists:agama,id',
        ]);

        Siswa::create([
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'nama_lengkap'  => $request->nama_lengkap,
            'nik'           => $request->nik,
            'nisn'          => $request->nisn,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir'  => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'asal_sekolah'  => $request->asal_sekolah,
            'agama_id'      => $request->agama_id,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menampilkan halaman login khusus untuk Siswa.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses login khusus untuk Siswa.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nisn'     => 'required|numeric|digits:10',
            'password' => 'required',
        ]);

        // Coba login sebagai Siswa (menggunakan guard 'siswa')
        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('siswa.dashboard'));
        }

        // Jika gagal
        return back()->withErrors([
            'nisn' => 'NISN atau password yang Anda masukkan salah.',
        ])->onlyInput('nisn');
    }

    /**
     * Logout untuk siswa.
     */
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
