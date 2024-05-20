<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit = [
            [
                'kode' => '008',
                'nama' => 'HEMATOLOGI - ONKOLOGI MEDIK',
                'kodejkn' => '008',

            ],
            [
                'kode' => 'LAB',
                'nama' => 'LABORATORIUM',
                'kodejkn' => null,

            ],
            [
                'kode' => 'RAD',
                'nama' => 'RADIOLOGI',
                'kodejkn' => null,
            ],
            [
                'kode' => 'KMT',
                'nama' => 'KEMOTERAPI',
                'kodejkn' => null,
            ],
            [
                'kode' => 'FAR',
                'nama' => 'FARMASI',
                'kodejkn' => null,
            ],
            [
                'kode' => 'PRT',
                'nama' => 'PERAWAT',
                'kodejkn' => null,
            ],
            [
                'kode' => 'ADM',
                'nama' => 'ADMINISTRASI',
                'kodejkn' => null,
            ],
            [
                'kode' => 'RM',
                'nama' => 'REKAM MEDIS',
                'kodejkn' => null,
            ],

        ];
        foreach ($unit as  $value) {
            Unit::create([
                "kode" => $value['kode'],
                "nama" => $value['nama'],
                "kodejkn" => $value['kodejkn'],
                "user" => 1,
                "pic" => "Admin Seeder",
            ]);
        }
    }
}
