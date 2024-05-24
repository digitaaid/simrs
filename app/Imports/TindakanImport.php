<?php

namespace App\Imports;

use App\Models\Tindakan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TindakanImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Tindakan::updateOrCreate(
                [
                    'nama' => $row['nama'],
                ],
                [
                    'klasifikasi' => $row['klasifikasi'],
                    'jenispasien' => $row['jenispasien'],
                    'jasa_pelayanan' => $row['jasa_pelayanan'] ?? 0,
                    'jasa_rs' => $row['jasa_rs'] ?? 0,
                    'harga' => $row['harga'] ?? 0,
                    'user' => $row['user'],
                    'pic' => $row['pic'],
                    'status' => $row['status'],
                    'updated_at' => $row['updated_at'],
                    'created_at' => $row['created_at'],
                ]
            );
        }
    }
}
