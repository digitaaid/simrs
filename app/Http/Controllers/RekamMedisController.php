<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RekamMedisController extends Controller
{
    public function resumerajal($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $qrttddokter = QrCode::format('png')->size(70)->generate('E-Sign ' . $antrian->kunjungan->dokters->nama . ' waktu ' . $antrian->asesmenrajal->waktu_asesmen_dokter);
        $ttddokter = "data:image/png;base64," . base64_encode($qrttddokter);
        $qrurl = QrCode::format('png')->size(70)->generate(route('resume.rajal', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_resumerajal',  compact('antrian','ttddokter','url'));
        $pdf = Pdf::loadView('print.pdf_resumerajal', compact('antrian', 'ttddokter', 'url'));
        return $pdf->stream('resumerajal.pdf');
    }
}
