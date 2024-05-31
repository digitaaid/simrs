<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SepController extends Controller
{
    public function sep_print(Request $request)
    {
        $vclaim = new VclaimController();
        $res = $vclaim->sep_nomor($request);
        if ($res->metadata->code == 200) {
            $sep = $res->response;
            // return view('print.pdf_sep', compact('sep'));
            $pdf = Pdf::loadView('print.pdf_sep', compact('sep'));
            return $pdf->stream('sep.pdf');
        } else {

        }
    }
}
