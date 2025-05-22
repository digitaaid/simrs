@extends('adminlte::master')
{{-- @inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper') --}}
@section('title', 'Anjungan Antrian')
@section('body')
    {{ $slot }}
@stop
@section('adminlte_css')
    <style>
        body {
            background-color: {{ config('adminlte.anjungan_color') }};
        }
    </style>
@stop
@section('adminlte_js')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
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
