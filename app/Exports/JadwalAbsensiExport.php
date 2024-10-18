<?php

namespace App\Exports;

use App\Models\ShiftAbsensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalAbsensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ShiftAbsensi::get([
            'id',
            'nama',
            'slug',
            'jam_masuk',
            'jam_pulang',
            'pic',
            'user',
            'created_at',
            'updated_at',
        ]);
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'slug',
            'jam_masuk',
            'jam_pulang',
            'pic',
            'user',
            'created_at',
            'updated_at',
        ];
    }
}
