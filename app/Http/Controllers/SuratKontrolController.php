<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratKontrolController extends Controller
{
    public function suratkontrol_print(Request $request)
    {
        $api = new VclaimController();
        $res = $api->suratkontrol_nomor($request);
        if ($res->metadata->code == 200) {
            $suratkontrol = $res->response;
            $sep = $res->response->sep;
            $peserta = $res->response->sep->peserta;
            $pdf = Pdf::loadView('print.pdf_suratkontrol', compact(
                'suratkontrol',
                'sep',
                'peserta',
            ));
            return $pdf->stream('pdf_surat_kontrol.pdf');
        } else {
            return $res->metadata->message;
        }
    }
}
