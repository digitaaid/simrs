@extends('vendor.medico.master')
@section('title', 'Klinik Utama Kita Sehat')
@section('content')

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Antrian Berhasil</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->
    <section class="inner-page">
        <div class="container">
            <p class="text-success">
                Pendaftaran Antrian Online Berhasil, Silahkan screenshot untuk checkin antrian.
            </p>
            <div class="ticket">
                <img src="{{ asset('kitasehat/logokitasehat.png') }}" height="50px" alt="">
                <hr style="margin: 0">
                <b>Nomor Karcis Antrian</b><br>
                <b style="font-size: 30px">{{ $antrian->nomorantrean }}</b> <br>
                {!! QrCode::size(80)->generate($antrian->kodebooking) !!} <br>
                {{ $antrian->kodebooking }} / {{ $antrian->angkaantrean }}
                </p>
                {{ $antrian->jenispasien === 'JKN' ? 'PASIEN BPJS / JKN' : 'PASIEN UMUM' }}
                @if ($antrian->method != 'Offline')
                    <p style="line-height:13px;font-size: 13px;">
                        <br>
                        <b>{{ $antrian->nama }}</b> <br>
                        No RM {{ $antrian->norm }} <br>
                        No BPJS {{ $antrian->nomorkartu }} <br>
                        No HP {{ $antrian->nohp }} <br>
                    </p>
                @endif
                <p style="line-height:13px;font-size: 10px;">
                    {{ $antrian->tanggalperiksa }} <br>
                    {{ $antrian->namapoli }} <br>
                    {{ $antrian->namadokter }} <br>
                    {{ $antrian->jampraktek }} <br>
                </p>
                <hr style="margin: 0">
                <p style="line-height:13px;font-size: 10px;">
                    Simpan lembar karcis antrian ini sampai pelayanan berakhir. Terimakasih. <br>
                    Semoga selalu diberikan kesembuhan dan kesehatan.
                </p>
            </div>
        </div>
    </section>

    @include('vendor.medico.footer')
@endsection
