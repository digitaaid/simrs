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
                <b>NORA PEMBAYARAN RAWAT JALAN NO. {{ $resepobat->kode }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>PELAYANAN RAWAT JALAN</b>
                <table class="table table-xs table-bordered" style="font-size: 8px">
                    <tr>
                        <th>No</th>
                        <th>Tindakan Pelayanan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Total</th>
                    </tr>
                    @foreach ($antrian->layanans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="text-right">{{ money($item->harga ? $item->harga : 0, 'IDR') }}</td>
                            <td>{{ $item->diskon }}%</td>
                            <td class="text-right">{{ money($item->subtotal ? $item->subtotal : 0, 'IDR') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th class="text-right">{{ money($antrian->layanans->sum('subtotal'), 'IDR') }}</th>
                        </th>
                    </tr>

                </table>
                <br>
                <b>FARMASI RAWAT JALAN</b>
                <table class="table table-xs table-bordered" style="font-size: 8px">
                    <tr>
                        <th>No</th>
                        <th>Tindakan Pelayanan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Total</th>
                    </tr>
                    @foreach ($resepobatdetails as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="text-right">{{ money($item->harga ? $item->harga : 0, 'IDR') }}</td>
                            <td></td>
                            <td class="text-right">{{ money($item->subtotal ? $item->subtotal : 0, 'IDR') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th class="text-right">{{ money($resepobatdetails->sum('subtotal'), 'IDR') }}</th>
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
                            <br>
                            .........................
                        </td>
                        <td>
                            <b>Disetujui</b>
                            <br>
                            <br>
                            <br>
                            .........................
                        </td>
                        <td>
                            <b>Menerima Obat Beserta Informasi</b>
                            <br>
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
