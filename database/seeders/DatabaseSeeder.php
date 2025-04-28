<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\EquipmentSeeder;
use Database\Seeders\MasterListSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Michael',
            'employeeID' => '12025',
            'password' => '200302',
            'role' => 'admin'
        ]);

        $this->call([
            EquipmentSeeder::class,
            UnitSeeder::class,
            MasterListSeeder::class,
            StandardSeeder::class
        ]);
    }
}
