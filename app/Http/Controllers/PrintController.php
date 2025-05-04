<?php

namespace App\Http\Controllers;

use App\Models\MasterList;

class PrintController extends Controller
{
    public function label($id)
    {
        $equipment = MasterList::with(['equipment', 'unit'])->where('id_num', $id)->firstOrFail();

        return view('print-label', compact('equipment'));
    }
}
