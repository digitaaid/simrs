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
                        <td><b>{{ $resep->norm ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>{{ $resep->nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($resep->tgl_lahir)
                                    {{ \Carbon\Carbon::parse($resep->tgl_lahir)->format('d F Y') }}
                                    ({{ \Carbon\Carbon::parse($resep->tgl_lahir)->age }} tahun)
                                @endif
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Sex</td>
                        <td>:</td>
                        <td>
                            <b>
                                @if ($resep)
                                    @if ($resep->gender == 'P')
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
                <b>NOTA PEMBELIAN OBAT FARMASI
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
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><b>
                                {{ $resep->waktu ? \Carbon\Carbon::parse($resep->waktu)->format('d F Y H:i') : '-' }}
                            </b></td>
                    </tr>
                    <tr>
                        <td>Unit / Ruangan</td>
                        <td>:</td>
                        <td><b>{{ $resep->namaunit ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Apoteker</td>
                        <td>:</td>
                        <td><b>{{ $resep->pic ?? '-' }}</b></td>
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
                                BAYAR MANDIRI
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Pelayanan</td>
                        <td>:</td>
                        <td><b>
                                PEMBELIAN OBAT
                            </b></td>
                    </tr>
                    <tr>
                        <td>Kode Resep</td>
                        <td>:</td>
                        <td><b>{{ $resep->kode ?? '-' }}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table class="table table-xs table-bordered" style="font-size: 8px">
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
                            <br>
                            ({{ $resep->pic }})
                        </td>
                        <td>
                        </td>
                        <td>
                            <b>Menerima Obat Beserta Informasi</b>
                            <br>
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
