<?php

namespace Database\Seeders;

use App\Models\Jaminan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JaminanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jaminan = [
            [
                'kode' => '00003',
                'nama' => 'JKN',
                'slug' => 'JKN',
            ],
            [
                'kode' => '00071',
                'nama' => 'JAMINAN COVID-19',
                'slug' => 'COVID-19',
            ],
            [
                'kode' => '00072',
                'nama' => 'JAMINAN KIPI',
                'slug' => 'KIPI',
            ],
            [
                'kode' => '00073',
                'nama' => 'JAMINAN BAYI BARU LAHIR',
                'slug' => 'BBL',
            ],
            [
                'kode' => '00074',
                'nama' => 'JAMINAN PERPANJANGAN MASA RAWAT',
                'slug' => 'PMR',
            ],
            [
                'kode' => '00075',
                'nama' => 'JAMINAN CO-INSIDENSE',
                'slug' => 'CO-INS',
            ],
            [
                'kode' => '00076',
                'nama' => 'JAMPERSAL',
                'slug' => 'JPS',
            ],
            [
                'kode' => '00077',
                'nama' => 'JAMINAN PEMULIHAN KESEHATAN PRIORITAS',
                'slug' => 'JPKP',
            ],
            [
                'kode' => '00005',
                'nama' => 'JAMKESDA',
                'slug' => '001',
            ],
            [
                'kode' => '00006',
                'nama' => 'JAMKESOS',
                'slug' => 'JKS',
            ],
            [
                'kode' => '00001',
                'nama' => 'PASIEN BAYAR',
                'slug' => '999',
            ],
        ];
        foreach ($jaminan as  $value) {
            Jaminan::create([
                'kode' => $value['kode'],
                'nama' => $value['nama'],
                'slug' => $value['slug'],
            ]);
        }
    }
}
