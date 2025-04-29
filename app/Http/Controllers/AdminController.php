<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function acceptanceCriteria()
    {
        return view('admin.acceptance-criteria', [
            'title' => 'STANDARD EQUIPMENT ACCEPTANCE FORM'
        ]);
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user.index', [
            'title' => 'MASTER DATA INPUT - USERS TABLE',
            'users' => $users,
        ]);
    }
}
