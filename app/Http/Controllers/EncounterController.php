<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class EncounterController extends SatuSehatController
{
    // public function encounter_sync(Request $request)
    // {
    //     $antrian = Antrian::firstWhere('kodebooking', $request->kodebooking);
    //     $pasien = $antrian->pasien;
    //     $kunjungan = $antrian->kunjungan;
    //     $unit = $kunjungan->units;
    //     $dokter = $kunjungan->dokters;
    //     $request['patient_id'] = $pasien->idpatient;
    //     if ($pasien->idpatient == null) {
    //         $request['norm'] = $pasien->norm;
    //         $api = new PatientController();
    //         $res = $api->patient_get_id($request);
    //         if ($res->metadata->code == 200) {
    //             $id = $res->response->entry[0]->resource->id;
    //             $request['patient_id'] = $id;
    //         } else {
    //             Alert::error('Mohon Maaf', $res->metadata->message);
    //             return redirect()->back();
    //         }
    //     }
    //     $pengaturan = Pengaturan::firstOrFail();
    //     $request['organization_id'] =  $pengaturan->idorganization;
    //     $request['patient_name'] = $pasien->nama;
    //     $request['practitioner_id'] = $dokter->idpractitioner;
    //     $request['practitioner_name'] = $dokter->namadokter;
    //     $request['location_id'] = $unit->idlocation;
    //     $request['location_name'] = 'Lokasi poliklinik ' . $unit->nama;
    //     $request['encounter_id'] = $kunjungan->kode;
    //     $request['start'] = Carbon::parse($kunjungan->tgl_masuk);
    //     if (!$kunjungan->id_satusehat) {
    //         $res = $this->encounter_create($request);
    //         if ($res->metadata->code == 200) {
    //             $id = $res->response->id;
    //             $kunjungan->update([
    //                 'idencounter' => $id,
    //             ]);
    //             Alert::success('Success', 'Kunjungan telah syncron dengan satusehat id ' . $kunjungan->idencounter);
    //         } else {
    //             Alert::error('Mohon Maaf', $res->metadata->message);
    //         }
    //     } else {
    //         Alert::error('Mohon Maaf', 'Kunjungan telah syncron dengan satusehat id ' . $kunjungan->idencounter);
    //     }
    //     return redirect()->back();
    // }
    public function encounter_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "organization_id" => "required",
            "patient_id" => "required",
            "patient_name" => "required",
            "practitioner_id" => "required",
            "practitioner_name" => "required",
            "location_id" => "required",
            "location_name" => "required",
            "encounter_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError('Data Belum Lengkap ' . $validator->errors()->first(), 400);
        }
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url =  $api->base_url .  "/Encounter";
        $data = [
            "resourceType" => "Encounter",
            "status" => "arrived",
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ],
            "subject" => [
                "reference" => "Patient/" . $request->patient_id,
                "display" => $request->patient_name,
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/" . $request->practitioner_id,
                        "display" => $request->practitioner_name,
                    ]
                ]
            ],
            "period" => [
                "start" => $request->start
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/" . $request->location_id,
                        "display" => $request->location_name,
                    ]
                ]
            ],
            "statusHistory" => [
                [
                    "status" => "arrived",
                    "period" => [
                        "start" => $request->start
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/" . $request->organization_id
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/" . $request->organization_id,
                    "value" => $request->encounter_id
                ]
            ]
        ];
        $response = Http::withToken($token)->post($url, $data);
        $res = $response->json();
        return $this->responseSatuSehat($res);
    }
}
