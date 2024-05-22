<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=80mm, initial-scale=1.0">
    <title>Karcis Antrian</title>
</head>

<body>
    <div class="ticket">
        <img src="{{ asset('kitasehat/logokitasehat.png') }}" height="50px" alt="">
        <hr style="margin: 0">
        <b>Nomor Karcis Antrian</b><br>
        <b style="font-size: 30px">{{ $antrian->nomorantrean }}</b> <br>
        {!! QrCode::size(80)->generate($antrian->kodebooking) !!} <br>
        {{ $antrian->kodebooking }} / {{ $antrian->angkaantrean }}
        </p>
        {{ $antrian->jenispasien }}
        @if ($antrian->method != 'Offline')
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
        <p style="line-height:13px;font-size: 10px;">
            Simpan lembar karcis antrian ini sampai pelayanan berakhir. Terimakasih. <br>
            Semoga selalu diberikan kesembuhan dan kesehatan.
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
