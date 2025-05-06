<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::paginate(5);

        return view('admin.units.index', compact('units'), [
            'title' => 'MASTER DATA INPUT - UNITS TABLE',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'symbol' => ['required', 'string', 'unique:units,symbol'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        Unit::create($validated);

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validated = $request->validate([
            'symbol' => [
                'required',
                Rule::unique('units', 'symbol')->ignore($unit->id),
            ],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $unit->update($validated);

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $query = Unit::query()
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('symbol', 'like', "%{$keyword}%");
            });

        $units = $query->orderBy('created_at', 'desc')->paginate(5);

        return response()->json([
            'html' => view('admin.units.partials.table_rows', compact('units'))->render(),
            'pagination' => view('admin.units.partials.pagination', compact('units'))->render(),
        ]);
    }
}
