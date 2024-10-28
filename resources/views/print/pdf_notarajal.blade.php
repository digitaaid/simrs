@extends('print.pdf_layout')
@section('title', 'Print Nota Pembayaran')

@section('content')
    <div>
        <table class="table table-sm table-bordered" style="font-size: 11px;">
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
                    <b>RESEP OBAT FARMASI
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
                    </b>
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
                            <td>Penjamin</td>
                            <td>:</td>
                            <td>
                                <b>
                                    {{ $kunjungan->jaminans?->nama }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>No. SEP</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->sep ?? '-' }}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-borderless">
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td><b>{{ $kunjungan->pasien->alamat ?? '-' }}</b>
                                @if ($kunjungan->pasien)
                                    <b>{{ $kunjungan->pasien->kabupaten ?? '' }}</b>
                                    <b>{{ $kunjungan->pasien->kecamatan ?? '' }}</b>
                                    <b>{{ $kunjungan->pasien->desa ?? '' }}</b>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Riwayat Alergi</td>
                            <td>:</td>
                            <td><b>{{ $antrian->asesmenrajal->riwayat_alergi ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>Riwayat Penyakit</td>
                            <td>:</td>
                            <td><b>{{ $antrian->asesmenrajal->riwayat_penyakit ?? '-' }}</b></td>
                        </tr>

                        <tr>
                            <td>BB / TB</td>
                            <td>:</td>
                            <td><b>{{ $antrian->asesmenrajal->berat_badan ?? '-' }} kg /
                                    {{ $antrian->asesmenrajal->tinggi_badan ?? '-' }} cm</b></td>
                        </tr>
                    </table>
                    <br>
                    RESEP OBAT NO. {{ $resepobat->kode }}<br>
                    <div style="font-size: 10px">
                        @foreach ($resepobatdetails as $item)
                            <b>R/ {{ $item->nama }}</b> ({{ $item->jumlah }}) {{ $item->frekuensi }}
                            {{ $item->waktu }}
                            {{ $item->keterangan }}<br>
                        @endforeach
                    </div>
                </td>
                <td>
                    <table class="table table-xs table-bordered" style="font-size: 8px">
                        <tr>
                            <th>Telah Administrasi</th>
                            <th>Ya</th>
                            <th>Tidak</th>
                        </tr>
                        <tr>
                            <td>1. Nama Pasien</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2. Umur Pasien</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3. Jenis Kelamin & BB/TB</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4. Paraf & Nama Dokter</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5. Tanggal Resep</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6. Asal Ruangan/Klinik</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Telah Farmasetik</th>
                            <th>Ya</th>
                            <th>Tidak</th>
                        </tr>
                        <tr>
                            <td>1. Nama ,Bentuk, Kekuataan Sediaan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2. Dosis & Jumlah Obat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3. Aturan & Cara Penggunaan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Telaah Klinis</th>
                            <th>Ya</th>
                            <th>Tidak</th>
                        </tr>
                        <tr>
                            <td>1. Indikasi, Dosis, Waktu, Durasi Penggunaan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2. Duplikasi Pengobatan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3. Alergi & ROTD</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4. Kontraindikasi</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5. Interaksi Obat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6. Kesesuaian Resep dengan Formularium</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table table-borderless" style="font-size: 8px">
                        <tr class="text-center">
                            <td>
                                <b>Petugas Farmasi</b><br>
                                <img src="{{ $ttdpetugas }}" width="70px"><br>
                                {{ $antrian->pic4->name ?? '-' }}
                            </td>
                            <td>
                                <b>Menerima Obat Beserta Informasi</b> <br>
                                <img src="{{ $ttdpasien }}" width="70px"><br>
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
