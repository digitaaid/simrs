<?php

namespace App\Imports;

use App\Models\Pasien;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasienImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Pasien::updateOrCreate(
                [
                    'norm' => strtoupper($row['norm']),
                ],
                [
                    'nama' => $row['nama'],
                    'nomorkartu' => $row['nomorkartu'],
                    'nik' => $row['nik'],
                    'idpatient' => $row['idpatient'],
                    'nohp' => $row['nohp'],
                    'gender' => $row['gender'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tgl_lahir' => $row['tgl_lahir'],
                    'hakkelas' => $row['hakkelas'],
                    'jenispeserta' => $row['jenispeserta'],
                    'fktp' => $row['fktp'],
                    'desa_id' => $row['desa_id'],
                    'kecamatan_id' => $row['kecamatan_id'],
                    'kabupaten_id' => $row['kabupaten_id'],
                    'provinsi_id' => $row['provinsi_id'],
                    'alamat' => $row['alamat'],
                    'status' => $row['status'] ?? 1,
                    'keterangan' => $row['keterangan'],
                    'user' => $row['user'],
                    'pic' => $row['pic'],
                ]
            );
        }
    }
}
