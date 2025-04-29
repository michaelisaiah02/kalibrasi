<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    public function index()
    {
        $standards = Standard::paginate(5);
        return view('admin.standard', compact('standards'), [
            'title' => 'EQUIPMENT ACCEPTANCE CRITERIA FORM'
        ]);
    }
}
