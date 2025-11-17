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
        $agamaOptions = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        return view('auth.register', compact('agamaOptions'));
    }

    /**
     * Proses penyimpanan data pendaftaran akun siswa.
     */
    public function register(Request $request)
    {
 
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nik'              => 'required|digits:16|unique:siswa,nik',
            'nisn'             => 'required|digits:10|unique:siswa,nisn',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|in:L,P',
            'agama'            => 'required|string',
            'asal_sekolah'     => 'required|string|max:255',
            'alamat'           => 'required|string',
            'email'            => 'required|email|max:255|unique:siswa,email',
            'password'         => 'required|min:6|confirmed',
        ]);

        $siswa = Siswa::create([
            'nama_lengkap'   => trim($validated['nama_lengkap']),
            'nik'            => trim($validated['nik']),
            'nisn'           => trim($validated['nisn']),
            'tempat_lahir'   => trim($validated['tempat_lahir']),
            'tanggal_lahir'  => $validated['tanggal_lahir'],
            'jenis_kelamin'  => $validated['jenis_kelamin'],
            'agama'          => $validated['agama'],
            'asal_sekolah'   => trim($validated['asal_sekolah']),
            'alamat'         => trim($validated['alamat']),
            'email'          => strtolower($validated['email']),
            'password'       => Hash::make($validated['password']),
        ]);


        Auth::guard('siswa')->login($siswa);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
        
}

