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
        // Ambil semua input (boleh kosong)
        $from = $request->input('date_from');
        $to = $request->input('date_to');
        $sn = $request->input('no_sn');
        $type = $request->input('type_id');
        $cal = $request->input('calibration_type');
        $judg = $request->input('judgement');

        // Jika tombol Masterlist diklik:
        if ($request->has('master_lists')) {
            $query = MasterList::query();

            // filter tanggal (misal berdasarkan first_used)
            if ($from && $to) {
                $query->whereBetween('first_used', [$from, $to]);
            } elseif ($from) {
                $query->where('first_used', '>=', $from);
            } elseif ($to) {
                $query->where('first_used', '<=', $to);
            }

            if ($sn) {
                $query->where('sn_num', 'like', "%{$sn}%");
            }
            if ($type) {
                $query->where('type_id', $type);
            }
            if ($cal) {
                $query->where('calibration_type', $cal);
            }
            if ($judg) {
                // jika masterlist tidak punya kolom judgement, abaikan,
                // atau join ke results untuk filter judgement
            }

            // dd($query);
            $results = $query->get();

            return view('report.masterlist', compact('results'), ['title' => 'Master List']);
        }

        // Jika tombol Repair diklik:
        if ($request->has('repairs')) {
            $query = Repair::query();

            // filter tanggal repair
            if ($from && $to) {
                $query->whereBetween('repair_date', [$from, $to]);
            } elseif ($from) {
                $query->where('repair_date', '>=', $from);
            } elseif ($to) {
                $query->where('repair_date', '<=', $to);
            }

            if ($sn) {
                $query->where('sn_num', 'like', "%{$sn}%");
            }
            if ($type) {
                $query->where('type_id', $type);
            }
            if ($cal) {
                // jika repair tidak punya calibration_type, abaikan
            }
            if ($judg) {
                $query->where('judgement', $judg);
            }

            $results = $query->get();

            return view('report.repair', compact('results'), ['title' => 'Repair']);
        }
    }
}
