<?php

namespace Database\Seeders;

use App\Models\Integration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Antrian BPJS',
            'Vclaim BPJS',
            'Apotek BPJS',
            'Satu Sehat',
            'INACBG',
        ];
        foreach ($items as $item) {
            Integration::create([
                'slug' => Str::slug($item),
                'name' => $item,
                'user' => 1,
                'pic' => 'Admin Super',
            ]);
        }
    }
}
