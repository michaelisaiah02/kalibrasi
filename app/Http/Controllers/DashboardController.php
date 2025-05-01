<?php

namespace App\Http\Controllers;

use App\Models\MasterList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('key')) {
            return redirect()
                ->route('dashboard')
                ->with(['key' => $request->key]);
        }

        $now = Carbon::now();
        $soon = $now->copy()->addMonth();

        $equipments = MasterList::with([
            'equipment', // relasi ke nama alat
            'results' => fn ($q) => $q->latest()->take(3),
            'repairs' => fn ($q) => $q->latest()->limit(1),
        ])->get();

        $warnings = [];

        foreach ($equipments as $eq) {
            $latestResult = $eq->results->first();
            $lastJudgement = optional($latestResult)->judgement;
            $idNum = $eq->id_num;
            $name = $eq->equipment->name;

            if ($lastJudgement === 'Disposal') {
                continue;
            }

            if (! $latestResult) {
                $lastDate = Carbon::parse($eq->first_used);
            } elseif ($lastJudgement === 'NG' && $eq->repairs->isNotEmpty()) {
                $lastDate = Carbon::parse($eq->repairs->first()->repair_date);
            } else {
                $lastDate = Carbon::parse($latestResult->calibration_date);
            }

            $nextDue = $lastDate->copy()->addMonths($eq->calibration_freq);
            if ($nextDue->lte($soon)) {
                $warnings[] = [
                    'id_num' => $idNum,
                    'name' => $name,
                    'last_date' => $lastDate->format('d-m-Y'),
                    'since' => $lastDate->diffForHumans(['parts' => 2, 'join' => true, 'short' => false]), // contoh: "7 bulan yang lalu"
                ];
            }
        }

        return view('dashboard')->with([
            'warnings' => $warnings,
            'key' => session('key'),
        ]);
    }
}
