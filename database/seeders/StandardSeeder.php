<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandardSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua id_num dari master_lists
        $masterLists = DB::table('master_lists')->pluck('id_num');

        foreach ($masterLists as $id_num) {
            DB::table('standards')->insert([
                'id_num' => $id_num,
                'param_01' => rand(10, 100),
                'param_02' => rand(10, 100),
                'param_03' => rand(10, 100),
                'param_04' => rand(10, 100),
                'param_05' => rand(10, 100),
                'param_06' => rand(10, 100),
                'param_07' => rand(10, 100),
                'param_08' => rand(10, 100),
                'param_09' => rand(10, 100),
                'param_10' => rand(10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
