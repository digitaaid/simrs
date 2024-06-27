@extends('print.pdf_layout')
@section('title', 'Resume Rawat Jalan')

@section('content')
    <table class="table table-sm table-bordered" style="font-size: 9px;">
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
        <tr class="text-center" style="background: yellow">
            <td colspan="3">
                <b>RESUME RAWAT JALAN</b>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <img src="{{ $url }}" width="40px">
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td><b>
                                {{ $antrian->kunjungan->tgl_masuk ? \Carbon\Carbon::parse($antrian->kunjungan->tgl_masuk)->format('d F Y H:i') : '-' }}
                            </b></td>
                    </tr>
                    <tr>
                        <td>Unit / Ruangan</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->units->nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->dokters->nama ?? '-' }}</b></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Penjamin</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($antrian->jenispasien == 'JKN')
                                    BPJS / JKN
                                @else
                                    UMUM / NON-JKN
                                @endif
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Pelayanan</td>
                        <td>:</td>
                        <td><b>Rawat Jalan</b></td>
                    </tr>
                    <tr>
                        <td>Kode Kunjungan</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->kode ?? '-' }}</b></td>
                    </tr>
                </table>
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
                        <td style="white-space:nowrap;">Pemeriksaan Fisik</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pemeriksaan_fisik_perawat ?? '' }}
                            {{ $antrian->asesmenrajal->pemeriksaan_fisik_dokter ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->diagnosa ?? '' }} <br>
                            {{ $antrian->asesmenrajal->diagnosa_dokter ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-nowarp">ICD-10 Primer</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->icd1 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>ICD-10 Sekunder</td>
                        <td>:</td>
                        <td>
                            @if ($antrian->asesmenrajal?->icd2)
                                @foreach (explode(';', $antrian->asesmenrajal?->icd2) as $item)
                                    {{ $item }} <br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tindakan</td>
                        <td>:</td>
                        <td>{{ $antrian->asesmenrajal->tindakan_medis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>ICD-9 Procedure</td>
                        <td>:</td>
                        <td>
                            @if ($antrian->asesmenrajal?->icd9)
                                @foreach (explode(';', $antrian->asesmenrajal?->icd9) as $item)
                                    {{ $item }} <br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pengobatan</td>
                        <td>:</td>
                        <td>
                            @foreach ($antrian->resepobatdetails as $item)
                                <b>R/ {{ $item->nama }}</b> ({{ $item->jumlah }}) {{ $item->frekuensi }}
                                {{ $item->waktu }}
                                {{ $item->keterangan }} <br>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Tekanan Darah</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->sistole ?? '-' }}/{{ $antrian->asesmenrajal->distole ?? '-' }} mmHg
                        </td>
                    </tr>
                    <tr>
                        <td>Denyut Nadi</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->denyut_jantung ?? '-' }} x/menit
                        </td>
                    </tr>
                    <tr>
                        <td>Pernapasan</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pernapasan ?? '-' }} x/menit
                        </td>
                    </tr>
                    <tr>
                        <td>Suhu</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->suhu ?? '-' }} Celcius
                        </td>
                    </tr>
                    <tr>
                        <td>BB / TB</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->berat_badan ?? '-' }} kg /
                            {{ $antrian->asesmenrajal->tinggi_badan ?? '-' }} cm
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="table-borderless">
                    <tr>
                        <td>Catatan Laboratorium</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pemeriksaan_lab ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Catatan Radiologi</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pemeriksaan_rad ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Catatan Penunjang</td>
                        <td>:</td>
                        <td>
                            {{ $antrian->asesmenrajal->pemeriksaan_penunjang ?? '-' }}
                        </td>
                    </tr>

                </table>
                <br>
            </td>
            <td class="text-center">
                Dokter DPJP, <br>
                <img src="{{ $ttddokter }}" width="70px"> <br>
                <b><u>{{ $antrian->kunjungan->dokters->nama }}</u></b>
            </td>
        </tr>

    </table>

    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
