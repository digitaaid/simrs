<?php

namespace App\Exports;

use App\Models\Pengaturan;
use App\Models\PengaturanAntrian;
use App\Models\PengaturanSatuSehat;
use App\Models\PengaturanVclaim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaturanAplikasiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $pengaturan = Pengaturan::first();
        $antrian = PengaturanAntrian::first();
        $vclaim = PengaturanVclaim::first();
        $satusehat = PengaturanSatuSehat::first();
        $data = collect([
            [
                $pengaturan->nama ?? null,
                $pengaturan->nama_panjang ?? null,
                $pengaturan->logo_icon ?? null,
                $pengaturan->auth_img ?? null,
                $pengaturan->anjungan_color ?? null,
                $pengaturan->anjungan_qr ?? null,
                $pengaturan->anjungan_img_info ?? null,
                $pengaturan->logo_karcis ?? null,

                $antrian->nama ?? null,
                $antrian->kode ?? null,
                $antrian->baseUrl ?? null,
                $antrian->authUrl ?? null,
                $antrian->userKey ?? null,
                $antrian->secretKey ?? null,

                $vclaim->nama ?? null,
                $vclaim->kode ?? null,
                $vclaim->baseUrl ?? null,
                $vclaim->authUrl ?? null,
                $vclaim->userKey ?? null,
                $vclaim->secretKey ?? null,

                $satusehat->nama ?? null,
                $satusehat->kode ?? null,
                $satusehat->baseUrl ?? null,
                $satusehat->authUrl ?? null,
                $satusehat->userKey ?? null,
                $satusehat->secretKey ?? null,

            ]
        ]);
        return $data;
    }
    public function headings(): array
    {
        return [
            'pengaturan-nama',
            'pengaturan-nama_panjang',
            'pengaturan-logo_icon',
            'pengaturan-auth_img',
            'pengaturan-anjungan_color',
            'pengaturan-anjungan_qr',
            'pengaturan-anjungan_img_info',
            'pengaturan-logo_karcis',

            'antrian-nama',
            'antrian-kode',
            'antrian-baseUrl',
            'antrian-authUrl',
            'antrian-userKey',
            'antrian-secretKey',

            'vclaim-nama',
            'vclaim-kode',
            'vclaim-baseUrl',
            'vclaim-authUrl',
            'vclaim-userKey',
            'vclaim-secretKey',

            'satusehat-nama',
            'satusehat-kode',
            'satusehat-baseUrl',
            'satusehat-authUrl',
            'satusehat-userKey',
            'satusehat-secretKey',
        ];
    }
}
