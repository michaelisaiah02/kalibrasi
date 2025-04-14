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
            'merk' => ['required', 'string'],
            'calibration_type' => ['required', 'in:Internal,External'],
            'first_used' => ['required', 'date'],
            'rank' => ['required', 'in:AA,A,B,C'],
            'calibration_freq' => ['required', 'integer'],
            'acceptance_criteria' => ['required', 'string'],
            'pic' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
        ], [
            'type_id.required' => 'Nama equipment harus dipilih.',
            'type_id.max' => 'ID tipe terlalu panjang.',

            'id_num.required' => 'ID Number harus diisi.',
            'id_num.unique' => 'ID Number sudah digunakan.',

            'sn_num.required' => 'Serial Number harus diisi.',

            'capacity.required' => 'Capacity harus diisi.',

            'accuracy.required' => 'Accuracy harus diisi.',
            'accuracy.integer' => 'Accuracy harus berupa angka.',

            'unit_id.required' => 'Unit satuan harus dipilih.',
            'unit_id.exists' => 'Unit yang dipilih tidak valid.',

            'merk.required' => 'Merk alat harus diisi.',

            'calibration_type.required' => 'Tipe kalibrasi harus dipilih.',
            'calibration_type.in' => 'Tipe kalibrasi hanya boleh Internal atau External.',

            'first_used.required' => 'Tanggal pemakaian pertama harus diisi.',
            'first_used.date' => 'Tanggal pemakaian pertama harus berupa tanggal yang valid.',

            'rank.required' => 'Rank harus dipilih.',
            'rank.in' => 'Rank hanya boleh AA, A, B, atau C.',

            'calibration_freq.required' => 'Frekuensi kalibrasi harus diisi.',
            'calibration_freq.integer' => 'Frekuensi kalibrasi harus berupa angka.',

            'acceptance_criteria.required' => 'Standar keberterimaan harus diisi.',

            'pic.required' => 'PIC pengguna harus diisi.',
            'pic.max' => 'Nama PIC tidak boleh lebih dari 255 karakter.',

            'location.required' => 'Lokasi alat harus diisi.',
        ]);
        // dd($request->all());

        MasterList::create([
            'type_id' => $validated['type_id'],
            'id_num' => $validated['id_num'],
            'sn_num' => $validated['sn_num'],
            'capacity' => $validated['capacity'],
            'accuracy' => $validated['accuracy'],
            'unit_id' => $validated['unit_id'],
            'merk' => $validated['merk'],
            'calibration_type' => $validated['calibration_type'],
            'first_used' => $validated['first_used'],
            'rank' => $validated['rank'],
            'calibration_freq' => $validated['calibration_freq'],
            'acceptance_criteria' => $validated['acceptance_criteria'],
            'pic' => $validated['pic'],
            'location' => $validated['location'],
        ]);

        return redirect()->route('dashboard')->with([
            'success' => 'Alat ukur berhasil ditambahkan.',
            'key' => 'menu-input'
        ]);
    }
}
