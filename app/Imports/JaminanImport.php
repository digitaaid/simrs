<?php

namespace App\Imports;

use App\Models\Jaminan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JaminanImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['nama']) {
                Jaminan::updateOrCreate(
                    [
                        'kode' => $row['kode'],
                    ],
                    [
                        'nama' => $row['nama'],
                        'slug' => $row['slug'],
                        'updated_at' => $row['updated_at'] ?? now(),
                        'created_at' => $row['created_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
