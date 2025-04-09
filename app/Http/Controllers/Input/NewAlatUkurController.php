<?php

namespace App\Http\Controllers\Input;

use App\Models\AlatUkur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterList;

class NewAlatUkurController extends Controller
{
    public function create()
    {
        return view(
            'input.new-alat-ukur',
            [
                'title' => 'INPUT NEW ALAT UKUR',
                'alat_ukurs' => AlatUkur::all()
            ]
        );
    }

    public function store(Request $request)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'tipe_id' => ['required', 'string', 'max:255'],
            'no_id' => ['required', 'string', 'unique:master_lists,no_id'],
            'no_sn' => ['required', 'string'],
            'std_ukuran' => ['required', 'string'],
            'tgl_kalibrasi' => ['required', 'date'],
            'tipe_kalibrasi' => ['required', 'in:Internal,External'],
            'first_used' => ['required', 'date'],
            'rank' => ['required', 'in:AA,A,B,C'],
            'kapasitas' => ['required', 'integer'],
            'ketelitian' => ['required', 'integer'],
            'merk' => ['required', 'string'],
            'freq_kalibrasi' => ['required', 'integer'],
            'pic_pengguna' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
        ]);

        MasterList::create([
            'tipe_id' => $validated['tipe_id'],
            'no_id' => $validated['no_id'],
            'no_sn' => $validated['no_sn'],
            'std_ukuran' => $validated['std_ukuran'],
            'tgl_kalibrasi' => $validated['tgl_kalibrasi'],
            'tipe_kalibrasi' => $validated['tipe_kalibrasi'],
            'first_used' => $validated['first_used'],
            'rank' => $validated['rank'],
            'kapasitas' => $validated['kapasitas'],
            'ketelitian' => $validated['ketelitian'],
            'merk' => $validated['merk'],
            'freq_kalibrasi' => $validated['freq_kalibrasi'],
            'pic_pengguna' => $validated['pic_pengguna'],
            'location' => $validated['location'],
        ]);

        return redirect()->route('dashboard')->with([
            'success' => 'Alat ukur berhasil ditambahkan.',
            'key' => 'menu-input'
        ]);
    }
}
