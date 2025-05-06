<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MasterListController extends Controller
{
    public function index()
    {
        $masterlists = MasterList::paginate(5);

        return view('admin.master-lists.index', compact('masterlists'), [
            'title' => 'MASTER DATA INPUT - MASTER LISTS TABLE',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'symbol' => ['required', 'string', 'unique:master_lists,symbol'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        MasterList::create($validated);

        return redirect()->route('admin.master-lists.index')->with('success', 'Master List berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $unit = MasterList::findOrFail($id);

        $validated = $request->validate([
            'symbol' => [
                'required',
                Rule::unique('masterlists', 'symbol')->ignore($unit->id),
            ],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $unit->update($validated);

        return redirect()->route('admin.master-lists.index')->with('success', 'Master List berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unit = MasterList::findOrFail($id);
        $unit->delete();

        return redirect()->route('admin.master-lists.index')->with('success', 'Master List berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $query = MasterList::query()
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('id_num', 'like', "%{$keyword}%")
                    ->orWhere('sn_num', 'like', "%{$keyword}%");
            });

        $masterlists = $query->orderBy('created_at', 'desc')->paginate(5);

        return response()->json([
            'html' => view('admin.master-lists.partials.table_rows', compact('masterlists'))->render(),
            'pagination' => view('admin.master-lists.partials.pagination', compact('masterlists'))->render(),
        ]);
    }
}
