@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Selamat Datang {{ auth()->user()->name }},</h5>
                    <p class="mb-0">Anda Login sebagai {{ auth()->user()->roles?->first()?->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">

                    @if ($absensi)
                        <x-adminlte-small-box title="{{ $absensi->status_absen ? $absensi->status_absen : 'Belum Absensi' }}"
                            text="Absensi Hari Ini" theme="success" icon="fas fa-user-check"
                            url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                    @else
                        <x-adminlte-small-box
                            title="Tidak Ada Jadwal"
                            text="Absensi Hari Ini" theme="secondary" icon="fas fa-user-times"
                            url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-6">
            @livewire('dashboard.jadwal-dokter')
        </div>
    </div>
@stop
