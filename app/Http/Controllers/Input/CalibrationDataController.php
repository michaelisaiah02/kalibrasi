<?php

namespace App\Http\Controllers\Input;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalibrationDataController extends Controller
{
    public function create(Result $result)
    {
        return view('input.calibration-data', [
            'title' => 'CALIBRATION DATA INPUT',
            'results' => $result->all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_num' => 'required|exists:master_lists,id_num',
            'calibrator_equipment' => 'exists:master_lists,id_num',
            'param_01' => 'required|integer',
            'param_02' => 'required|integer',
            'param_03' => 'required|integer',
            'param_04' => 'required|integer',
            'param_05' => 'required|integer',
            'param_06' => 'required|integer',
            'param_07' => 'required|integer',
            'param_08' => 'required|integer',
            'param_09' => 'required|integer',
            'param_10' => 'required|integer',
            'judgement' => 'required|string|in:OK,NG,Disposal',
        ]);

        $validated['created_by'] = auth()->user()->idKaryawan;

        Result::create($validated);

        return redirect()->route('input.calibration.data')->with('success', 'Hasil kalibrasi berhasil disimpan.');
    }
}
