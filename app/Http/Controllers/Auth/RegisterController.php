<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Validasi input
        $validated = $request->validate([
            // Akun login
            'email'            => 'required|email|max:255|unique:users,email',
            'password'         => 'required|min:6|confirmed',

            // Biodata siswa
            'nama_lengkap'     => 'required|string|max:255',
            'nisn'             => 'required|digits:10|unique:siswa,nisn',
            'nik'              => 'required|digits:16|unique:siswa,nik',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|in:L,P',
        ], 
        [
            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nik.digits'  => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique'  => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat akun login siswa (tabel users)
            $user = User::create([
                'name'      => trim($validated['nama_lengkap']),
                'email'     => strtolower(trim($validated['email'])),
                'password'  => Hash::make($validated['password']),
                'role_id'   => 2, // siswa
            ]);

            // 2. Buat biodata siswa (tabel siswa)
            Siswa::create([
                'user_id'          => $user->id,
                'nama_lengkap'     => trim($validated['nama_lengkap']),
                'nisn'             => trim($validated['nisn']),
                'nik'              => trim($validated['nik']),
                'tanggal_lahir'    => $validated['tanggal_lahir'],
                'jenis_kelamin'    => $validated['jenis_kelamin'],
                'status_pendaftaran' => 'Pending',
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
