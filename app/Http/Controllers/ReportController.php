<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\MasterList;
use App\Models\Repair;
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
        $from = $request->input('date_from');
        $to = $request->input('date_to');
        $loc = $request->input('location');
        $cal = $request->input('calibration_type');
        $judg = $request->input('judgement');

        // Jika tombol Masterlist diklik
        if ($request->has('master_lists')) {
            $query = MasterList::query()
                ->with(['equipment', 'unit', 'results' => function ($q) {
                    $q->latest('calibration_date')->limit(1);
                }]);

            // Filter tanggal first_used
            if ($from && $to) {
                $query->whereBetween('first_used', [$from, $to]);
            } elseif ($from) {
                $query->where('first_used', '>=', $from);
            } elseif ($to) {
                $query->where('first_used', '<=', $to);
            }

            if ($loc) {
                $query->where('location', $loc);
            }
            if ($cal) {
                $query->where('calibration_type', $cal);
            }

            if ($judg) {
                $query->whereHas('results', function ($q) use ($judg) {
                    $q->latest('calibration_date')->limit(1)
                        ->where('judgement', $judg);
                });
            }
            $results = $query->paginate(5)->withQueryString();

            return view('report.masterlist', compact('results'))
                ->with('title', 'REPORT - MASTERLIST');
        }

        // Jika tombol Repair diklik
        if ($request->has('repairs')) {
            $query = Repair::query()->with(['masterList']);
            // dd($query->get());
            if ($from && $to) {
                $query->whereBetween('repair_date', [$from, $to]);
            } elseif ($from) {
                $query->where('repair_date', '>=', $from);
            } elseif ($to) {
                $query->where('repair_date', '<=', $to);
            }

            if ($loc) {
                $query->where('location', $loc);
            }
            if ($judg) {
                $query->where('judgement', $judg);
            }

            $repairs = $query->paginate(5)->withQueryString();

            return view('report.repair', compact('repairs'))
                ->with('title', 'REPORT - REPAIR');
        }

        return redirect()->back()->with('error', 'Pilih jenis laporan yang ingin ditampilkan.');
    }
}
