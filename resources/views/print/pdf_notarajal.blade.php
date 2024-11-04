@extends('print.pdf_layout')
@section('title', 'Print Nota Pembayaran')

@section('content')
    @if ($kunjungan->sep)
        <div>
            <table class="table table-sm" style="font-size: 11px;border-bottom: 2px solid black !important">
                <tr>
                    <td width="10%" class="text-center" style="vertical-align: bottom;">
                        <img src="{{ public_path('img/logo_bpjs_panjang.png') }}" style="height: 25px">
                    </td>
                    <td width="30%" style="vertical-align: bottom;">
                        <b>SURAT ELEGIBILITAS PESERTA</b><br>
                        <b>KLINIK UTAMA KITA SEHAT</b><br>
                    </td>
                    <td width="50%" style="vertical-align: bottom;">
                        <b>E-SEP NO. {{ $sep->noSep }}</b><br>
                    </td>
                    <td width="10%" class="text-center" style="vertical-align: bottom;">
                        <img src="{{ public_path('kitasehat/logokitasehat.png') }}" style="height: 30px;">
                    </td>
                </tr>
            </table>
            <table class="table table-sm" style="font-size: 11px">
                <tr>
                    <td width="50%">
                        <table class="table-borderless">
                            <tr>
                                <td>No SEP</td>
                                <td>:</td>
                                <td><b>{{ $sep->noSep }}</b></td>
                            </tr>
                            <tr>
                                <td>Tgl SEP</td>
                                <td>:</td>
                                <td><b>{{ \Carbon\Carbon::parse($sep->tglSep)->isoFormat('DD MMMM Y') }}</b></td>
                            </tr>
                            <tr>
                                <td>No Kartu</td>
                                <td>:</td>
                                <td><b>{{ $sep->peserta->noKartu }} (MR. {{ $sep->peserta->noMr }})</b></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><b>{{ $sep->peserta->nama }} ({{ $sep->peserta->kelamin }})</b></td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td><b> {{ Carbon\Carbon::parse($sep->peserta->tglLahir)->translatedFormat('d F Y') }}</b>
                            </tr>
                            <tr>
                                <td>No Telp</td>
                                <td>:</td>
                                <td><b>{{ $peserta->mr->noTelepon }}</b></td>
                            </tr>
                            <tr>
                                <td>Sub/Spesialis</td>
                                <td>:</td>
                                <td><b>{{ $sep->poli }}</b></td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td>:</td>
                                <td><b>{{ $sep->dpjp->nmDPJP }}</b></td>
                            </tr>
                            <tr>
                                <td>Faskes Perujuk</td>
                                <td>:</td>
                                <td><b>{{ $peserta->provUmum->nmProvider }}</b></td>
                            </tr>
                            <tr>
                                <td>Diagnosa Awal</td>
                                <td>:</td>
                                <td><b>{{ $sep->diagnosa }}</b></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>:</td>
                                <td><b>{{ $sep->catatan }}</b></td>
                            </tr>

                        </table>
                    </td>
                    <td width="50%">
                        <table class="table-borderless">
                            <tr>
                                <td>Jenis Peserta</td>
                                <td>:</td>
                                <td><b>{{ $sep->peserta->jnsPeserta }}</b></td>
                            </tr>
                            <tr>
                                <td>Jns Pelayanan</td>
                                <td>:</td>
                                <td><b>{{ $sep->jnsPelayanan }}</b></td>
                            </tr>
                            <tr>
                                <td>Jns Kunjungan</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        - {{ $sep->tujuanKunj->nama }} <br>
                                        - {{ $sep->flagProcedure->nama }} <br>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>Poli Perujuk</td>
                                <td>:</td>
                                <td><b>-</b></td>
                            </tr>
                            <tr>
                                <td>Kelas Hak</td>
                                <td>:</td>
                                <td><b>
                                        {{ $sep->peserta->hakKelas }}
                                    </b></td>
                            </tr>
                            <tr>
                                <td>Kelas Rawat</td>
                                <td>:</td>
                                <td><b>{{ $sep->kelasRawat }}</b></td>
                            </tr>
                            <tr>
                                <td>Penjamin</td>
                                <td>:</td>
                                <td><b>{{ $sep->penjamin }}</b></td>
                            </tr>
                            <tr>
                                <td>No Rujukan</td>
                                <td>:</td>
                                <td><b>{{ $sep->noRujukan }}</b></td>
                            </tr>
                            <tr>
                                <td>No Surat Kontrol</td>
                                <td>:</td>
                                <td><b>{{ $sep->kontrol->noSurat }}</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="font-size: 6px">
                        *Saya menyetujui BPJS Kesehatan untuk :
                        <ol style="margin: 0px; padding-left: 10px; ">
                            <li style="margin: 0px;">
                                <i>Membuka dan atau menggunakan informasi medis pasien untuk keperluan administrasi,
                                    pembayaran
                                    asuransi atau jaminan pembiayaan kesehatan</i>
                            </li>
                            <li style="margin: 0px;">
                                <i>Memberikan akses informasi medis atau riwayat pelayanan kepada dokter/tenaga medis untuk
                                    kepentingan pemeliharaan kesehatan, pengobatan, penyembuhan, dan perawtan pasien</i>
                            </li>
                        </ol>
                        *Saya mengetahui dan memahami :
                        <ol style="margin: 0px; padding-left: 10px; ">
                            <li style="margin: 0px;">
                                <i>Rumah Sakit dapat melakukan koordinasi dengan PT Jasa Raharja / PT Taspen / PT ASABRI /
                                    BPJS
                                    Ketenagakerjaan atau penjamin lainnya, jika peserta merupakan pasien yang mengalami
                                    kecelakaan
                                    lalulintas dan atau kecelakaan kerja</i>
                            </li>
                            <li style="margin: 0px;">
                                <i>SEP bukan sebagai bukti penjaminan peserta</i>
                            </li>
                        </ol>
                        **Dengan tampilnya luaran SEP Elektronik ini merupakan hasil validasi terhadap elegibilitas Pasien
                        secara
                        elektronik (validasi fingerprint atau biometrik / sistem validasi lain) dan seharusnya pasien dapat
                        mengakses pelayanan kesehatan rujukan sesuai ketentuan yang berlaku.
                        Kebenaran dan keaslian atas informasi data pasien menjadi tanggungjawab penuh FKRTL <br>
                        Waktu Cetak : {{ now()->timezone('Asia/Jakarta')->format('d F Y H:i:s') }}

                    </td>
                    <td width="50%">
                        <table class="table-borderless">
                            <tr>
                                <td style="padding-left: 10px">
                                    <b> Pasien/<br>
                                        Keluarga Pasien
                                    </b>
                                    <br>
                                    <img src="{{ $ttdpasien }}" width="50px">
                                </td>
                                <td style="padding-left: 30px">
                                    <b> Petugas<br>
                                    </b>
                                    <br>
                                    <img src="{{ $ttdpetugas }}" width="50px">
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
        </div>
        <div class="page-break"></div>
    @endif
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
    <div class="page-break"></div>
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
                            <th class="text-right">{{ money(floatval($kunjungan->layanans->sum('subtotal')), 'IDR') }}
                            </th>
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
