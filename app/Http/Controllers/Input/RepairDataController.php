<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairDataController extends Controller
{
    public function create(Repair $repair)
    {
        return view('input.repair-data', [
            'title' => 'REPAIR DATA INPUT',
            'repairs' => $repair->all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_num' => ['required', 'string', 'max:255'],
            'problem_date' => ['required', 'date'],
            'problem' => ['required', 'string', 'max:255'],
        ]);

        Repair::create($validated);

        return redirect()->route('input.repair.data')->with('success', 'Repair data successfully added.');
    }
}
