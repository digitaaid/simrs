<?php

namespace App\Imports;

use App\Models\Obat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObatImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['nama']) {
                Obat::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                    ],
                    [
                        'kemasan' => $row['kemasan'] ?? 'BOX',
                        'konversi_satuan' => $row['konversi_satuan'] ?? 1,
                        'satuan' => $row['satuan'] ?? 'BOX',
                        'stok_minimum' => $row['stok_minimum'],
                        'jenisobat' => $row['jenisobat'] ?? 'OBAT',
                        'tipeobat' => $row['tipeobat'],
                        'harga_beli' => $row['harga_beli'] ?? 0,
                        'diskon_beli' => $row['diskon_beli'] ?? 0,
                        'harga_jual' => $row['harga_jual'] ?? 0,
                        'harga_klinik' => $row['harga_klinik'] ?? 0,
                        'harga_bpjs' => $row['harga_bpjs'] ?? 0,
                        'merk' => $row['merk'],
                        'distributor' => $row['distributor'],
                        'bpom' => $row['bpom'],
                        'barcode' => $row['barcode'],
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
