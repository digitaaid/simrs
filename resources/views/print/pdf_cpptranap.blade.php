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
                        <td><b>{{ $kunjungan->norm ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>{{ $kunjungan->nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{ \Carbon\Carbon::parse($kunjungan->tgl_lahir)->format('d F Y') }}
                                ({{ \Carbon\Carbon::parse($kunjungan->tgl_lahir)->age }} tahun)
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Sex</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($kunjungan)
                                    @if ($kunjungan->gender == 'P')
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
                <b>CATATAN PERKEMBANGAN PASIEN TERINTEGRASI RAWAT INAP</b>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <img src="{{ $url }}" width="40px">
                {{ $kunjungan->kode ?? '-' }}
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td><b>
                                {{ $kunjungan->tgl_masuk ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d F Y H:i') : '-' }}
                            </b></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pulang</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{ $kunjungan->tgl_pulang ? \Carbon\Carbon::parse($kunjungan->tgl_pulang)->format('d F Y H:i') : 'Belum Pulang' }}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Unit / Ruangan</td>
                        <td>:</td>
                        <td><b>{{ $kunjungan->units->nama ?? '-' }} BED {{ $kunjungan->beds_id ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>:</td>
                        <td><b>{{ $kunjungan->dokters->nama ?? '-' }}</b></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Jenis Pelayanan</td>
                        <td>:</td>
                        <td><b>Rawat Inap</b></td>
                    </tr>
                    <tr>
                        <td>Penjamin</td>
                        <td>:</td>
                        <td>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <table class="table table-sm table-bordered" style="font-size: 9px;">
        <tr>
            <th>Tanggal, Jam</th>
            <th>Profesional Pemberi<br>Asuhan</th>
            <th>Hasil Asesmen Pasien dan Pemberian Pelayanan</th>
            <th>Instruksi PPA Termasuk<br>Pasca Bedah / Prosedur</th>
            <th>Review <br>& Verifikasi DPJP</th>
        </tr>
        @foreach ($inputs as $item)
            <tr>
                <td>{{ $item->tgl_input }}</td>
                <td>{{ $item->profesi }}</td>
                <td>
                    @if ($item->subjective)
                        <b>Subjective : </b>
                        <pre>{{ $item->subjective }}</pre>
                    @endif
                    @if ($item->objective)
                        <b>Objective : </b>
                        <pre>{{ $item->objective }}</pre>
                    @endif
                    @if ($item->assessment)
                        <b>Assessment : </b>
                        <pre>{{ $item->assessment }}</pre>
                    @endif
                    @if ($item->plan)
                        <b>Plan : </b>
                        <pre>{{ $item->plan }}</pre>
                    @endif
                </td>
                <td>{{ $item->instruksi }}</td>
                <td>{{ $item->dokter_dpjp }}</td>
            </tr>
        @endforeach
    </table>
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
