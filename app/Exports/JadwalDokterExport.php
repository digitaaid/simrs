<?php

namespace App\Exports;

use App\Models\JadwalDokter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalDokterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return JadwalDokter::get([
            'id',
            'hari',
            'namahari',
            'kodepoli',
            'kodesubspesialis',
            'namapoli',
            'namasubspesialis',
            'kodedokter',
            'namadokter',
            'jampraktek',
            'kapasitas',
            'huruf',
            'libur',
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
            'hari',
            'namahari',
            'kodepoli',
            'kodesubspesialis',
            'namapoli',
            'namasubspesialis',
            'kodedokter',
            'namadokter',
            'jampraktek',
            'kapasitas',
            'huruf',
            'libur',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
