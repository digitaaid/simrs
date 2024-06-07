<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            @include('livewire.pendaftaran.modal-profil-rajal')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    @include('livewire.pendaftaran.navigasi-rajal')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        @livewire('pendaftaran.modal-pasien-rajal')
        @livewire('pendaftaran.modal-antrian-rajal', ['antrian' => $antrian])
        @livewire('pendaftaran.modal-kunjungan-rajal', ['antrian' => $antrian])
        @if ($antrian->pasien && $antrian->jenispasien == 'JKN')
            @livewire('pendaftaran.modal-sep', ['antrian' => $antrian])
            @livewire('pendaftaran.modal-suratkontrol')
        @endif
        @if ($antrian->kunjungan)
            @livewire('dokter.modal-cppt', ['pasien' => $pasien])
            @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian])
        @endif
    </div>
</div>
