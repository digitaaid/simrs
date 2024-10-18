@extends('print.pdf_layout')
@section('title', 'Print Surat Kontrol BPJS')

@section('content')
    <table class="table table-sm" style="font-size: 11px;border-bottom: 2px solid black !important">
        <tr>
            <td width="10%" class="text-center" style="vertical-align: bottom;">
                <img src="{{ public_path('img/logo_bpjs_panjang.png') }}" style="height: 25px">
            </td>
            <td width="30%" style="vertical-align: bottom;">
                <b>SURAT RENCANA KONTROL</b><br>
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
                <table class="table-borderless table table-resonsive">
                    <tr>
                        <td>Kepada Yth</td>
                        <td></td>
                        <td><b>{{ $suratkontrol->namaDokter }}</b><br>
                            Sp./Sub. {{ $suratkontrol->namaPoliTujuan }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Permohonan Pemeriksaan dan Penanganan Lebih Lanjut : </td>
                    </tr>
                    <tr>
                        <td>Rencana Kontrol</td>
                        <td>:</td>
                        <td><b> {{ Carbon\Carbon::parse($suratkontrol->tglRencanaKontrol)->translatedFormat('d F Y') }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>No Kartu</td>
                        <td>:</td>
                        <td><b>{{ $peserta->noKartu }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama Peserta</td>
                        <td>:</td>
                        <td><b>{{ $peserta->nama }} ({{ $peserta->kelamin }})</b></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><b>{{ Carbon\Carbon::parse($peserta->tglLahir)->translatedFormat('d F Y') }}</b></td>
                    </tr>
                    <tr>
                        <td>No SEP</td>
                        <td>:</td>
                        <td><b>{{ $sep->noSep }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl SEP</td>
                        <td>:</td>
                        <td><b> {{ Carbon\Carbon::parse($sep->tglSep)->translatedFormat('d F Y') }}</b>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <br><br><br>
                <table class="table-borderless">
                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td><b>{{ $sep->diagnosa }}</b></td>
                    </tr>

                    <tr>
                        <td>Poliklinik</td>
                        <td>:</td>
                        <td><b>{{ $sep->poli }}</b></td>
                    </tr>
                    <tr>
                        <td>Prov. Perujuk</td>
                        <td>:</td>
                        <td><b>{{ $sep->provPerujuk->nmProviderPerujuk }}</b></td>
                    </tr>
                    <tr>
                        <td>No Rujukan</td>
                        <td>:</td>
                        <td><b>{{ $sep->provPerujuk->noRujukan }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl Rujukan</td>
                        <td>:</td>
                        <td><b>
                                {{ Carbon\Carbon::parse($sep->provPerujuk->tglRujukan)->translatedFormat('d F Y') }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Berlaku Rujukan</td>
                        <td>:</td>
                        <td><b>
                                {{ Carbon\Carbon::parse($sep->provPerujuk->tglRujukan)->addDays(90)->translatedFormat('d F Y') }}</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="50%">
                Demikian atas bantuannya diucapkan terimakasih.
                <br>
                <i> Catatan :<br>
                    Surat Kontrol hanya bisa digunakan satu kali kunjungan
                </i>
            </td>
            <td width="50%">
                <b> Mengetahui DPJP,</b>
                <br><br><br>
                <b><u>{{ $suratkontrol->namaDokterPembuat }}</u></b><br>
                Sp./Sub. {{ $sep->poli }}
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
