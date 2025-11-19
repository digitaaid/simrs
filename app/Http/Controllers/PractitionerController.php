<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Integration;
use App\Models\PengaturanSatuSehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PractitionerController extends SatuSehatController
{
    public function practitioner_by_nik(Request $request)
    {
        $token = Cache::get('satusehat_access_token');
        $api = PengaturanSatuSehat::first();
        $url = $api->baseUrl . "/Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|" . $request->nik;
        $response = Http::withToken($token)->get($url);
        $data = $response->json();
        return $this->responseSatuSehat($data);
    }
    public function get_practitioner_id(Request $request)
    {
        $dokter = Dokter::where('nik', $request->nik)->first();
        $request['nik'] = $dokter->nik;
        if ($request->nik) {
            $res = $this->practitioner_by_nik($request);
            $dokter->update([
                'idpractitioner' => 'N10000001'
            ]);
            if ($res->metadata->code == 200) {
                if ($res->response->entry) {
                    $id = $res->response->entry[0]->resource->id;
                    $dokter->update([
                        // 'idpractitioner' => $id
                        'idpractitioner' => 'N10000001'
                    ]);
                } else {
                    $data = [
                        'metadata' => [
                            'message' => "Data Dokter Tidak Ditemukan Di Server Satu Sehat",
                            'code' => 404,
                        ],
                    ];
                    $res = json_decode(json_encode($data));
                }
            }
        } else {
            $data = [
                'metadata' => [
                    'message' => "Pasien belum memiliki nik",
                    'code' => 404,
                ],
            ];
            $res = json_decode(json_encode($data));
        }
        return $res;
    }

    // public function practitioner_sync(Request $request)
    // {
    //     $dokter = Dokter::where('kodedokter', $request->kodedokter)->first();
    //     $request['nik'] = $dokter->nik;
    //     if ($request->nik) {
    //         $res = $this->practitioner_by_nik($request);
    //         if ($res->metadata->code == 200) {
    //             if (count($res->response->entry)) {
    //                 $id = $res->response->entry[0]->resource->id;
    //                 $dokter->update([
    //                     'idpractitioner' => $id
    //                 ]);
    //                 Alert::success('Success', 'Berhasil Sync Practitioner Satu Sehat');
    //             } else {
    //                 Alert::error('Mohon Maaf', $res->metadata->message);
    //             }
    //         } else {
    //             Alert::error('Mohon Maaf', 'Gagal Sync Practitioner ' . $res->metadata->message);
    //         }
    //     } else {
    //         Alert::error('Mohon Maaf', 'Dokter belum memiliki nik');
    //     }
    //     return redirect()->back();

    // }
}
