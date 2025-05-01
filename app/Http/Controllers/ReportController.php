<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function menu()
    {
        return view('report.menu', [
            'title' => 'REPORT',
            'equipments' => Equipment::all(),
        ]);
    }

    public function search(Request $request)
    {
        dd($request->all());
    }
}
