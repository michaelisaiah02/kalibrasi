<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.user.register', [
            'title' => 'MASTER DATA INPUT - Register User',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'idKaryawan' => ['required', 'string', 'idKaryawan', 'digits:5', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
        ]);

        User::create([
            'name' => $validated['name'],
            'idKaryawan' => $validated['idKaryawan'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('dashboard')->with('success', 'User berhasil didaftarkan.');
    }
}
