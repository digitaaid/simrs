<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-{{ config('adminlte.anjungan_color') }} text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset(config('adminlte.logo_img')) }}" width="80">
                                    <div class="col">
                                        <h2>Anjungan Antrian</h2>
                                        <h4>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ config('adminlte.title') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="col-md-6 text-white">
            <x-adminlte-card title="Karcis Antrian Pasien" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-user-plus">
                <div class="text-center">
                    <a wire:navigate href="{{ route('anjunganantrian.mandiri') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h2>ANJUNGAN MANDIRI</h2>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate href="{{ route('anjunganantrian.bpjs') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN BPJS</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate href="{{ route('anjunganantrian.umum') }}?jenispasien=NON-JKN">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN UMUM</h1>
                        </x-adminlte-card>
                    </a>
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('anjunganantrian.index') }}">
                        <x-adminlte-button icon="fas fa-sync" class="withLoad" theme="warning" label="Reload" />
                    </a>
                    <a href="{{ route('anjunganantrian.bpjs') }}">
                        <x-adminlte-button icon="fas fa-users" theme="warning" label="Antrian" />
                    </a>
                    <a href="{{ route('anjunganantrian.test') }}">
                        <x-adminlte-button wire:click='test' icon="fas fa-print" theme="warning" label="Test Printer" />
                    </a>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Informasi Anjunan Antrian" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-info">
                <div class="text-center">
                    <img src="{{ asset('bpjs/qrantrian.png') }}" width="48%" alt="">
                    <img src="{{ asset('bpjs/bpjs2.jpg') }}" width="45%" alt="">
                    <br>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
