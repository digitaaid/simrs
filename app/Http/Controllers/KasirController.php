<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function print_notarajal($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        // return view('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian'));
        $pdf = Pdf::loadView('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
}
