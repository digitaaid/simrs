<?php

namespace App\Imports;

use App\Models\Bed;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BedImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['kamar_id']) {
                Bed::updateOrCreate(
                    [
                        'kamar_id' => $row['kamar_id'],
                        'nomorbed' => $row['nomorbed'],
                    ],
                    [
                        'koderuang' => $row['koderuang'],
                        'namaruang' => $row['namaruang'],
                        'unit_id' => $row['unit_id'],
                        'bedpria' => $row['bedpria'],
                        'bedwanita' => $row['bedwanita'],
                        'bedwanita' => $row['bedwanita'],
                        'status' => $row['status'],
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
