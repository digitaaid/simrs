<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=80mm, initial-scale=1.0">
    <title>Resep Obat {{ $resepobat->nama }}</title>
</head>

<body>
    <div class="ticket">
        <img src="{{ asset('kitasehat/logokitasehat.png') }}" height="50px" alt="">
        <hr style="margin: 0">
        <b>Resep Obat</b><br>
        <div style="font-size: 12px">
            <b>Kode : </b> {{ $resepobat->kode }} <br>
            <b>Nama : </b> {{ $resepobat->nama }} ({{ $resepobat->gender }})<br>
            <b>No RM : </b> {{ $resepobat->norm }} <br>
            <b>Tgl Lahir : </b> {{ $resepobat->tgl_lahir }} <br>
            <b>Unit : </b> {{ $resepobat->namaunit }} <br>
            <b>Dokter : </b> {{ $resepobat->namadokter }} <br>
            <b>Waktu : </b> {{ $resepobat->waktu }} <br>
        </div>
        <hr style="margin: 0">
        <b>Daftar Obat</b><br>
        <div style="font-size: 13px">
            @foreach ($resepobatdetails as $item)
                <b>Rx {{ $item->nama }} </b> ({{ $item->jumlah }}) {{ $item->frekuensi }} {{ $item->waktu }}
                {{ $item->keterangan }} <br>
            @endforeach
        </div>
        <hr style="margin: 0">
        <div style="font-size: 12px">
            Semoga selalu diberikan kesembuhan dan kesehatan.
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
        setTimeout(function() {
            window.top.close();
        }, 3000);
    </script>
</body>

</html>
