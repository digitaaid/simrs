@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('profil') }}" class="nav-link">{{ Auth::user()->name }} </a>
    </li>
@endsection

@section('title', $title ?? config('app.name'))

@section('content_header')
    <div></div>
@stop

@section('content')
    {{ $slot }}
@stop
@section('js')
    <script>
        function formatRibuan(value) {
            value = value.replace(/\D/g, ''); // Hapus karakter non-digit
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik setiap ribuan
        }
    </script>
@endsection
@section('css')
    <style>
        .input-group-xs>.form-control:not(textarea),
        .input-group-xs>.custom-select {
            height: calc(1.4rem + 2px);
        }

        .input-group-xs>.form-control,
        .input-group-xs>.custom-select,
        .input-group-xs>.input-group-prepend>.input-group-text,
        .input-group-xs>.input-group-append>.input-group-text,
        .input-group-xs>.input-group-prepend>.btn,
        .input-group-xs>.input-group-append>.btn {
            padding: .125rem .25rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.15rem;
        }

        .input-group-xs>.custom-select {
            padding-right: 1.75rem;
        }

        .input-group-xs+.form-control-feedback.fa,
        .input-group-xs+.form-control-feedback.fas,
        .input-group-xs+.form-control-feedback.far,
        .input-group-xs+.form-control-feedback.fab,
        .input-group-xs+.form-control-feedback.fal,
        .input-group-xs+.form-control-feedback.fad,
        .input-group-xs+.form-control-feedback.svg-inline--fa,
        .input-group-xs+.form-control-feedback.ion {
            line-height: calc(1.4rem + 2px);
        }

        .form-group-xs {
            margin: 0 !important;
        }

        .form-group-xs .form-control+.form-control-feedback.fa,
        .form-group-xs .form-control+.form-control-feedback.fas,
        .form-group-xs .form-control+.form-control-feedback.far,
        .form-group-xs .form-control+.form-control-feedback.fab,
        .form-group-xs .form-control+.form-control-feedback.fal,
        .form-group-xs .form-control+.form-control-feedback.fad,
        .form-group-xs .form-control+.form-control-feedback.svg-inline--fa,
        .form-group-xs .form-control+.form-control-feedback.ion {
            line-height: calc(1.4rem + 2px);
        }
    </style>
@endsection
@section('plugins.Select2', true)
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.BsCustomFileInput', true)
@section('plugins.BootstrapSwitch', true)
