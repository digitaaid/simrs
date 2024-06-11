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


        Integration::create([
            'slug' => Str::slug('Vclaim BPJS'),
            'name' => 'Vclaim BPJS',
            'user_id' => '17480',
            'user_key' => '1c0d00f8eee4c7d8135759261aaaa3ec',
            'secret_key' => '1pQFC9A48C',
            'base_url' => "https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/",
            'user' => 1,
            'pic' => 'Admin Super',
        ]);
        Integration::create([
            'slug' => Str::slug('Antrian BPJS'),
            'name' => 'Antrian BPJS',
            'user_id' => '8640',
            'user_key' => 'acadde8a5a257e4773fd06e92a6cc38c',
            'secret_key' => '1yV3F26E3E',
            'base_url' => "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/",
            'user' => 1,
            'pic' => 'Admin Super',
        ]);
        $items = [
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
