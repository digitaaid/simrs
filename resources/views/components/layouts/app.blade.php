@extends('adminlte::page')

@section('title', $title ?? config('app.name'))

@section('content_header')
    <h1>{{ $title ?? config('app.name') }}</h1>
@stop

@section('content')
    {{ $slot }}
@stop
