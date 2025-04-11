<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $equipmentList = [
            ['tipe_id' => 'TIM', 'nama_alat' => 'Timbangan'],
            ['tipe_id' => 'CAL', 'nama_alat' => 'Caliper'],
            ['tipe_id' => 'MIC', 'nama_alat' => 'Micrometer'],
        ];

        foreach ($equipmentList as $equipment) {
            Equipment::create($equipment);
        }
    }
}
