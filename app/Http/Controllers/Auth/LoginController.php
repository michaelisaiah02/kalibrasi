<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('employeeID', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, redirect ke halaman yang diinginkan
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'error' => 'Incorrect Employee ID or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
