<?php

namespace App\Exports;

use App\Models\Jaminan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JaminanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Jaminan::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'kode',
            'slug',
            'nama',
            'created_at',
            'updated_at',
        ];
    }
}
