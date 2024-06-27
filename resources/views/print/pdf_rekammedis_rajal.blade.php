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
                    <img src="{{ $url }}" width="50px">
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
                            <td>{{ $antrian->asesmenrajal->tindakan ?? '-' }}</td>
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
                                {{ $antrian->asesmenrajal->sistole ?? '-' }}/{{ $antrian->asesmenrajal->distole ?? '-' }}
                                mmHg
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
                    <img src="{{ $ttddokter }}" width="70px"><br>
                    <b><u>{{ $antrian->kunjungan->dokters->nama }}</u></b>
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
                    <b>RESEP OBAT RAWAT JALAN</b>
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
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td><b>{{ $antrian->pasien->alamat ?? '-' }}</b>
                                @if ($antrian->pasien)
                                    <b>{{ $antrian->pasien->kabupaten ?? '' }}</b>
                                    <b>{{ $antrian->pasien->kecamatan ?? '' }}</b>
                                    <b>{{ $antrian->pasien->desa ?? '' }}</b>
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
                                <b>Petugas Farmasi</b>
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
                    <b>NOTA PEMBAYARAN RAWAT JALAN</b>
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
                                <td>{{ $item->diskon }}%</td>
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