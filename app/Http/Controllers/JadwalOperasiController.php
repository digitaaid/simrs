<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalOperasiController extends ApiController
{
    public function jadwal_operasi_rs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "tanggalawal" => "required|date",
            "tanggalakhir" => "required|date",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $jadwals = [];
        for ($i = 1; $i < 3; $i++) {
            $jadwals[] = [
                "kodebooking" => 'OK' . Carbon::now()->format('Ymd') . $i,
                "tanggaloperasi" => Carbon::now()->format('Y-m-d'),
                "jenistindakan" => 'test briding jadwal operasi',
                "kodepoli" => 'BED',
                "namapoli" =>  "BEDAH",
                "terlaksana" =>  0,
                "nopeserta" =>  '0000067026778',
                "lastupdate" => Carbon::now()->timestamp * 1000,
            ];
        }
        $response = [
            "list" => $jadwals
        ];
        return $this->sendResponse($response,  200);
    }
    public function jadwal_operasi_pasien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nopeserta" => "required|digits:13",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $jadwals = [];
        for ($i = 1; $i < 3; $i++) {
            $jadwals[] = [
                "kodebooking" => 'OK' . Carbon::now()->format('Ymd') . $i,
                "tanggaloperasi" => Carbon::now()->format('Y-m-d'),
                "jenistindakan" => 'test briding jadwal operasi',
                "kodepoli" => 'BED',
                "namapoli" =>  "BEDAH",
                "terlaksana" => 0,
            ];
        }
        $response = [
            "list" => $jadwals
        ];
        return $this->sendResponse($response,  200);
    }
}
