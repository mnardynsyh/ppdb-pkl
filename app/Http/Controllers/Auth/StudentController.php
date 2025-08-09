<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required|min:5',
        ]);

        if (Auth::guard('student')->attempt([
            'nisn' => $request->nisn,
            'password' => $request->password
        ])) {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['nisn' => 'NISN atau password salah']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
}
