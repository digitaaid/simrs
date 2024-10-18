<?php

namespace App\Http\Controllers;

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
        return $this->sendError("Klinik belum memiliki jadwal operasi.", 400);
    }
    public function jadwal_operasi_pasien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nopeserta" => "required|digits:13",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        return $this->sendError("Klinik belum memiliki jadwal operasi.", 400);
    }
}
