<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KasirController extends Controller
{
    public function print_notarajal($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        $qrurl = QrCode::format('png')->size(100)->generate(route('print.notarajal', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian','url));
        $pdf = Pdf::loadView('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
}
