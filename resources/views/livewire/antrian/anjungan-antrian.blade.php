<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-green text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset('kitasehat/logokitasehat-lingkar.png') }}" width="80">
                                    <div class="col">
                                        <h2>Anjungan Antrian</h2>
                                        <h4>{{ env('APP_NAME_LONG') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ env('APP_NAME') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="col-md-6 text-white">
            <x-adminlte-card title="Pilih Jenis Pasien" theme="green" icon="fas fa-user-plus">
                <div class="text-center">
                    {{-- <a wire:navigate href="{{ route('anjunganantrian.mandiri') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1>ANTRIAN PASIEN BPJS</h1>
                        </x-adminlte-card>
                    </a> --}}
                    <a wire:navigate href="{{ route('anjunganantrian.bpjs') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1>ANTRIAN PASIEN BPJS</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate href="{{ route('anjunganantrian.umum') }}?jenispasien=NON-JKN">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1>ANTRIAN PASIEN UMUM</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate href="{{ route('anjunganantrian.umum') }}?jenispasien=NON-JKN">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1>JADWAL RAWAT JALAN</h1>
                        </x-adminlte-card>
                    </a>
                    {{-- <a wire:navigate href="{{ route('anjunganantrian.umum') }}?jenispasien=NON-JKN">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1></h1>
                        </x-adminlte-card>
                    </a> --}}
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('anjunganantrian.index') }}">
                        <x-adminlte-button icon="fas fa-sync" class="withLoad" theme="warning" label="Reload" />
                    </a>
                    <a href="{{ route('anjunganantrian.bpjs') }}">
                        <x-adminlte-button icon="fas fa-users" theme="warning" label="Antrian" />
                    </a>
                    {{-- <a wire:navigate href="{{ route('anjunganantrian.pasien') }}?pasienbaru=0">
                        <x-adminlte-button icon="fas fa-sync" class="withLoad" theme="warning" label="Reload" />
                    </a> --}}
                    <a href="{{ route('anjunganantrian.test') }}">
                        <x-adminlte-button wire:click='test' icon="fas fa-print" theme="warning" label="Test Printer" />
                    </a>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Anjungan Checkin Antrian" theme="green" icon="fas fa-qrcode">
                <div class="text-center">
                    <img src="{{ asset('bpjs/qrantrian.png') }}" width="48%" alt="">
                    <img src="{{ asset('bpjs/bpjs2.jpg') }}" width="45%" alt="">
                    <br>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
