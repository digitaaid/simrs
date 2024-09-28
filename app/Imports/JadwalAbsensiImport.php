<?php

namespace App\Imports;

use App\Models\ShiftAbsensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalAbsensiImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['nama']) {
                ShiftAbsensi::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                    ],
                    [
                        'slug' => $row['slug'],
                        'user' => $row['user'],
                        'pic' => $row['pic'],
                        'user' => $row['user'],
                        'created_at' => $row['created_at'] ?? now(),
                        'updated_at' => $row['updated_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
