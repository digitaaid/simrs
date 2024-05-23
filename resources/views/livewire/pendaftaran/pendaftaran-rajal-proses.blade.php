<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            <a href="{{ route('pendaftaran.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                <x-adminlte-button class="btn-xs" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            @if ($antrian->taskid <= 2)
                <x-adminlte-button wire:click='panggilPendaftaran' class="btn-xs" label="Panggil Pendaftaran"
                    theme="primary" icon="fas fa-microphone" />
            @endif
            @include('livewire.pendaftaran.modal-profil-rajal')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    @include('livewire.pendaftaran.navigasi-rajal')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        @if ($openformPasien)
            @livewire('pendaftaran.modal-pasien-rajal')
        @endif
        @if ($openformAntrian)
            @livewire('pendaftaran.modal-antrian-rajal', ['antrian' => $antrian])
        @endif
        @if ($openformKunjungan)
            @livewire('pendaftaran.modal-kunjungan-rajal', ['antrian' => $antrian])
        @endif
    </div>
</div>
