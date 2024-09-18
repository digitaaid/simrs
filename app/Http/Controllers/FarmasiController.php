<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\ResepFarmasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FarmasiController extends Controller
{
    public function print_resep($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.resep', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
    public function print_resepfarmasi($kodebooking)
    {
        $resepobat = ResepFarmasi::where('kode', $kodebooking)->first();
        $kunjungan = $resepobat->kunjungan;
        $resepobatdetails = $resepobat->resepfarmasidetails;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.resepfarmasi', $resepobat->kode));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'kunjungan', 'url'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
    public function print_etiket(Request $request)
    {
        $antrian = Antrian::where('kodebooking', $request->kode)->first();
        $kunjungan = $antrian->kunjungan ?? null;
        if (!$kunjungan) {
            $kunjungan = Kunjungan::where('kode', $request->kode)->first();
        }
        $resepobatdetails = $kunjungan->resepobatdetails;
        $pdf = Pdf::loadView('livewire.farmasi.etiket-obat', compact('resepobatdetails', 'kunjungan'));
        return $pdf->stream('etiket.pdf');
    }
    public function print_gelang()
    {
        $pdf = Pdf::loadView('livewire.farmasi.etiket-obat');
        return $pdf->stream('etiket.pdf');
    }
}
