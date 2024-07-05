<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Print Etiket Obat {{ $antrian->nama }}
    </title>
    <style>
        .unicode {
            font-family: "DejaVu Sans";
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .table {
            margin-bottom: 0px;
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
        }

        .table thead th {
            vertical-align: bottom;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-xs th,
        .table-xs td {
            padding: 2px;
        }

        .table-bordered {
            border: 1px solid black !important;
            padding: 0;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black !important;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-borderless {
            border: 0px solid black !important;
            padding: 0;
        }

        .table-borderless th,
        .table-borderless td {
            border: 0px solid black !important;
            padding: 0;
        }

        pre {
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
        }

        @page {
            margin: 10px;
            margin-left: 20px;
            size: 6cm 4cm;
            transform: rotate(90deg);
        }

        @media print {
            @page {
                size: portrait;
            }
        }

        /* body {
            margin: 20px;
        } */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body style="font-size: 8px; font-family: Calibri;">
    @foreach ($resepobatdetails as $key => $item)
        <br>
        <b>Farimasi {{ env('APP_NAME_LONG') }}</b>
        <hr style="margin: 0">
        <table class="table table-borderless" style="font-size: 8px">
            <tr>
                <td>No RM</td>
                <td>:</td>
                <td>{{ $antrian->norm }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $antrian->nama }}</td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>:</td>
                <td>{{ $antrian->kunjungan->tgl_lahir }} </td>
            </tr>
            <tr>
                <td>Poliklinik</td>
                <td>:</td>
                <td>{{ $antrian->kunjungan->units->nama }}</td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td>:</td>
                <td>{{ $antrian->kunjungan->dokters->nama }}</td>
            </tr>
        </table>
        <br>
        <div class="text-center" style="font-size: 12px">
            <b>{{ $item->nama }}</b> <br>
            {{ $item->frekuensi }} {{ $item->waktu }} <br>
            {{ $item->keterangan }}
        </div>
        @if ($key != count($resepobatdetails) - 1)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
