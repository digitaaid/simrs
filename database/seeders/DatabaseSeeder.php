<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Perawat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1000)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IntegrationSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(JaminanSeeder::class);
        // Pasien::factory(100)->create();
        Dokter::factory(10)->create();
        Perawat::factory(10)->create();
    }
}
