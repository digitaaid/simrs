<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PasienExport extends DefaultValueBinder  implements FromCollection, WithHeadings, WithCustomValueBinder
{
    public function bindValue(Cell $cell, $value)
    {
        $digit = preg_match_all("/[0-9]/", $value);
        if ($digit == 16) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING2);
            return true;
        }
        return parent::bindValue($cell, $value);
    }
    public function collection()
    {
        return Pasien::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'norm',
            'nama',
            'nomorkartu',
            'nik',
            'idpatient',
            'nohp',
            'gender',
            'tempat_lahir',
            'tgl_lahir',
            'hakkelas',
            'jenispeserta',
            'fktp',
            'desa_id',
            'kecamatan_id',
            'kabupaten_id',
            'provinsi_id',
            'alamat',
            'status',
            'keterangan',
            'user',
            'pic',
            'created_at',
            'updated_at',
        ];
    }
}
