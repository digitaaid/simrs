<?php

namespace App\Imports;

use App\Models\JadwalDokter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalDokterImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['hari']) {
                JadwalDokter::updateOrCreate(
                    [
                        'hari' => $row['hari'],
                        'kodedokter' => $row['kodedokter'],
                        'jampraktek' => $row['jampraktek'],
                    ],
                    [
                        'namahari' => $row['namahari'],
                        'kodepoli' => $row['kodepoli'],
                        'kodesubspesialis' => $row['kodesubspesialis'],
                        'namapoli' => $row['namapoli'],
                        'namasubspesialis' => $row['namasubspesialis'],
                        'namadokter' => $row['namadokter'],
                        'kapasitas' => $row['kapasitas'],
                        'huruf' => $row['huruf'] ?? "X",
                        'libur' => $row['libur'] ?? 0,
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
