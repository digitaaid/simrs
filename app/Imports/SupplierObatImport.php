<?php

namespace App\Imports;

use App\Models\SupplierObat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierObatImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            SupplierObat::updateOrCreate(
                ['nama' => $row['nama']],
                [
                    'alamat' => $row['nama'],
                    'distributor' => $row['distributor'],
                    'kontak' => $row['kontak'],
                    'email' => $row['email'],
                    'nohp' => $row['nohp'],
                    'pic' => $row['pic'] ?? auth()->user()->name,
                    'user' => $row['user'] ?? auth()->user()->id,
                ]
            );
        }
    }
}
