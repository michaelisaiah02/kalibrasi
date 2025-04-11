<?php

namespace Database\Seeders;

use App\Models\AlatUkur;
use App\Models\MasterList;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alatUkurList = DB::table('equipments')->get(); // Ambil semua alat ukur
        $tipeCounter = [];

        foreach ($alatUkurList as $alat) {
            // Hitung berapa kali tipe ini sudah digunakan
            $tipe = $alat->tipe_id;
            if (!isset($tipeCounter[$tipe])) {
                $tipeCounter[$tipe] = 1;
            } else {
                $tipeCounter[$tipe]++;
            }

            // Format nomor ID: TIM-001, CAL-001, dll
            $noId = $tipe . '-' . str_pad($tipeCounter[$tipe], 3, '0', STR_PAD_LEFT);

            DB::table('master_lists')->insert([
                'no_id' => $noId,
                'no_sn' => 'SN-' . strtoupper(Str::random(5)),
                'kapasitas' => '100',
                'ketelitian' => '1',
                'std_ukuran' => 'ISO 17025',
                'merk' => 'ACME',
                'tgl_kalibrasi' => Carbon::now(),
                'tipe_kalibrasi' => ['Internal', 'External'][rand(0, 1)],
                'first_used' => Carbon::now()->setMonth(6),
                'rank' => 'A',
                'freq_kalibrasi' => 6,
                'pic_pengguna' => 'User ' . rand(1, 10),
                'location' => 'Gudang A',
                'tipe_id' => $tipe,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
