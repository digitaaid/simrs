<?php

namespace App\Exports;

use App\Models\SupplierObat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierObatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SupplierObat::get([
            'id',
            'nama',
            'alamat',
            'distributor',
            'kontak',
            'email',
            'nohp',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ]);
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'alamat',
            'distributor',
            'kontak',
            'email',
            'nohp',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
