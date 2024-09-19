<?php

namespace App\Imports;

use App\Models\Kamar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KamarImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['unit_id']) {
                Kamar::updateOrCreate(
                    [
                        'unit_id' => $row['unit_id'],
                    ],
                    [
                        'koderuang' => $row['koderuang'],
                        'namaruang' => $row['namaruang'],
                        'kodekelas' => $row['kodekelas'],
                        'kapasitastotal' => $row['kapasitastotal'],
                        'kapasitaspria' => $row['kapasitaspria'],
                        'kapasitaswanita' => $row['kapasitaswanita'],
                        'kapasitaspriawanita' => $row['kapasitaspriawanita'],
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
