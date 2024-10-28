<?php

namespace App\Imports;

use App\Models\Dokter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DokterImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['nama']) {
                Dokter::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                    ],
                    [
                        'kode' => $row['kode'],
                        'kodejkn' => $row['kodejkn'],
                        'nik' => $row['nik'],
                        'user_id' => $row['user_id'],
                        'idpractitioner' => $row['idpractitioner'],
                        'title' => $row['title'],
                        'gender' => $row['gender'],
                        'sip' => $row['sip'],
                        'image' => $row['image'],
                        'status' => $row['status'] ?? 0,
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
