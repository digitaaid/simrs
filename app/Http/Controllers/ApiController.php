<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendAntrian($data, $message)
    {
        $response = [
            'metadata' => [
                'message' => $message,
                'code' =>  201,
            ],
            'response' => $data,
        ];
        return json_decode(json_encode($response));
    }
    public function sendResponse($data, int $code = 200)
    {
        $response = [
            'metadata' => [
                'message' => 'Ok',
                'code' =>  $code,
            ],
            'response' => $data,
        ];
        return json_decode(json_encode($response));
    }
    public function sendError($error,  $code = 404)
    {
        $code = $code ?? 404;
        $response = [
            'metadata' => [
                'message' => $error,
                'code' => $code,
            ],
        ];
        return json_decode(json_encode($response));
    }
}
