<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class IcareController extends ApiController
{
    public function api()
    {
        $api = Integration::where('name', 'Vclaim BPJS')->first();
        $data['base_url'] =  $api->base_url;
        $data['user_id'] = $api->user_id;
        $data['user_key'] = $api->user_key;
        $data['secret_key'] = $api->secret_key;
        return json_decode(json_encode($data));
    }
    public function signature()
    {
        $cons_id =  $this->api()->user_id;
        $secretKey = $this->api()->secret_key;
        $userkey = $this->api()->user_key;

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);

        $response = array(
            'user_key' => $userkey,
            'x-cons-id' => $cons_id,
            'x-timestamp' => $tStamp,
            'x-signature' => $encodedSignature,
            'decrypt_key' => $cons_id . $secretKey . $tStamp,
        );
        return $response;
    }
    public function stringDecrypt($key, $string)
    {
        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        $output = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        return $output;
    }
    public function response_decrypt($response, $signature)
    {
        $code = json_decode($response->body())->metaData->code;
        $message = json_decode($response->body())->metaData->message;
        if ($code == 200 || $code == 1) {
            $response = json_decode($response->body())->response ?? null;
            $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response);
            $data = json_decode($decrypt);
            if ($code == 1)
                $code = 200;
            return $this->sendResponse($data, $code);
        } else {
            $response = json_decode($response);
            return $this->sendError($message, $code);
        }
    }
    public function icare(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "nomorkartu" => "required",
                "kodedokter" =>  "required",
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first(),  400);
            }
            $url =  "https://apijkn.bpjs-kesehatan.go.id/wsihs/api/rs/validate";
            $signature = $this->signature();
            $signature['Content-Type'] = 'application/json';
            $response = Http::withHeaders($signature)
                ->send('POST', $url, [
                    'body' => '{
                        "param": "' . $request->nomorkartu . '",
                        "kodedokter": ' . $request->kodedokter . '
                    }'
                ]);
            return $this->response_decrypt($response, $signature);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(),  500);
        }
    }
}
