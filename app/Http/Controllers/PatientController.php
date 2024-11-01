<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PatientController extends SatuSehatController
{
    public function patient_by_nik(Request $request)
    {
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url = $api->base_url . "/Patient?identifier=https://fhir.kemkes.go.id/id/nik|" . $request->nik;
        $response = Http::withToken($token)->get($url);
        $data = $response->json();
        return $this->responseSatuSehat($data);
    }
    public function get_patien_id(Request $request)
    {
        $pasien = Pasien::where('nik', $request->nik)->first();
        // $request['nik'] = $pasien->nik;
        $request['nik'] = "9271060312000001";
        if ($request->nik) {
            $res = $this->patient_by_nik($request);
            if ($res->metadata->code == 200) {
                if ($res->response->entry) {
                    $id = $res->response->entry[0]->resource->id;
                    $pasien->update([
                        'idpatient' => $id
                    ]);
                } else {
                    $data = [
                        'metadata' => [
                            'message' => "Data Pasien Tidak Ditemukan Di Server Satu Sehat",
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
    // public function patient_sync(Request $request)
    // {
    //     $pasien = Pasien::where('norm', $request->norm)->first();
    //     $request['nik'] = $pasien->nik_bpjs;
    //     if ($request->nik) {
    //         $res = $this->patient_by_nik($request);
    //         if ($res->metadata->code == 200) {
    //             if ($res->response->entry) {
    //                 $id = $res->response->entry[0]->resource->id;
    //                 $pasien->update([
    //                     'idpatient' => $id
    //                 ]);
    //                 Alert::success('Sukses', 'Berhasil Sync Patient Satu Sehat');
    //             } else {
    //                 Alert::error('Mohon Maaf', 'Data Pasien Tidak Ditemukan Di Server Satu Sehat');
    //             }
    //         } else {
    //             Alert::error('Mohon Maaf', $res->metadata->message);
    //         }
    //     } else {
    //         Alert::error('Mohon Maaf', 'Pasien belum memiliki nik');
    //     }
    //     return redirect()->back();
    // }
}
