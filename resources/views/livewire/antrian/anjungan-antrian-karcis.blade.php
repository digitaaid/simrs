<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=80mm, initial-scale=1.0">
    <title>Karcis Antrian</title>
</head>

<body>
    <div class="ticket" style="text-align: center; font-family: sans-serif">
        <img src="{{ asset('kitasehat/logokitasehat.png') }}" height="40px" alt="">
        <hr style="margin: 0">
        <b>Nomor Karcis Antrian</b><br>
        <b style="font-size: 50px">{{ $antrian->nomorantrean }}</b><br>
        {!! QrCode::size(60)->generate($antrian->kodebooking) !!}<br>
        <span style="font-size: 10px">{{ $antrian->kodebooking }} / {{ $antrian->angkaantrean }}</span> <br>
        <br>
        <b>{{ $antrian->jenispasien === 'JKN' ? 'PASIEN BPJS / JKN' : 'PASIEN UMUM' }}</b>
        @if ($antrian->method != 'Offline')
            <br>
            <b>{{ $antrian->nama }}</b> <br>
            No RM {{ $antrian->norm }} <br>
            No BPJS {{ $antrian->nomorkartu }} <br>
        @endif
        <p style="line-height:13px;font-size: 10px;">
            {{ $antrian->namapoli }} <br>
            {{ $antrian->namadokter }} <br>
            {{ $antrian->jampraktek }} <br>
        </p>
        <hr style="margin: 0">
        <span style="font-size: 8px;">
          Semoga selalu diberikan kesembuhan dan kesehatan. Terimakasih.
        </span>
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
