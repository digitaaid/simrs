@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('profil') }}" class="nav-link">{{ Auth::user()->name }} </a>
    </li>
@endsection

@section('title', $title ?? config('app.name'))

@section('content_header')
    <h1>{{ $title ?? config('app.name') }}</h1>
@stop

@section('content')
    {{ $slot }}
@stop
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.BsCustomFileInput', true)
