<?php

namespace App\Imports;

use App\Models\Pengaturan;
use App\Models\PengaturanAntrian;
use App\Models\PengaturanSatuSehat;
use App\Models\PengaturanVclaim;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengaturanAplikasiImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['pengaturan_nama']) {
                Pengaturan::updateOrCreate([
                    'nama' => $row['pengaturan_nama'],
                ], [
                    'nama_panjang' => $row['pengaturan_nama_panjang'],
                    'logo_icon' => $row['pengaturan_logo_icon'],
                    'auth_img' => $row['pengaturan_auth_img'],
                    'anjungan_color' => $row['pengaturan_anjungan_color'],
                    'anjungan_qr' => $row['pengaturan_anjungan_qr'],
                    'anjungan_img_info' => $row['pengaturan_anjungan_img_info'],
                    'logo_karcis' => $row['pengaturan_logo_karcis'],
                    'antrian_nama' => $row['antrian_nama'],
                ]);
            }
            if ($row['antrian_nama']) {
                PengaturanAntrian::updateOrCreate([
                    'nama' => $row['antrian_nama'],
                ], [
                    'kode' => $row['antrian_kode'],
                    'baseUrl' => $row['antrian_baseurl'],
                    'authUrl' => $row['antrian_authurl'],
                    'userKey' => $row['antrian_userkey'],
                    'secretKey' => $row['antrian_secretkey'],
                ]);
            }
            if ($row['vclaim_nama']) {
                PengaturanVclaim::updateOrCreate([
                    'nama' => $row['vclaim_nama'],
                ], [
                    'kode' => $row['vclaim_kode'],
                    'baseUrl' => $row['vclaim_baseurl'],
                    'authUrl' => $row['vclaim_authurl'],
                    'userKey' => $row['vclaim_userkey'],
                    'secretKey' => $row['vclaim_secretkey'],
                ]);
            }
            if ($row['satusehat_nama']) {
                PengaturanSatuSehat::updateOrCreate([
                    'nama' => $row['satusehat_nama'],
                ], [
                    'kode' => $row['satusehat_kode'],
                    'baseUrl' => $row['satusehat_baseurl'],
                    'authUrl' => $row['satusehat_authurl'],
                    'userKey' => $row['satusehat_userkey'],
                    'secretKey' => $row['satusehat_secretkey'],
                ]);
            }
            if ($row['whatsapp_nama']) {
                PengaturanSatuSehat::updateOrCreate([
                    'nama' => $row['whatsapp_nama'],
                ], [
                    'kode' => $row['whatsapp_kode'],
                    'baseUrl' => $row['whatsapp_baseurl'],
                    'authUrl' => $row['whatsapp_authurl'],
                    'userKey' => $row['whatsapp_userkey'],
                    'secretKey' => $row['whatsapp_secretkey'],
                ]);
            }
        }
    }
}
