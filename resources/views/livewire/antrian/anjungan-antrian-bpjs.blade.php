<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <x-anjungan-header />
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Pilih Jenis Pasien" theme="{{ config('adminlte.anjungan_color') }}"
                icon="fas fa-user-plus">
                <h1>Pasien BPJS</h1>
                <h5>Apakah pasien baru atau pasien lama (pernah berobat) di kami ?</h5>
                <div class="text-center text-white">
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=1&jenispasien=JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN BPJS BARU</h1>
                        </x-adminlte-card>
                    </a>
                    <a wire:navigate
                        href="{{ route('anjunganantrian.create') }}?pasienbaru=0&jenispasien=JKN&tanggalperiksa={{ now()->format('Y-m-d') }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-{{ config('adminlte.anjungan_color') }}">
                            <h1>PASIEN BPJS LAMA</h1>
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
            <x-anjungan-info />
        </div>
    </div>
</div>
