<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <x-anjungan-header />
        </div>
        <div class="col-md-6 text-white">
            <x-adminlte-card title="Karcis Antrian Pasien" theme="{{ config('adminlte.anjungan_color') }}"
                icon="fas fa-user-plus">
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
            <x-anjungan-info />
        </div>
    </div>
</div>
