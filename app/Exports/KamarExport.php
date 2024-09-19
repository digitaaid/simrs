<?php

namespace App\Exports;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KamarExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        return Kamar::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'unit_id',
            'koderuang',
            'namaruang',
            'kodekelas',
            'kapasitastotal',
            'kapasitaspria',
            'kapasitaswanita',
            'kapasitaspriawanita',
            'status',
            'pic',
            'user',
            'created_at',
            'updated_at',
        ];
    }
}
