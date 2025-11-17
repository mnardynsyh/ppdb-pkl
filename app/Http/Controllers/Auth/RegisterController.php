<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi siswa.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses penyimpanan data pendaftaran akun siswa.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nisn'             => 'required|digits:10|unique:siswa,nisn',
            'nik'              => 'required|digits:16|unique:siswa,nik',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|in:L,P',
            'email'            => 'required|email|max:255|unique:siswa,email',
            'password'         => 'required|min:6|confirmed',
        ], 
        [
            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $siswa = Siswa::create([
            'nama_lengkap'   => trim($validated['nama_lengkap']),
            'nisn'           => trim($validated['nisn']),
            'nik'            => trim($validated['nik']), // TAMBAHKAN INI
            'tanggal_lahir'  => $validated['tanggal_lahir'],
            'jenis_kelamin'  => $validated['jenis_kelamin'],
            'email'          => strtolower(trim($validated['email'])),
            'password'       => Hash::make($validated['password']),
            'status_pendaftaran' => 'Pending',
        ]);

        Auth::guard('siswa')->login($siswa);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}