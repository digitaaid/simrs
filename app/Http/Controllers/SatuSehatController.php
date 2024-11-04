<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SatuSehatController extends ApiController
{
    public function token_generate()
    {
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url = $api->auth_url . "/accesstoken?grant_type=client_credentials";
        $response = Http::asForm()->post($url, [
            'client_id' => $api->user_key,
            'client_secret' => $api->secret_key,
        ]);
        if ($response->successful()) {
            $json = $response->json();
            Cache::put('satusehat_access_token', $json['access_token'], $json['expires_in']);
            Cache::put('satusehat_client_id', $json['access_token'], $json['expires_in']);
            Cache::put('satusehat_application_name', $json['access_token'], $json['expires_in']);
            // dd($json);
            // Token::updateOrCreate(
            //     [
            //         'organization_name' => $json['organization_name'],
            //     ],
            //     [
            //         'access_token' => $json['access_token'],
            //         'application_name' => $json['application_name'],
            //         'token_type' => $json['token_type'],
            //         'issued_at' => $json['issued_at'],
            //     ]
            // );
            Log::notice('Auth Token Satu Sehat : ' . $json['access_token']);
        }
        return response()->json($response->json(), $response->status());
    }
    public function responseSatuSehat($data)
    {
        if ($data['resourceType'] == "OperationOutcome") {
            $response = [
                'response' => $data,
                'metadata' => [
                    'message' => $data['issue'][0]['code'],
                    'code' => 500,
                ],
            ];
            if ($data['issue'][0]['code'] == "invalid-access-token") {
                $token = $this->token_generate();
            }
        } else {
            $response = [
                'response' => $data,
                'metadata' => [
                    'message' => "Ok",
                    'code' => 200,
                ],
            ];
        }
        return json_decode(json_encode($response));
    }
}
