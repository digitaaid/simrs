<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ObatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Obat::get([
            'id',
            'nama',
            'kemasan',
            'konversi_satuan',
            'satuan',
            'stok_minimum',
            'jenisobat',
            'zat_aktif',
            'kekuatan',
            'tipeobat',
            'harga_beli',
            'diskon_beli',
            'harga_jual',
            'harga_klinik',
            'harga_bpjs',
            'merk',
            'distributor',
            'bpom',
            'barcode',
            'user',
            'pic',
            'status',
            'created_at',
            'updated_at',
        ]);
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'kemasan',
            'konversi_satuan',
            'satuan',
            'stok_minimum',
            'jenisobat',
            'zat_aktif',
            'kekuatan',
            'tipeobat',
            'harga_beli',
            'diskon_beli',
            'harga_jual',
            'harga_klinik',
            'harga_bpjs',
            'merk',
            'distributor',
            'bpom',
            'barcode',
            'user',
            'pic',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}
