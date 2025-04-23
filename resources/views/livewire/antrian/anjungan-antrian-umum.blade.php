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
        <div class="col-md-6">
            <x-adminlte-card title="Pilih Jenis Pasien" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-user-plus">
                <h1>Pasien Umum</h1>
                <h5>Apakah pasien baru atau pasien lama (pernah berobat) di kami ?</h5>
                <div class="text-center text-white">
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=1&jenispasien=NON-JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN UMUM BARU</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=0&jenispasien=NON-JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN UMUM LAMA</h1>
                        </x-adminlte-card>
                    </a>
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('anjunganantrian.index') }}">
                        <x-adminlte-button icon="fas fa-arrow-left" class="withLoad" theme="danger" label="Kembali" />
                    </a>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Informasi" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-qrcode">
                <div class="text-center">
                    <img src="{{ asset('bpjs/wajibmjkn.jpg') }}" width="45%" alt="">
                    <img src="{{ asset('bpjs/caramjkn.jpg') }}" width="45%" alt="">
                    <br>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
