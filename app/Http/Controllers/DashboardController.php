<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('key')) {
            // dd($request->key);
            return redirect()->route('dashboard')->with(['key' => $request->key]);
        }

        return view('dashboard');
    }
}
