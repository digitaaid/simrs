<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-purple text-white p-2">
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
        <div class="col-md-6">
            <x-adminlte-card title="Pilih Jenis Pasien" theme="purple" icon="fas fa-user-plus">
                <h1>Pasien Umum</h1>
                <h3>Apakah pasien baru atau pasien lama (pernah berobat) di kami ?</h3>
                <div class="text-center text-white">
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=1&jenispasien=NON-JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-purple">
                            <h1>PASIEN UMUM BARU</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=0&jenispasien=NON-JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-purple">
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
            <x-adminlte-card title="Informasi" theme="purple" icon="fas fa-qrcode">
                <div class="text-center">
                    <img src="{{ asset('lmc/1.jpg') }}" width="45%" alt="">
                    <img src="{{ asset('lmc/2.jpg') }}" width="45%" alt="">
                    <br>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
