@extends('print.pdf_layout')
@section('title', 'Rekam Medis Rawat Jalan')

@section('content')
    <div>
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
                    <b>RESUME RAWAT JALAN</b>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <img src="{{ $url }}" width="50px">
                </td>
                <td>
                    <table class="table-borderless">
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td><b>
                                    {{ $kunjungan->tgl_masuk ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->isoFormat('DD MMMM Y HH:mm') : '-' }}
                                </b></td>
                        </tr>
                        <tr>
                            <td>Unit / Ruangan</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->units->nama ?? '-' }}</b></td>
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
                            <td><b>{{ $kunjungan->kode ?? '-' }}</b></td>
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
                            <td>{{ $kunjungan->asesmenrajal->keluhan_utama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;">Pemeriksaan Fisik</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->pemeriksaan_fisik_perawat ?? '' }}
                                {{ $kunjungan->asesmenrajal->pemeriksaan_fisik_dokter ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa</td>
                            <td>:</td>
                            <td>
                                @if ($antrian->asesmenrajal?->diagnosa)
                                    @foreach (explode(';', $kunjungan->asesmenrajal?->diagnosa) as $item)
                                        {{ $item }} <br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-nowarp">ICD-10 Primer</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->asesmenrajal->icd1 ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>ICD-10 Sekunder</td>
                            <td>:</td>
                            <td>
                                <b>
                                    @if ($antrian->asesmenrajal?->icd2)
                                        @foreach (explode(';', $kunjungan->asesmenrajal?->icd2) as $item)
                                            {{ $item }} <br>
                                        @endforeach
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Tindakan</td>
                            <td>:</td>
                            <td>{{ $kunjungan->asesmenrajal->tindakan_medis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>ICD-9 Procedure</td>
                            <td>:</td>
                            <td>
                                <b>
                                    @if ($antrian->asesmenrajal?->icd9)
                                        @foreach (explode(';', $kunjungan->asesmenrajal?->icd9) as $item)
                                            {{ $item }} <br>
                                        @endforeach
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Pengobatan</td>
                            <td>:</td>
                            <td>
                                @foreach ($resepobatdetails as $item)
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
                                {{ $kunjungan->asesmenrajal->sistole ?? '-' }}/{{ $kunjungan->asesmenrajal->distole ?? '-' }}
                                mmHg
                            </td>
                        </tr>
                        <tr>
                            <td>Denyut Nadi</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->denyut_jantung ?? '-' }} x/menit
                            </td>
                        </tr>
                        <tr>
                            <td>Pernapasan</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->pernapasan ?? '-' }} x/menit
                            </td>
                        </tr>
                        <tr>
                            <td>Suhu</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->suhu ?? '-' }} Celcius
                            </td>
                        </tr>
                        <tr>
                            <td>BB / TB</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->berat_badan ?? '-' }} kg /
                                {{ $kunjungan->asesmenrajal->tinggi_badan ?? '-' }} cm
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
                                {{ $kunjungan->asesmenrajal->pemeriksaan_lab ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan Radiologi</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->pemeriksaan_rad ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan Penunjang</td>
                            <td>:</td>
                            <td>
                                {{ $kunjungan->asesmenrajal->pemeriksaan_penunjang ?? '-' }}
                            </td>
                        </tr>

                    </table>
                    <br>
                </td>
                <td class="text-center">
                    Dokter DPJP, <br>
                    <img src="{{ $ttddokter }}" width="70px"><br>
                    <b><u>{{ $kunjungan->dokters->nama }}</u></b>
                </td>
            </tr>
        </table>
    </div>
    <div class="page-break"></div>
    <div>
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
                    <b>NOTA PEMBAYARAN
                        @switch($kunjungan->jeniskunjungan)
                            @case(1)
                                RAWAT JALAN (FKTP)
                            @break

                            @case(2)
                                RAWAT JALAN (Umum)
                            @break

                            @case(3)
                                RAWAT JALAN (Kontrol)
                            @break

                            @case(4)
                                RAWAT JALAN (RS)
                            @break

                            @case(5)
                                IGD
                            @break

                            @case(6)
                                RAWAT INAP
                            @break

                            @default
                        @endswitch

                    </b>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <img src="{{ $url }}" width="50px">
                </td>
                <td>
                    <table class="table-borderless">
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td><b>
                                    {{ $kunjungan->tgl_masuk ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->isoFormat('DD MMMM Y HH:mm') : '-' }}
                                </b></td>
                        </tr>
                        <tr>
                            <td>Unit / Ruangan</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->units->nama ?? '-' }}</b></td>
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
                            <td>Penjamin</td>
                            <td>:</td>
                            <td>
                                <b>
                                    {{ $kunjungan->jaminans?->nama }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Pelayanan</td>
                            <td>:</td>
                            <td><b>
                                    @switch($kunjungan->jeniskunjungan)
                                        @case(1)
                                            Rawat Jalan (FKTP)
                                        @break

                                        @case(2)
                                            Rawat Jalan (Umum)
                                        @break

                                        @case(3)
                                            Rawat Jalan (Kontrol)
                                        @break

                                        @case(4)
                                            Rawat Jalan (RS)
                                        @break

                                        @case(5)
                                            IGD
                                        @break

                                        @case(6)
                                            Rawat Inap
                                        @break

                                        @default
                                    @endswitch
                                </b></td>
                        </tr>
                        <tr>
                            <td>Kode Kunjungan</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->kode ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>SEP</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->sep ?? '-' }}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table table-xs table-bordered" style="font-size: 8px">
                        <tr>
                            <th class="text-left" colspan="6">PELAYANAN RAWAT JALAN</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Tindakan Pelayanan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($kunjungan->layanans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td class="text-right">{{ money($item->harga ? floatval($item->harga) : 0, 'IDR') }}</td>
                                <td>{{ $item->diskon }}%</td>
                                <td class="text-right">{{ money($item->subtotal ? floatval($item->subtotal) : 0, 'IDR') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th class="text-right">{{ money(floatval($kunjungan->layanans->sum('subtotal')), 'IDR') }}</th>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="6">FARMASI RAWAT JALAN</th>
                        </tr>
                        @foreach ($resepobatdetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td class="text-right">{{ money(floatval($item->harga ?? 0), 'IDR') }}</td>
                                <td class="text-right">{{ $item->diskon }}%</td>
                                <td class="text-right">{{ money(floatval($item->subtotal ?? 0), 'IDR') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th class="text-right">{{ money(floatval($resepobatdetails->sum('subtotal')), 'IDR') }}</th>
                            </th>
                        </tr>
                        <th class="text-left" colspan="6">TOTAL PEMBAYARAN PASIEN</th>
                        <tr>
                            <th colspan="5" class="text-right">Biaya Tindakan / Layanan</th>
                            <th class="text-right">{{ money(floatval($kunjungan->layanans->sum('subtotal')), 'IDR') }}
                            </th>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">Biaya Farmasi</th>
                            <th class="text-right">{{ money(floatval($resepobatdetails->sum('subtotal')), 'IDR') }}</th>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">Total Biaya Pasien</th>
                            <th class="text-right">
                                {{ money(floatval($resepobatdetails->sum('subtotal') + $kunjungan->layanans->sum('subtotal')), 'IDR') }}
                            </th>
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table table-borderless" style="font-size: 8px">
                        <tr class="text-center">
                            <td>
                                <b>Petugas Kasir</b>
                                <br>
                                <img src="{{ $ttdpetugas }}" width="50px">
                                <br>
                                ({{ $kunjungan->pic4->name ?? auth()->user()->name }})
                            </td>
                            <td>
                            </td>
                            <td>
                                <b>Menerima Obat Beserta Informasi</b>
                                <br>
                                <img src="{{ $ttdpasien }}" width="50px">
                                <br>
                                (Pasien/Keluarga)
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }

        @media print {
            .page-break {
                display: block;
                page-break-after: always;
                /* halaman baru setelah elemen */
            }
        }
    </style>
@endsection
