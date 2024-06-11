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
                <b>RESEP OBAT NO. {{ $resepobat->kode }}</b><br>
                <b>{{ strtoupper(env('APP_NAME_LONG')) }}</b><br>
                Jl. Raya Merdeka Utama Ciledug Desa Ciledug Kulon, <br>
                Kec. Ciledug, Kabupaten Cirebon, Jawa Barat 45682 <br>
                www.klinikkitasehat.com
            </td>
            <td width="40%" style="vertical-align: top;">
                <table class="table-borderless">
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td><b>{{ $antrian->norm }}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>{{ $antrian->nama }}</b></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->tgl_lahir }}</b></td>
                    </tr>
                    <tr>
                        <td>Sex</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->gender }}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="table-borderless">
                    <tr>
                        <td>Berat Badan</td>
                        <td>:</td>
                        <td><b>{{ $antrian->asesmenrajal->berat_badan ?? '-' }} kg</b></td>
                    </tr>
                    <tr>
                        <td>Tinggi Badan</td>
                        <td>:</td>
                        <td><b>{{ $antrian->asesmenrajal->tinggi_badan ?? '-' }} cm</b></td>
                    </tr>
                    <tr>
                        <td>Ruangan/Klinik</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->units->nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>:</td>
                        <td><b>{{ $antrian->kunjungan->dokters->nama ?? '-' }}</b></td>
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
                </table>
                <br>
                <b>RESEP OBAT NO. {{ $resepobat->kode }}</b><br>
                @foreach ($resepobatdetails as $item)
                    <b>R/ {{ $item->nama }}</b> ({{ $item->jumlah }}) {{ $item->frekuensi }} {{ $item->waktu }}
                    {{ $item->keterangan }}<br>
                @endforeach
                <br><br>
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
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
