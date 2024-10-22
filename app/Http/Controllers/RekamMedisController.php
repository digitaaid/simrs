<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kunjungan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RekamMedisController extends Controller
{
    public function resumerajal($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        if ($antrian?->asesmenrajal?->waktu_asesmen_dokter) {
            $qrttddokter = QrCode::format('png')->size(150)->generate('E-Sign ' . $antrian->kunjungan->dokters->nama . ' waktu ' . $antrian->asesmenrajal->waktu_asesmen_dokter);
        } else {
            $qrttddokter = QrCode::format('png')->size(150)->generate($antrian->kunjungan->dokters->nama . ' belum melakukan E-Sign pada resume rawat jalan ini');
        }
        $ttddokter = "data:image/png;base64," . base64_encode($qrttddokter);

        $qrurl = QrCode::format('png')->size(150)->generate(route('resume.rajal', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        $resepobatdetails = $antrian->resepobatdetails;
        // return view('print.pdf_resumerajal',  compact('antrian','ttddokter','url'));
        $pdf = Pdf::loadView('print.pdf_resumerajal', compact('antrian', 'ttddokter', 'url', 'resepobatdetails'));
        return $pdf->stream('resumerajal.pdf');
    }
    public function resumerajalf($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        if ($antrian?->asesmenrajal?->waktu_asesmen_dokter) {
            $qrttddokter = QrCode::format('png')->size(150)->generate('E-Sign ' . $antrian->kunjungan->dokters->nama . ' waktu ' . $antrian->asesmenrajal->waktu_asesmen_dokter);
        } else {
            $qrttddokter = QrCode::format('png')->size(150)->generate($antrian->kunjungan->dokters->nama . ' belum melakukan E-Sign pada resume rawat jalan ini');
        }
        $ttddokter = "data:image/png;base64," . base64_encode($qrttddokter);

        $qrurl = QrCode::format('png')->size(150)->generate(route('resume.rajal', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        $resepobatdetails = $antrian->resepfarmasidetails;
        // return view('print.pdf_resumerajal',  compact('antrian','ttddokter','url'));
        $pdf = Pdf::loadView('print.pdf_resumerajal', compact('antrian', 'ttddokter', 'url', 'resepobatdetails'));
        return $pdf->stream('resumerajal.pdf');
    }
    public function rajal_print($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        // ttd dokter
        if ($antrian?->asesmenrajal?->waktu_asesmen_dokter) {
            $qrttddokter = QrCode::format('png')->size(150)->generate('E-Sign ' . $antrian->kunjungan->dokters->nama . ' waktu ' . $antrian->asesmenrajal->waktu_asesmen_dokter);
        } else {
            $qrttddokter = QrCode::format('png')->size(150)->generate($antrian->kunjungan->dokters->nama . ' belum melakukan E-Sign pada resume rawat jalan ini');
        }
        $ttddokter = "data:image/png;base64," . base64_encode($qrttddokter);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($antrian->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // url
        $qrurl = QrCode::format('png')->size(150)->generate(route('rekammedis.rajal.print', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        // return view('print.pdf_rekammedis_rajal',  compact('antrian','ttddokter','url'));
        $pdf = Pdf::loadView('print.pdf_rekammedis_rajal', compact('antrian', 'resepobat', 'resepobatdetails', 'ttddokter', 'ttdpasien', 'ttdpetugas', 'url'));
        return $pdf->stream('resumerajal.pdf');
    }
    public function rajal_printf($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        // ttd dokter
        if ($antrian?->asesmenrajal?->waktu_asesmen_dokter) {
            $qrttddokter = QrCode::format('png')->size(150)->generate('E-Sign ' . $antrian->kunjungan->dokters->nama . ' waktu ' . $antrian->asesmenrajal->waktu_asesmen_dokter);
        } else {
            $qrttddokter = QrCode::format('png')->size(150)->generate($antrian->kunjungan->dokters->nama . ' belum melakukan E-Sign pada resume rawat jalan ini');
        }
        $ttddokter = "data:image/png;base64," . base64_encode($qrttddokter);
        // ttd d pasien
        $qrttdpasien = QrCode::format('png')->size(150)->generate($antrian->nama);
        $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // ttd petugas
        $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // url
        $qrurl = QrCode::format('png')->size(150)->generate(route('rekammedis.rajal.print', $antrian->kodebooking));
        $url = "data:image/png;base64," . base64_encode($qrurl);
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepfarmasidetails;
        // return view('print.pdf_rekammedis_rajal',  compact('antrian','ttddokter','url'));
        $pdf = Pdf::loadView('print.pdf_rekammedis_rajal', compact('antrian', 'resepobat', 'resepobatdetails', 'ttddokter', 'ttdpasien', 'ttdpetugas', 'url'));
        return $pdf->stream('resumerajal.pdf');
    }
    public function print_cpptranap(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kode)->first();
        $inputs = $kunjungan->cppt_ranap;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.cpptranap') . "?kode=" . $kunjungan->kode);
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_cpptranap',  compact('kunjungan', 'inputs', 'url'));
        $pdf = Pdf::loadView('print.pdf_cpptranap', compact('kunjungan', 'inputs', 'url'));
        return $pdf->stream('pdf_cpptranap.pdf');
    }
    public function print_resumeranap(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kode)->first();
        $resume = $kunjungan->resume_ranap;
        $qrurl = QrCode::format('png')->size(150)->generate(route('print.resumeranap') . "?kode=" . $kunjungan->kode);
        $url = "data:image/png;base64," . base64_encode($qrurl);
        // return view('print.pdf_resumeranap',  compact('kunjungan', 'resume', 'url'));
        $pdf = Pdf::loadView('print.pdf_resumeranap', compact('kunjungan', 'resume', 'url'));
        return $pdf->stream('pdf_resumeranap.pdf');
    }

}
