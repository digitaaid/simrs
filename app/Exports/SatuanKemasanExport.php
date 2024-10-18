<?php

namespace App\Exports;

use App\Models\SatuanKemasan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SatuanKemasanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SatuanKemasan::get([
            'id',
            'nama',
            'created_at',
            'updated_at',
        ]);
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'created_at',
            'updated_at',
        ];
    }
}
