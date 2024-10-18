@extends('print.pdf_layout')
@section('title', 'Print Nota Pembayaran')

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
                                {{ $kunjungan->tgl_masuk ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d F Y H:i') : '-' }}
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
                            <td class="text-right">{{ money($item->subtotal ? floatval($item->subtotal) : 0, 'IDR') }}</td>
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
                        <th class="text-right">{{ money(floatval($kunjungan->layanans->sum('subtotal')), 'IDR') }}</th>
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
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
