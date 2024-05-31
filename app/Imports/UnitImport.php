<?php

namespace App\Imports;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UnitImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['nama']) {
                Unit::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                    ],
                    [
                        'kode' => $row['kode'],
                        'kodejkn' => $row['kodejkn'],
                        'idorganization' => $row['idorganization'],
                        'idlocation' => $row['idlocation'],
                        'jenis' => $row['jenis'],
                        'lokasi' => $row['lokasi'],
                        'status' => $row['status'] ?? 1,
                        'user' => $row['user'] ?? auth()->user()->id,
                        'pic' => $row['pic'] ?? auth()->user()->name,
                        'status' => $row['status'] ?? 1,
                        'updated_at' => $row['updated_at'] ?? now(),
                        'created_at' => $row['created_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
