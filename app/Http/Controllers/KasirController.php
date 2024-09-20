<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kunjungan;
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
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($antrian->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // return view('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian','url));
        $pdf = Pdf::loadView('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian', 'url', 'ttdpetugas', 'ttdpasien'));
        return $pdf->stream($antrian->nama . '.pdf');
    }
    public function print_notarajalf($kodebooking)
    {
        $kunjungan = Kunjungan::where('kode', $kodebooking)->first();
        $resepobat = $kunjungan->resepobat;
        $resepobatdetails = $kunjungan->resepfarmasidetails;
        $qrurl = QrCode::format('png')->size(100)->generate(route('print.notarajal', $kunjungan->kode));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($kunjungan->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($kunjungan->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // return view('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian','url));
        $pdf = Pdf::loadView('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'kunjungan', 'url', 'ttdpetugas', 'ttdpasien'));
        return $pdf->stream($kunjungan->nama . '.pdf');
    }
}
