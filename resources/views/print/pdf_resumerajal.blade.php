@extends('print.pdf_layout')
@section('title', 'Print SEP BPJS')

@section('content')
    <table class="table table-sm table-bordered" style="font-size: 10px;">
        <tr>
            <td width="10%" class="text-center" style="vertical-align: top;">
                <img src="{{ public_path('kitasehat/logokitasehat.png') }}" style="height: 30px;">
                {{-- <img src="{{ asset('kitasehat/logokitasehat.png') }}" style="height: 30px;"> --}}
            </td>
            <td width="50%" style="vertical-align: top;">
                <b>{{ strtoupper(env('APP_NAME_LONG')) }}</b><br>
                Jl. Raya Merdeka Utama Ciledug Desa Ciledug Kulon, <br>
                Kec. Ciledug, Kabupaten Cirebon, Jawa Barat 45682 <br>
                www.klinikkitasehat.com - 0812-2087-7566 (Whatsapp)
            </td>
            <td width="40%" style="vertical-align: top;">
                <table class="table-borderless">
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td><b>{{ $antrian->norm ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>{{ $antrian->nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{ \Carbon\Carbon::parse($antrian->kunjungan->tgl_lahir)->format('d F Y') }}
                                ({{ \Carbon\Carbon::parse($antrian->kunjungan->tgl_lahir)->age }} tahun)
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Sex</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($antrian->kunjungan)
                                    @if ($antrian->kunjungan->gender == 'P')
                                        Perempuan
                                    @else
                                        Laki-laki
                                    @endif
                                @endif
                            </b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="text-center" style="background-color: yellow">
            <td colspan="3">
                <b>RESUME RAWAT JALAN NO. {{ $antrian->kodebooking }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">

                <table class="table-borderless">
                    <tr>
                        <td>Keluhan Utama</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->keluhan_utama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Fisik</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pemeriksaan_fisik_perawat ?? '-' }} <br>
                            {{ $antrian->asesmenrajal->pemeriksaan_fisik_dokter ?? '-' }} <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->diagnosa ?? '' }} <br>
                            {{ $antrian->asesmenrajal->diagnosa_keperawatan ?? '' }} <br>
                            {{ $antrian->asesmenrajal->diagnosa_dokter ?? '' }} <br>


                        </td>
                    </tr>
                    <tr>
                        <td>ICD-10 Primer</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->icd1 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>ICD-10 Sekunder</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->icd2 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tindakan</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->tindakan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>ICD-9 Procedure</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->icd9 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pengobatan</td>
                        <td>:</td>
                        <td>
                            @foreach ($antrian->resepobatdetails as $item)
                                {{ $item->nama }} ({{ $item->jumlah }}) {{ $item->frekuensi }} {{ $item->waktu }} {{ $item->keterangan }} <br>
                            @endforeach
                        </td>
                    </tr>

                </table>
            </td>
            <td></td>
        </tr>

    </table>
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
