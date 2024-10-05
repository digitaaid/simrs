<?php

namespace App\Exports;

use App\Models\Integration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IntegrationExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Integration::get([
            'id',
            'slug',
            'name',
            'user_id',
            'base_url',
            'auth_url',
            'user_key',
            'secret_key',
            'description',
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
            'slug',
            'name',
            'user_id',
            'base_url',
            'auth_url',
            'user_key',
            'secret_key',
            'description',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
