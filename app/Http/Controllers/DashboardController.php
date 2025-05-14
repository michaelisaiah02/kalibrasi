<?php

namespace App\Http\Controllers;

use App\Models\MasterList;
use App\Models\Standard;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('key')) {
            return redirect()->route('dashboard')->with(['key' => $request->key]);
        }

        $equipments = MasterList::with(['results' => function ($q) {
            $q->latest('calibration_date')->limit(1);
        }])->get();

        $warnings = []; // utk soon & NG
        $dangers = []; // utk overdue

        foreach ($equipments as $eq) {
            $latest = $eq->results->first();

            // jika belum pernah ada result, gunakan first_used & treat as OK
            if (! $latest) {
                $lastCal = Carbon::parse($eq->first_used);
                $judg = 'OK';
            } else {
                $lastCal = Carbon::parse($latest->calibration_date);
                $judg = $latest->judgement;
            }

            // skip Disposal
            if ($judg === 'Disposal') {
                continue;
            }

            // hitung kapan due, dan sebulan sebelum
            $freq = $eq->calibration_freq;
            $dueDate = $lastCal->copy()->addMonths($freq);
            $warnFrom = $dueDate->copy()->subMonth();
            $now = Carbon::now();
            // `The ${w.id_num} - ${w.name} device needs to be recalibrated (NG). Last: ${w.last_date}.`;
            // bentuk pesan
            $msg = "The equipment {$eq->id_num} - {$eq->sn_num} device needs to be recalibrated. Last calibrate: {$lastCal->format('d-m-Y')}.";

            if ($judg === 'NG' || $now->between($warnFrom, $dueDate)) {
                // NG selalu warning, atau OK dalam sebulan ke depan
                $warnings[] = $msg;
            } elseif ($now->gt($dueDate)) {
                // sudah lewat due date
                $dangers[] = $msg." (should be calibrated before: {$dueDate->format('d-m-Y')})";
            }
        }
        // dd($warnings);

        if (session()->has('pending_acceptance')) {
            $masterList = MasterList::where('id_num', session('pending_acceptance'))->first();
        }

        return view('dashboard', compact('warnings', 'dangers'), [
            'masterList' => $masterList ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_num' => ['required', 'string', 'max:255', 'unique:standards,id_num'],
            'param_01' => ['required', 'numeric', 'min:0.01'],
            'param_02' => ['required', 'numeric', 'min:0.01'],
            'param_03' => ['required', 'numeric', 'min:0.01'],
            'param_04' => ['required', 'numeric', 'min:0.01'],
            'param_05' => ['required', 'numeric', 'min:0.01'],
            'param_06' => ['required', 'numeric', 'min:0.01'],
            'param_07' => ['required', 'numeric', 'min:0.01'],
            'param_08' => ['required', 'numeric', 'min:0.01'],
            'param_09' => ['required', 'numeric', 'min:0.01'],
            'param_10' => ['required', 'numeric', 'min:0.01'],
        ]);

        // Ensure numeric values are properly cast
        foreach (range(1, 9) as $i) {
            $validated["param_0{$i}"] = (float) $validated["param_0{$i}"];
        }
        $validated['param_10'] = (float) $validated['param_10'];

        // Simpan acceptance criteria
        Standard::create($validated);

        // Bersihkan flag acceptance, set flag result
        session()->forget('pending_acceptance');
        session(['pending_result' => $validated['id_num']]);

        return redirect()->route('input.calibration.data')->with([
            'success' => 'Please input the calibration data.',
        ]);
    }
}
