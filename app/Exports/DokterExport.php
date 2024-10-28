<?php

namespace App\Exports;

use App\Models\Dokter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DokterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Dokter::get([
            'id',
            'nama',
            'kode',
            'kodejkn',
            'nik',
            'user_id',
            'idpractitioner',
            'title',
            'gender',
            'sip',
            'image',
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
            'nik',
            'user_id',
            'idpractitioner',
            'title',
            'gender',
            'sip',
            'image',
            'status',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
