<?php

namespace App\Exports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Unit::get([
            'id',
            'nama',
            'kode',
            'kodejkn',
            'idorganization',
            'idlocation',
            'jenis',
            'lokasi',
            'status',
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
            'kode',
            'kodejkn',
            'idorganization',
            'idlocation',
            'jenis',
            'lokasi',
            'status',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
