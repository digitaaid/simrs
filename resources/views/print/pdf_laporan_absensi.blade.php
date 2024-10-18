@extends('print.pdf_layout')
@section('title', 'Resep Farmasi ' . $user->name)

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

            </td>
        </tr>
        <tr class="text-center" style="background: yellow">
            <td colspan="3">
                <b>LAPORAN ABSENSI
                </b>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                {{-- <img src="{{ $url }}" width="40px"> --}}
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Periode </td>
                        <td>:</td>
                        <td>{{ now()->format('F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Nama </td>
                        <td>:</td>
                        <td><b>{{ $user->name }}</b></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Jumlah Jadwal </td>
                        <td>:</td>
                        <td><b>{{ $absensis->count() }} Hari</b></td>
                    </tr>
                    <tr>
                        <td>Telat </td>
                        <td>:</td>
                        <td><b> {{ $absensis->where('telat', '!=', 0)->count() }} Kali</b></td>
                    </tr>
                    <tr>
                        <td>Cepat Pulang </td>
                        <td>:</td>
                        <td><b>{{ $absensis->where('cepat_pulang', '!=', 0)->count() }} Kali</b> </td>

                    </tr>
                    <tr>
                        <td>Belum Absensi </td>
                        <td>:</td>
                        <td><b>{{ $absensis->where('absensi_masuk', null)->count() }} Kali</b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table class="table table-bordered table-xs">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Shift Kerja</th>
                            <th>Tanggal</th>
                            <th>Jam Kerja</th>
                            <th>Absensi Masuk</th>
                            <th>Jarak Masuk</th>
                            <th>Telat</th>
                            <th>Absensi Pulang</th>
                            <th>Jarak Pulang</th>
                            <th>Pulang Cepan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_shift }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam_masuk }}-{{ $item->jam_pulang }}</td>
                                <td>{{ $item->absensi_masuk ? \Carbon\Carbon::parse($item->absensi_masuk)->format('H:i:s') : '-' }}
                                </td>
                                <td>
                                    @if ($item->jarak_masuk)
                                        {{ round($item->jarak_masuk) }} meter
                                    @endif
                                </td>
                                <td>
                                    @if ($item->telat != 0)
                                        {{ floor($item->telat / 3600) }} jam {{ floor($item->telat % 3600) / 60 }} menit
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->absensi_pulang ? \Carbon\Carbon::parse($item->absensi_pulang)->format('H:i:s') : '-' }}
                                </td>
                                <td>
                                    @if ($item->jarak_pulang)
                                        {{ round($item->jarak_pulang) }} meter
                                    @endif
                                </td>
                                <td>
                                    @if ($item->telat != 0)
                                        {{ floor($item->pulang_cepat / -3600) }} jam
                                        {{ floor($item->pulang_cepat % 3600) / -60 }} menit
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
