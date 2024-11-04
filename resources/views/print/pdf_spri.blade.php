@extends('print.pdf_layout')
@section('title', 'Print Surat Kontrol BPJS')

@section('content')
    <table class="table table-sm" style="font-size: 11px;border-bottom: 2px solid black !important">
        <tr>
            <td width="10%" class="text-center" style="vertical-align: bottom;">
                <img src="{{ public_path('img/logo_bpjs_panjang.png') }}" style="height: 25px">
            </td>
            <td width="30%" style="vertical-align: bottom;">
                <b>SURAT RENCANA INAP</b><br>
                <b>KLINIK UTAMA KITA SEHAT</b><br>
            </td>
            <td width="50%" style="vertical-align: bottom;">
                <b>NO. {{ $suratkontrol->noSuratKontrol }}</b><br>
            </td>
            <td width="10%" class="text-center" style="vertical-align: bottom;">
                <img src="{{ public_path('kitasehat/logokitasehat.png') }}" style="height: 30px;">
            </td>
        </tr>
    </table>
    <table class="table table-sm" style="font-size: 11px">
        <tr>
            <td width="50%">
                <table class="table-borderless table" >
                    <tr>
                        <td colspan="3">Permohonan Pemeriksaan dan Penanganan Lebih Lanjut : </td>
                    </tr>
                    <tr>
                        <td>No Kartu</td>
                        <td>:</td>
                        <td><b>{{ $peserta->nomorkartu }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama Peserta</td>
                        <td>:</td>
                        <td><b>{{ $peserta->nama }} ({{ $peserta->gender }})</b></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($peserta->tgl_lahir)
                                    {{ Carbon\Carbon::parse($peserta->tgl_lahir)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td>
                            <b></b>
                        </td>
                    </tr>
                    <tr>
                        <td>Rencana Inap</td>
                        <td>:</td>
                        <td><b>{{ $suratkontrol->tglRencanaKontrol }}</b></td>
                    </tr>
                </table>
            </td>
            <td width="50%">
            </td>
        </tr>
        <tr>
            <td width="50%">
                Demikian atas bantuannya diucapkan terimakasih.
                <br>
                <i> Catatan :<br>
                    Surat SPRI ini hanya bisa digunakan satu kali kunjungan rawat inap
                </i>
            </td>
            <td width="50%">
                <b> Mengetahui DPJP,</b>
                <br><br><br>
                <b><u>{{ $suratkontrol->namaDokter }}</u></b><br>
                Sp./Sub. {{ $suratkontrol->namaPoliTujuan}}
            </td>
        </tr>
    </table>
    <style>
        @page {
            size: 241mm 105mm;
            margin-left: 30mm
        }
    </style>
@endsection
