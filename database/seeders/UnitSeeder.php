<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitList = [
            ['unit' => 'Kg'],
            ['unit' => 'gr'],
            ['unit' => 'mm'],
            ['unit' => '˚C'],
        ];

        foreach ($unitList as $unit) {
            Unit::create($unit);
        }
    }
}
