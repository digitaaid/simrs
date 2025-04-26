<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=80mm, initial-scale=1.0">
    <title>Karcis Antrian</title>
</head>

<body>
    <div class="ticket" style="text-align: center; font-family: sans-serif">
        <img src="{{ asset(config('adminlte.logo_karcis')) }}" height="40px" alt="">
        <hr style="margin: 0">
        <b>Nomor Karcis Antrian</b><br>
        <b style="font-size: 50px">{{ $antrian->nomorantrean }}</b><br>
        {{-- {!! QrCode::size(60)->generate($antrian->kodebooking) !!}<br> --}}
        <b>PASIEN {{ $antrian->pasienbaru ? 'BARU' : 'LAMA' }}
            {{ $antrian->jenispasien == 'JKN' ? 'BPJS' : 'UMUM' }}</b><br>
        @if ($antrian->jeniskunjungan)
            <p style="line-height:13px;font-size: 10px;">
                @switch($antrian->jeniskunjungan)
                    @case(1)
                        RUJUKAN FKTP<br>{{ $antrian->nomorreferensi ?? '-' }}<br>
                    @break

                    @case(2)
                        RUJUKAN INTERNAL<br>
                    @break

                    @case(3)
                        SURAT KONTROL<br>{{ $antrian->nomorreferensi ?? '-' }}<br>
                    @break

                    @case(4)
                        RUJUKAN ANTAR RS<br>{{ $antrian->nomorreferensi ?? '-' }}<br>
                    @break

                    @default
                @endswitch
                SEP<br>{{ $antrian->sep ?? 'Belum Cetak SEP' }}<br>
            </p>
        @endif
        <p style="line-height:13px;font-size: 10px;">
            @if ($antrian->nama)
                <b>{{ $antrian->nama }}</b> <br>
            @endif
            @if ($antrian->nomorkartu)
                {{ $antrian->nomorkartu }} <br>
            @endif
            {{ $antrian->namapoli }} <br>
            {{ $antrian->namadokter }} <br>
            Jam Praktek {{ $antrian->jampraktek }} <br>
            Estimasi Dilayani<br>
            {{ \Carbon\Carbon::createFromTimestamp($antrian->estimasidilayani/1000)->format('d-m-Y H:i') }}
            <br>
        </p>
        <hr style="margin: 0">
        <p style="line-height:13px;font-size: 8px;">
            {{ \Carbon\Carbon::now() }} <br>
            Semoga selalu diberikan kesembuhan dan kesehatan. Terimakasih.
        </p>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
        setTimeout(function() {
            var url = "{{ route('anjunganantrian.index') }}";
            window.location.href = url;
        }, 3000);
    </script>
</body>

</html>
