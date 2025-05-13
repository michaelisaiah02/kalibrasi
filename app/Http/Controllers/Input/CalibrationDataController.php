<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class CalibrationDataController extends Controller
{
    public function create(Result $result)
    {
        return view('input.calibration-data', [
            'title' => 'CALIBRATION DATA INPUT',
            'results' => $result->all(),
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
            'param_01' => 'required|numeric|min:0.01',
            'param_02' => 'required|numeric|min:0.01',
            'param_03' => 'required|numeric|min:0.01',
            'param_04' => 'required|numeric|min:0.01',
            'param_05' => 'required|numeric|min:0.01',
            'param_06' => 'required|numeric|min:0.01',
            'param_07' => 'required|numeric|min:0.01',
            'param_08' => 'required|numeric|min:0.01',
            'param_09' => 'required|numeric|min:0.01',
            'param_10' => 'required|numeric|min:0.01',
            'judgement' => 'required|string|in:OK,NG,Disposal',
            'certificate' => $request->calibration_type === 'External'
                ? 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
                : 'nullable',
        ]);

        $validated['id_num'] = strtoupper($request->id_num);
        $validated['created_by'] = auth()->user()->employeeID;

        foreach (range(1, 9) as $i) {
            $validated["param_0{$i}"] = (float) $validated["param_0{$i}"];
        }
        $validated['param_10'] = (float) $validated['param_10'];

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

        // Simpan hasil kalibrasi
        $result = Result::create($validated);

        // Cek dan hapus jika lebih dari 3
        $oldResults = Result::where('id_num', $validated['id_num'])
            ->orderByDesc('calibration_date')
            ->skip(3)->take(PHP_INT_MAX)->get();

        foreach ($oldResults as $old) {
            $old->delete();
        }

        // Hapus session pending_result
        session()->forget('pending_result');

        return redirect()->route('input.calibration.data')->with('success', 'Calibration result were successfully saved.');
    }

    public function edit(Request $request, Result $result, $id)
    {
        $validated = $request->validate([
            'id_num' => 'required|exists:master_lists,id_num',
            'calibration_date' => 'nullable|date',
            'calibrator_equipment' => $request->calibration_type === 'Internal'
                ? 'required|exists:master_lists,id_num'
                : 'nullable',
            'param_01' => 'required|numeric|min:0.01',
            'param_02' => 'required|numeric|min:0.01',
            'param_03' => 'required|numeric|min:0.01',
            'param_04' => 'required|numeric|min:0.01',
            'param_05' => 'required|numeric|min:0.01',
            'param_06' => 'required|numeric|min:0.01',
            'param_07' => 'required|numeric|min:0.01',
            'param_08' => 'required|numeric|min:0.01',
            'param_09' => 'required|numeric|min:0.01',
            'param_10' => 'required|numeric|min:0.01',
            'judgement' => 'required|string|in:OK,NG,Disposal',
            'certificate' => $request->calibration_type === 'External'
                ? 'file|mimes:jpg,jpeg|max:2048'
                : 'nullable',
        ]);

        $validated['created_by'] = auth()->user()->employeeID;
        $validated['id_num'] = strtoupper($request->id_num);

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

        foreach (range(1, 9) as $i) {
            $validated["param_0{$i}"] = (float) $validated["param_0{$i}"];
        }
        $validated['param_10'] = (float) $validated['param_10'];

        if (isNull($validated['calibration_date'])) {
            $validated['calibration_date'] = now()->toDateString();
        }

        // Simpan hasil kalibrasi
        $result = Result::find($id);
        $result->update($validated);

        return redirect()->route('input.calibration.data')->with('success', 'Calibration result were successfully updated.');
    }
}
