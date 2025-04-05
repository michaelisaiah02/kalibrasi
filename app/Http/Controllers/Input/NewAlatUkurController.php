<?php

namespace App\Http\Controllers\Input;

use App\Models\AlatUkur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewAlatUkurController extends Controller
{
    public function create()
    {
        return view('input.new-alat-ukur', ['title' => 'INPUT NEW ALAT UKUR']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat_ukur' => ['required', 'string', 'max:255'],
            'pic_pengguna' => ['required', 'string', 'max:255'],
            'nomor_id_sn' => ['required', 'string', 'unique:alat_ukur,nomor_id_sn'],
            'tgl_kalibrasi' => ['required', 'date'],
            'kapasitas' => ['required', 'string'],
            'tipe_kalibrasi' => ['required', 'in:Internal,External'],
            'ketelitian' => ['required', 'string'],
            'merk' => ['required', 'string'],
            'freq_kalibrasi' => ['required', 'in:1x/thn,3x/thn'],
            'location' => ['required', 'string'],
        ]);

        AlatUkur::create([
            'nama_alat_ukur' => $validated['nama_alat_ukur'],
            'pic_pengguna' => $validated['pic Pengguna'],
            'nomor_id_sn' => $validated['nomor_id_sn'],
            'tgl_kalibrasi' => $validated['tgl_kalibrasi'],
            'kapasitas' => $validated['kapasitas'],
            'tipe_kalibrasi' => $validated['tipe_kalibrasi'],
            'ketelitian' => $validated['ketelitian'],
            'merk' => $validated['merk'],
            'freq_kalibrasi' => $validated['freq_kalibrasi'],
            'location' => $validated['location'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Alat ukur berhasil ditambahkan.');
    }
}
