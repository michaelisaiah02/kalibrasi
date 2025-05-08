<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\MasterList;
use App\Models\Unit;
use Illuminate\Http\Request;

class NewEquipmentController extends Controller
{
    public function create()
    {
        return view(
            'input.new-equipment',
            [
                'title' => 'INPUT NEW EQUIPMENT',
                'equipments' => Equipment::all(),
                'units' => Unit::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => ['required', 'string', 'max:255'],
            'id_num' => ['required', 'string', 'unique:master_lists,id_num'],
            'sn_num' => ['required', 'string'],
            'capacity' => ['required', 'string'],
            'accuracy' => ['required', 'integer'],
            'unit_id' => ['required', 'exists:units,id'],
            'brand' => ['required', 'string'],
            'calibration_type' => ['required', 'in:Internal,External'],
            'first_used' => ['required', 'date'],
            'rank' => ['required', 'in:AA,A,B,C'],
            'calibration_freq' => ['required', 'integer'],
            'acceptance_criteria' => ['required', 'string'],
            'pic' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
        ]);

        $master = MasterList::create($validated);

        // Flag untuk memaksa modal acceptance criteria
        session(['pending_acceptance' => $master->id_num]);

        return redirect()->route('print.label', $validated['id_num'])->with([
            'success' => 'The equipment was successfully added.',
            'key' => 'menu-input',
        ]);
    }
}
