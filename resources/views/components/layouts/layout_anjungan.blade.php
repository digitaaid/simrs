@extends('adminlte::master')
{{-- @inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper') --}}
@section('title', 'Anjungan Pelayanan Mandiri')
@section('body')
    {{-- <link rel="shortcut icon" href="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" /> --}}
    {{ $slot }}

    {{-- <x-adminlte-modal id="modalBPJS" size="xl" title="Ambil Antrian BPJS" theme="purple" icon="fas fa-user-plus">
        @foreach ($jadwals as $jadwal)
            <a class="card m-2 bg-purple withLoad"
                href="{{ route('ambilkarcis') }}?jenispasien=JKN&jadwal={{ $jadwal->id }}&tanggal={{ $request->tanggal ?? '' }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col  text-center">
                            <h2>{{ $jadwal->jadwal }}</h2>
                        </div>
                        <div class="col" style="font-size: 20">
                            <b>{{ $jadwal->namasubspesialis }} </b><br>
                            {{ $jadwal->namadokter }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </x-adminlte-modal>
    <x-adminlte-modal id="modalUMUM" size="xl" title="Ambil Antrian UMUM" theme="purple" icon="fas fa-user-plus">
        @foreach ($jadwals as $jadwal)
            <a class="card bg-purple withLoad"
                href="{{ route('ambilkarcis') }}?jenispasien=NON-JKN&jadwal={{ $jadwal->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col  text-center">
                            <h2>{{ $jadwal->jadwal }}</h2>
                        </div>
                        <div class="col" style="font-size: 20">
                            <b>{{ $jadwal->namasubspesialis }} </b><br>
                            {{ $jadwal->namadokter }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </x-adminlte-modal> --}}
@stop
@section('adminlte_css')
    <style>
        body {
            background-color: green;
        }
    </style>
@stop
@section('adminlte_js')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('loading-overlay/loadingoverlay.min.js') }}"></script>
    <script src="{{ asset('onscan.js/onscan.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{-- scan --}}
    <script>
        $(function() {
            onScan.attachTo(document, {
                onScan: function(sCode, iQty) {
                    $.LoadingOverlay("show", {
                        text: "Mencari kodebooking " + sCode + "..."
                    });
                    var url = "{{ route('anjunganantrian.checkin') }}?kodebooking=" + sCode;
                    window.location.href = url;
                },
            });
        });
    </script>
    {{-- btn chekin --}}
    <script>
        $(function() {
            $('#btn_checkin').click(function() {
                var kodebooking = $('#kodebooking').val();
                $.LoadingOverlay("show", {
                    text: "Mencari kodebooking " + kodebooking + "..."
                });
                var url = "{{ route('anjunganantrian.checkin') }}?kodebooking=" + kodebooking;
                window.location.href = url;
            });
        });
    </script>
    {{-- btn daftar --}}
    <script>
        $(function() {
            $('.btnDaftarBPJS').click(function() {
                $('#modalBPJS').modal('show');
            });
            $('.btnDaftarUmum').click(function() {
                $('#modalUMUM').modal('show');
            });
        });
    </script>
    {{-- withLoad --}}
    <script>
        $(function() {
            $(".withLoad").click(function() {
                $.LoadingOverlay("show");
            });
        })
        $('.reload').click(function() {
            location.reload();
        });
    </script>
    {{-- @include('sweetalert::alert') --}}
@stop
@section('plugins.Datatables', true)
