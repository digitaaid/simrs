<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FarmasiController extends Controller
{
    public function print_resep($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        // return view('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
    public function print_etiket(Request $request)
    {
        $antrian = Antrian::where('kodebooking', $request->kode)->first();
        $resepobatdetails = $antrian->resepobatdetails;
        $pdf = Pdf::loadView('livewire.farmasi.etiket-obat', compact('resepobatdetails', 'antrian'));
        return $pdf->stream('etiket.pdf');
    }
    public function print_gelang()
    {
        $pdf = Pdf::loadView('livewire.farmasi.etiket-obat');
        return $pdf->stream('etiket.pdf');
    }
}
