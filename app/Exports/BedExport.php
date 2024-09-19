<?php

namespace App\Exports;

use App\Models\Bed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BedExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Bed::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'nomorbed',
            'koderuang',
            'namaruang',
            'kamar_id',
            'unit_id',
            'bedpria',
            'bedwanita',
            'status',
            'pic',
            'user',
            'created_at',
            'updated_at',
        ];
    }
}
