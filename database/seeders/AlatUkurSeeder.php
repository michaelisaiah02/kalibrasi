<?php

namespace Database\Seeders;

use App\Models\AlatUkur;
use Illuminate\Database\Seeder;

class AlatUkurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $alatList = [
            ['tipe_id' => 'TIM', 'nama_alat' => 'Timbangan'],
            ['tipe_id' => 'CAL', 'nama_alat' => 'Caliper'],
            ['tipe_id' => 'MIC', 'nama_alat' => 'Micrometer'],
        ];

        foreach ($alatList as $alat) {
            AlatUkur::create($alat);
        }
    }
}
