<?php

namespace App\Http\Controllers;

use App\Models\MasterList;

class PrintController extends Controller
{
    public function label($id)
    {
        $equipment = MasterList::with(['equipment', 'unit', 'results'])->where('id_num', $id)->firstOrFail();

        return view('print-label', compact('equipment'));
    }

    public function report($id)
    {
        $repair = MasterList::with(['equipment', 'unit', 'results', 'standard'])->where('id_num', $id)->firstOrFail();
        // dd($repair);

        return view('print-report', compact('repair'));
    }
}
