<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use App\Models\MasterList;
use App\Models\Repair;

class PrintController extends Controller
{
    public function label($id)
    {
        $equipment = MasterList::with(['equipment', 'unit', 'results'])->where('id_num', $id)->firstOrFail();

        return view('print-label', compact('equipment'));
    }

    public function reportMasterlist($id)
    {
        $result = Result::with(['masterList'])->where('id_num', $id)->firstOrFail();
        $approved = User::where('approved', true)->first();
        $checked = User::where('checked', true)->first();

        return view('print-report-masterlist', compact('result'), [
            'approved' => $approved,
            'checked' => $checked
        ]);
    }

    public function reportRepair($id)
    {
        $repair = Repair::with(['masterList'])->where('id_num', $id)->firstOrFail();
        $approved = User::where('approved', true)->first();
        $checked = User::where('checked', true)->first();

        return view('print-report-repair', compact('repair'), [
            'approved' => $approved,
            'checked' => $checked
        ]);
    }
}
