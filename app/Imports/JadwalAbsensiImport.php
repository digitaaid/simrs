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
                        'slug' => $row['slug'] ?? 'P',
                        'jam_masuk' => $row['jam_masuk'],
                        'jam_pulang' => $row['jam_pulang'],
                        'pic' => $row['pic'] ?? auth()->user()->name,
                        'user' => $row['user'] ?? auth()->user()->id,
                        'created_at' => $row['created_at'] ?? now(),
                        'updated_at' => $row['updated_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
