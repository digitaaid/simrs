<?php

namespace App\Exports;

use App\Models\Tindakan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TindakanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tindakan::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'klasifikasi',
            'jenispasien',
            'jasa_pelayanan',
            'jasa_rs',
            'harga',
            'user',
            'pic',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}
