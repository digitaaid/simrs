<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class LocationController extends SatuSehatController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "organization_id" => "required",
            "identifier" => "required",
            "name" => "required",
            "description" => "required",
            "phone" => "required",
            "email" => "required|email",
            "url" => "required",
            "address" => "required",
            "postalCode" => "required",
            "province" => "required",
            "city" => "required",
            "district" => "required",
            "longitude" => "required",
            "latitude" => "required",
            "altitude" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError('Data Belum Lengkap ' . $validator->errors()->first(), 400);
        }
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url =  $api->base_url . "/Location";
        $data = [
            "resourceType" => "Location",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/location/" . $request->organization_id,
                    "value" => $request->identifier,
                ]
            ],
            "status" => "active",
            "name" => $request->name,
            "description" => $request->description,
            "mode" => "instance",
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => $request->phone,
                    "use" => "work"
                ],
                [
                    "system" => "email",
                    "value" =>  $request->email,
                ],
                [
                    "system" => "url",
                    "value" =>  $request->url,
                    "use" => "work"
                ]
            ],
            "address" => [
                "use" => "work",
                "line" => [
                    $request->address,
                ],
                "city" => $request->city,
                "postalCode" =>  $request->postalCode,
                "country" => "ID",
                "extension" => [
                    [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension" => [
                            [
                                "url" => "province",
                                "valueCode" => $request->province,
                            ],
                            [
                                "url" => "city",
                                "valueCode" => $request->city,
                            ],
                            [
                                "url" => "district",
                                "valueCode" => $request->district,
                            ],
                            [
                                "url" => "village",
                                "valueCode" => $request->village,
                            ],
                        ]
                    ]
                ]
            ],
            "physicalType" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code" => "ro",
                        "display" => "Room"
                    ]
                ]
            ],
            "position" => [
                "longitude" => $request->longitude,
                "latitude" => $request->latitude,
                "altitude" => $request->altitude,
            ],
            "managingOrganization" => [
                "reference" => "Organization/" . $request->organization_id,
            ]
        ];
        $response = Http::withToken($token)->post($url, $data);
        $res = $response->json();
        return $this->responseSatuSehat($res);
    }
    // public function location_sync(Request $request)
    // {
    //     $unit = Unit::where('kode', $request->kode)->first();
    //     $pengaturan = Pengaturan::firstOrFail();
    //     $request['organization_id'] = $unit->idorganization;
    //     $request['identifier'] = $unit->kode;
    //     $request['name'] = $unit->nama;
    //     $request['phone'] = $pengaturan->phone;
    //     $request['email'] = $pengaturan->email;
    //     $request['url'] = $pengaturan->website;
    //     $request['address'] = $pengaturan->address;
    //     $request['postalCode'] = $pengaturan->postalCode;
    //     $request['province'] = $pengaturan->province;
    //     $request['city'] = $pengaturan->city;
    //     $request['district'] = $pengaturan->district;
    //     $request['village'] = $pengaturan->village;
    //     $request['longitude'] = floatval($pengaturan->longitude);
    //     $request['latitude'] = floatval($pengaturan->latitude);
    //     $request['altitude'] = floatval($pengaturan->altitude);
    //     $request['description'] = "Unit " . $unit->nama . " Lokasi " . $unit->lokasi;
    //     $res = $this->store($request);
    //     if ($res->metadata->code == 200) {
    //         $json = $res->response;
    //         $unit->update([
    //             'idlocation' => $json->id,
    //         ]);
    //         Alert::success('Success', 'Berhasil Sync Location');
    //     } else {
    //         Alert::error('Mohon Maaf', $res->metadata->message);
    //     }
    //     return redirect()->back();
    // }
}
