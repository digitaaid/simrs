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
            if ($row['nama']) {
                Tindakan::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                        'jenispasien' => $row['jenispasien'] ?? 'SEMUA',
                    ],
                    [
                        'klasifikasi' => $row['klasifikasi'] ?? 'Akomodasi',
                        'jasa_pelayanan' => $row['jasa_pelayanan'] ?? 0,
                        'jasa_rs' => $row['jasa_rs'] ?? 0,
                        'harga' => $row['harga'] ?? 0,
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
