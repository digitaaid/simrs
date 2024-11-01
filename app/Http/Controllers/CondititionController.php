<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CondititionController extends SatuSehatController
{
    public function conditition_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "code_idc10" => "required",
            "name_icd10" => "required",
            "patient_id" => "required",
            "patient_name" => "required",
            "encounter_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError('Data Belum Lengkap ' . $validator->errors()->first(), 400);
        }
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url =  $api->base_url .  "/Condition";
        $data = [
            "resourceType" => "Condition",
            "clinicalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                        "code" => "active",
                        "display" => "Active"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                            "code" => "encounter-diagnosis",
                            "display" => "Encounter Diagnosis"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://hl7.org/fhir/sid/icd-10",
                        "code" =>  $request->code_idc10,
                        "display" =>  $request->name_icd10,
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/" . $request->patient_id,
                "display" => $request->patient_name,
            ],
            "encounter" => [
                "reference" => "Encounter/" . $request->encounter_id,
                "display" => "Kunjungan " . $request->patient_name,
            ]
        ];
        $response = Http::withToken($token)->post($url, $data);
        $res = $response->json();
        return $this->responseSatuSehat($res);
    }
}
