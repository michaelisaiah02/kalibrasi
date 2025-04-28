<?php

namespace App\Http\Controllers\Input;

use App\Models\Equipment;
use App\Models\MasterList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;

class NewEquipmentController extends Controller
{
    public function create()
    {
        return view(
            'input.new-equipment',
            [
                'title' => 'INPUT NEW EQUIPMENT',
                'equipments' => Equipment::all(),
                'units' => Unit::all()
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

        MasterList::create([
            'type_id' => $validated['type_id'],
            'id_num' => $validated['id_num'],
            'sn_num' => $validated['sn_num'],
            'capacity' => $validated['capacity'],
            'accuracy' => $validated['accuracy'],
            'unit_id' => $validated['unit_id'],
            'brand' => $validated['brand'],
            'calibration_type' => $validated['calibration_type'],
            'first_used' => $validated['first_used'],
            'rank' => $validated['rank'],
            'calibration_freq' => $validated['calibration_freq'],
            'acceptance_criteria' => $validated['acceptance_criteria'],
            'pic' => $validated['pic'],
            'location' => $validated['location'],
        ]);

        return redirect()->route('dashboard')->with([
            'success' => 'The equipment was successfully added.',
            'key' => 'menu-input'
        ]);
    }
}
