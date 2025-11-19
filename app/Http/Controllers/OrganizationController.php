<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Pengaturan;
use App\Models\PengaturanSatuSehat;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrganizationController extends SatuSehatController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "organization_id" => "required",
            "identifier" => "required",
            "name" => "required",
            "phone" => "required",
            "email" => "required|email",
            "url" => "required",
            "address" => "required",
            "postalCode" => "required",
            "province" => "required",
            "city" => "required",
            "district" => "required",
            "village" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $token = Cache::get('satusehat_access_token');
        $api = PengaturanSatuSehat::firstOrFail();
        $url =  $api->baseUrl . "/Organization";
        $data = [
            'resourceType' => 'Organization',
            'active' => true,
            'identifier' => [
                [
                    'use' => 'official',
                    'system' => 'http://sys-ids.kemkes.go.id/organization/' . $api->kode,
                    'value' => $request->identifier
                ]
            ],
            'type' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                            'code' => 'team',
                            'display' => 'Organizational team'
                        ]
                    ]
                ]
            ],
            'name' => $request->name,
            'telecom' => [
                [
                    'system' => 'phone',
                    'value' => $request->phone,
                    'use' => 'work'
                ],
                [
                    'system' => 'email',
                    'value' => $request->email,
                    'use' => 'work'
                ],
                [
                    'system' => 'url',
                    'value' => $request->url,
                    'use' => 'work'
                ]
            ],
            'address' => [
                [
                    'use' => 'work',
                    'type' => 'both',
                    'line' => [
                        $request->address
                    ],
                    'city' => 'Cirebon',
                    'postalCode' => $request->postalCode,
                    'country' => 'ID',
                    'extension' => [
                        [
                            'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                            'extension' => [
                                [
                                    'url' => 'province',
                                    'valueCode' => $request->province,
                                ],
                                [
                                    'url' => 'city',
                                    'valueCode' =>  $request->city,
                                ],
                                [
                                    'url' => 'district',
                                    'valueCode' =>  $request->district,
                                ],
                                [
                                    'url' => 'village',
                                    'valueCode' =>  $request->village,
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'partOf' => [
                'reference' => 'Organization/' . $api->kode,
                'display' => $api->nama,
            ]
        ];
        $response = Http::withToken($token)->post($url, $data);
        $res = $response->json();
        return $this->responseSatuSehat($res);
    }
    public function organization_create(Request $request)
    {
        $unit = Unit::where('kode', $request->kode)->first();
        $pengaturan = Pengaturan::firstOrFail();
        $request['organization_id'] = $pengaturan->idorganization;
        $request['identifier'] = $unit->nama;
        $request['name'] = $unit->nama;
        $request['phone'] = $pengaturan->phone;
        $request['email'] = $pengaturan->email;
        $request['url'] = $pengaturan->website;
        $request['address'] = $pengaturan->address;
        $request['postalCode'] = $pengaturan->postalCode;
        $request['province'] = $pengaturan->province;
        $request['city'] = $pengaturan->city;
        $request['district'] = $pengaturan->district;
        $request['village'] = $pengaturan->village;
        $res = $this->store($request);
        $json = $res->response;
        if ($json->resourceType == "Organization") {
            $unit->update(['idorganization' => $json->id]);
            Alert::success('Success', 'Berhasil Sync Organization');
        } else {
            Alert::error('Mohon Maaf', $res->metadata->message);
        }
        return redirect()->back();
    }
}
