<?php

namespace App\Imports;

use App\Models\SatuanKemasan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SatuanKemasanImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            SatuanKemasan::updateOrCreate([
                'nama' => $row['nama'],
            ]);
        }
    }
}
