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
            Obat::updateOrCreate(
                [
                    'nama' => $row['nama'],
                ],
                [
                    'kemasan' => $row['kemasan'],
                    'konversi_satuan' => $row['konversi_satuan'],
                    'satuan' => $row['satuan'],
                    'stok_minimum' => $row['stok_minimum'],
                    'jenisobat' => $row['jenisobat'],
                    'tipeobat' => $row['tipeobat'],
                    'harga_beli' => $row['harga_beli'],
                    'diskon_beli' => $row['diskon_beli'],
                    'harga_jual' => $row['harga_jual'],
                    'harga_klinik' => $row['harga_klinik'],
                    'harga_bpjs' => $row['harga_bpjs'],
                    'merk' => $row['merk'],
                    'distributor' => $row['distributor'],
                    'bpom' => $row['bpom'],
                    'barcode' => $row['barcode'],
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
