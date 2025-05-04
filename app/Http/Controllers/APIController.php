<?php

namespace App\Http\Controllers;

use App\Models\MasterList;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function countEquipments($type_id)
    {
        $count = MasterList::where('type_id', $type_id)->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getMasterList($id_num)
    {
        $data = MasterList::with(['equipment', 'unit', 'standard'])
            ->where('id_num', $id_num)
            ->first();
        if ($data->calibration_type === 'Internal') {
            $calibrator_equipments = MasterList::with('equipment')
                ->where('id_num', '!=', $id_num)
                ->get()
                ->map(function ($item) {
                    return [
                        'id_num' => $item->id_num,
                        'equipment_name' => $item->equipment->name ?? '(Unknown)',
                    ];
                });
        }
        if (! $data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json([
            'sn_num' => $data->sn_num,
            'equipment_name' => $data->equipment->name ?? null,
            'capacity' => $data->capacity,
            'accuracy' => $data->accuracy,
            'unit' => $data->unit->symbol ?? null,
            'brand' => $data->brand,
            'location' => $data->location,
            'pic' => $data->pic,
            'calibration_type' => $data->calibration_type,
            'acceptance_criteria' => $data->acceptance_criteria,
            'calibrator_equipments' => $calibrator_equipments ?? '',
            'standard' => $data->standard,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
