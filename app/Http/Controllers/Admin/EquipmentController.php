<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::paginate(5);

        return view('admin.equipments.index', compact('equipments'), [
            'title' => 'MASTER DATA INPUT - EQUIPMENTS TABLE',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => ['required', 'string', 'unique:equipments,type_id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        Equipment::create($validated);

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $unit = Equipment::findOrFail($id);

        $validated = $request->validate([
            'type_id' => [
                'required',
                Rule::unique('equipments', 'type_id')->ignore($unit->id),
            ],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $unit->update($validated);

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unit = Equipment::findOrFail($id);
        $unit->delete();

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $query = Equipment::query()
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('type_id', 'like', "%{$keyword}%");
            });

        $equipments = $query->orderBy('created_at', 'desc')->paginate(5);

        return response()->json([
            'html' => view('admin.equipments.partials.table_rows', compact('equipments'))->render(),
            'pagination' => view('admin.equipments.partials.pagination', compact('equipments'))->render(),
        ]);
    }
}
