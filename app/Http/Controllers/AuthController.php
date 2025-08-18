<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Login sebagai admin
        if (Auth::guard('web')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin');
        } else {
            dd('Gagal login web', $request->email, $request->password);
        }

        // Login sebagai wali
        if (Auth::guard('wali')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) {
            $request->session()->regenerate();
            return redirect()->route('wali.dashboard')->with('success', 'Login berhasil sebagai Wali');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout (untuk kedua guard)
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('wali')->check()) {
            Auth::guard('wali')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
