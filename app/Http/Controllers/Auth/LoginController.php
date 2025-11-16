<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login gabungan.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Login Admin
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            if (Auth::guard('web')->attempt(['email' => $username, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        }

        // Login Siswa
        if (is_numeric($username)) {
            if (Auth::guard('siswa')->attempt(['nisn' => $username, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect()->route('siswa.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'NISN atau Email / Password salah.',
        ])->withInput();
    }

    /**
     * Logout untuk kedua guard.
     */
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

        return redirect()->route('login');
    }
}
