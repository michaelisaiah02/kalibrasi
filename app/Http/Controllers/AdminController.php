<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function keberterimaan()
    {
        return view('admin.std-keberterimaan', [
            'title' => 'FORM STANDAR KEBERTERIMAAN EQUIPMENT'
        ]);
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user.index', [
            'title' => 'MASTER DATA INPUT - Tabel User',
            'users' => $users,
        ]);
    }
}
