<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaturan = Pengaturan::create([
            'nama' => "Klinik Utama",
            'idorganization' => "234234",
            'phone' => "089529909036",
            'email' => "marwandhiaurrahman@gmail.com",
            'website' => "marwandhiaurrahman.com",
            'address' => "Jl. Ciledug Raya",
            'postalCode' => "45188",
            'province' => "32",
            'city' => "32002",
            'district' => "320022015",
            'village' => "32002201504",
        ]);
    }
}
