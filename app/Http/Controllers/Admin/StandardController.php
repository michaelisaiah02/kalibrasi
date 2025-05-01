<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterList;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    public function index()
    {
        $standards = Standard::paginate(5);
        $masterLists = MasterList::all();

        return view('admin.standards.index', compact('standards', 'masterLists'), [
            'title' => 'EQUIPMENT ACCEPTANCE CRITERIA FORM',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_num' => ['required', 'string', 'max:255', 'unique:standards,id_num'],
            'param_01' => ['required', 'integer', 'min:1'],
            'param_02' => ['required', 'integer', 'min:1'],
            'param_03' => ['required', 'integer', 'min:1'],
            'param_04' => ['required', 'integer', 'min:1'],
            'param_05' => ['required', 'integer', 'min:1'],
            'param_06' => ['required', 'integer', 'min:1'],
            'param_07' => ['required', 'integer', 'min:1'],
            'param_08' => ['required', 'integer', 'min:1'],
            'param_09' => ['required', 'integer', 'min:1'],
            'param_10' => ['required', 'integer', 'min:1'],
        ]);

        Standard::create($validated);

        return redirect()->route('admin.standards.index')->with('success', 'Standard berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $standard = Standard::findOrFail($id);

        $validated = $request->validate([
            'id_num' => ['required', 'string', 'max:255', 'unique:standards,id_num,'.$standard->id],
            'param_01' => ['required', 'integer', 'min:1'],
            'param_02' => ['required', 'integer', 'min:1'],
            'param_03' => ['required', 'integer', 'min:1'],
            'param_04' => ['required', 'integer', 'min:1'],
            'param_05' => ['required', 'integer', 'min:1'],
            'param_06' => ['required', 'integer', 'min:1'],
            'param_07' => ['required', 'integer', 'min:1'],
            'param_08' => ['required', 'integer', 'min:1'],
            'param_09' => ['required', 'integer', 'min:1'],
            'param_10' => ['required', 'integer', 'min:1'],
        ]);

        $standard->update($validated);

        return redirect()->route('admin.standards.index')->with('success', 'Standard berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $standard = Standard::findOrFail($id);
        $standard->delete();

        return redirect()->route('admin.standards.index')->with('success', 'Standard berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $query = Standard::query()
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('id', 'like', "%{$keyword}%");
            });

        $standards = $query->orderBy('created_at', 'desc')->paginate(5);

        return response()->json([
            'html' => view('admin.standards.partials.table_rows', compact('standards'))->render(),
            'pagination' => view('admin.standards.partials.pagination', compact('standards'))->render(),
        ]);
    }
}
