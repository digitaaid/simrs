<?php

namespace App\Imports;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasienImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['nama']) {
                $pasien  = Pasien::updateOrCreate(
                    [
                        'norm' => strtoupper(sprintf("%06d", $row['norm'])),
                    ],
                    [
                        'nama' => $row['nama'] ?? 'Nama Pasien Tidak Diketahui',
                        'nomorkartu' => sprintf("%013d", $row['nomorkartu']) ?? null,
                        'nik' => sprintf("%016d", $row['nik']) ?? null,
                        'idpatient' => $row['idpatient'] ?? null,
                        'nohp' => sprintf("%012d", $row['nohp']),
                        'gender' => $row['gender'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tgl_lahir' => now()->format('Y-m-d'),
                        'hakkelas' => $row['hakkelas'] ?? null,
                        'jenispeserta' => $row['jenispeserta'] ?? null,
                        'fktp' => $row['fktp'] ?? null,
                        'desa_id' => $row['desa_id'] ?? null,
                        'kecamatan_id' => $row['kecamatan_id'] ?? null,
                        'kabupaten_id' => $row['kabupaten_id'] ?? null,
                        'provinsi_id' => $row['provinsi_id'] ?? null,
                        'alamat' => $row['alamat'] ?? null,
                        'keterangan' => $row['keterangan'] ?? null,
                        'status' => $row['status'] ?? 1,
                        'user' => $row['user'] ?? auth()->user()->id,
                        'pic' => $row['pic'] ?? auth()->user()->name,
                        'updated_at' => $row['updated_at'] ?? now(),
                        'created_at' => $row['created_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
