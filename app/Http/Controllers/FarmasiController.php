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
        $kunjungan = Kunjungan::where('kode', $kodebooking)->first();
        $resepobat = $kunjungan->resepobat;
        $resepobatdetails = $kunjungan->resepobatdetails;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.resep', $kunjungan->kode));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($kunjungan->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // return view('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'kunjungan', 'url', 'ttdpasien', 'ttdpetugas'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
    public function print_resepfarmasi($kodebooking)
    {
        $kunjungan = Kunjungan::where('kode', $kodebooking)->first();
        $resepobat = $kunjungan->resepfarmasi;
        $resepobatdetails = $kunjungan->resepfarmasidetails;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.resepfarmasi', $resepobat->kode));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($kunjungan->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // return view('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'antrian', 'url'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'kunjungan', 'url', 'ttdpasien', 'ttdpetugas'));
        return $pdf->stream('etiket.pdf');
        // return view('livewire.farmasi.print_resep_obat', compact('antrian', 'resepobat', 'resepobatdetails'));
    }
    public function print_penjualan_obat($kode)
    {
        $resep = ResepFarmasi::firstWhere('kode', $kode);
        $resepobatdetails = $resep->resepfarmasidetails;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.penjualanobat', $resep->kode));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_penjualan_obat', compact('resepobatdetails', 'resep', 'url'));
        $pdf = Pdf::loadView('print.pdf_penjualan_obat', compact('resepobatdetails', 'resep',  'url'));
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
