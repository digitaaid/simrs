<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function sendAntrian($data, $message)
    {
        $response = [
            'response' => $data,
            'metadata' => [
                'message' => $message,
                'code' =>  201
            ],
        ];
        return new JsonResponse($response);
        // return response($response)
        //     ->header('Content-Type', 'application/json');
    }
    public function sendResponse($data, int $code = 200)
    {
        $response = [
            'response' => $data,
            'metadata' => [
                'message' => 'Ok',
                'code' =>  $code,
            ],
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
