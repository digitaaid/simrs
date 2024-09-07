@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Selamat Datang {{ auth()->user()->name }},</h5>
                    <p class="mb-0">Anda Login sebagai {{ auth()->user()->roles?->first()?->name }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
