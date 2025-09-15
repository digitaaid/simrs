<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Print Label Pasien {{ $pasien->nama }}
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

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
            font-family: Arial, sans-serif;
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

<body style="font-size: 13px;">
    <br>
    <b>{{ $pasien->nama }}</b>
    <br>

    <b>{{ $pasien->norm }}</b>
    <br>

    <b>{{ $pasien->nik }}</b>
    <br>
    <br>
    <b style="font-size: 11px;">{{ $pasien->alamat }}</b>
    <br>
</body>

</html>
