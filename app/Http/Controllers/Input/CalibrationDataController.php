<?php

namespace App\Http\Controllers\Input;

use Carbon\Carbon;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Storage;

class CalibrationDataController extends Controller
{
    public function create(Result $result)
    {
        return view('input.calibration-data', [
            'title' => 'CALIBRATION DATA INPUT',
            'results' => $result->all()
        ]);
    }

    public function store(Request $request, Result $result)
    {
        $validated = $request->validate([
            'id_num' => 'required|exists:master_lists,id_num',
            'calibration_date' => 'nullable|date',
            'calibrator_equipment' => $request->calibration_type === 'Internal'
                ? 'required|exists:master_lists,id_num'
                : 'nullable',
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
            'certificate' => $request->calibration_type === 'External'
                ? 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
                : 'nullable',
        ]);

        $validated['created_by'] = auth()->user()->employeeID;

        if (isNull($validated['calibration_date'])) {
            $validated['calibration_date'] = now()->toDateString();
        }

        if ($request->hasFile('certificate')) {
            if ($result->certificate && Storage::exists($result->certificate)) {
                Storage::delete($result->certificate);
            }
            $idNum = $validated['id_num'];
            $date = Carbon::parse($validated['calibration_date'])->format('dmY');
            $ext = $request->file('certificate')->getClientOriginalExtension();

            $filename = "{$idNum}-{$date}.{$ext}";
            $folder = "certificates/{$idNum}";

            $path = $request->file('certificate')->storeAs($folder, $filename);

            $validated['certificate'] = $path;
        }

        Result::create($validated);

        return redirect()->route('input.calibration.data')->with('success', 'Calibration result were successfully saved.');
    }
}
