<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi siswa.
     */
    public function showRegisterForm()
    {
        $agamaOptions = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        return view('auth.register-siswa', compact('agamaOptions'));
    }

    /**
     * Proses penyimpanan data pendaftaran akun siswa.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:siswa,nik',
            'nisn' => 'required|digits:10|unique:siswa,nisn',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255|unique:siswa,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Siswa::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
