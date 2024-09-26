<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SepController extends Controller
{
    public function sep_print(Request $request)
    {
        $vclaim = new VclaimController();
        $res = $vclaim->sep_nomor($request);
        if ($res->metadata->code == 200) {
            $sep = $res->response;
            $peserta = $sep->peserta;
            $qrurl = QrCode::format('png')->size(150)->generate($peserta->noKartu);
            $qrpasien = "data:image/png;base64," . base64_encode($qrurl);
            $qrurl = QrCode::format('png')->size(150)->generate(auth()->user()->name);
            $qrpetugas = "data:image/png;base64," . base64_encode($qrurl);
            // return view('print.pdf_sep', compact('sep'));
            $pdf = Pdf::loadView('print.pdf_sep', compact('sep', 'qrpasien', 'qrpetugas'));
            return $pdf->stream('sep.pdf');
        }
    }
}
