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
                            text="Absensi {{ $absensi->jam_masuk }}-{{ $absensi->jam_pulang }} " theme="success"
                            icon="fas fa-user-check" url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                    @else
                        <x-adminlte-small-box title="Tidak Ada Jadwal" text="Absensi Hari Ini" theme="secondary"
                            icon="fas fa-user-times" url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @livewire('dashboard.jadwal-dokter')
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Log Aktifitas Anda" theme="secondary">
                <div style="overflow-y: auto ;max-height: 300px;">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs->sortByDesc('created_at') as $log)
                                <tr>
                                    <td class="text-nowrap">{{ $log->created_at }}</td>
                                    <td>{{ $log->user?->name ?? 'Anonim' }}</td>
                                    <td>{{ $log->activity }}</td>
                                    <td>{{ $log->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@stop
