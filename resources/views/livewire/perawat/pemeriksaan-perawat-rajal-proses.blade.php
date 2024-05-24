<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            <a href="{{ route('pemeriksaan.perawat.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                <x-adminlte-button class="btn-xs" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            @include('livewire.pendaftaran.modal-profil-rajal')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    @include('livewire.dokter.navigasi-pemeriksaan-rajal')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        @if ($openmodalAsesmenRajal)
            @livewire('dokter.modal-asesmen-rajal')
        @endif
        @if ($openmodalPerawat)
            @livewire('perawat.modal-perawat-rajal', ['antrian' => $antrian])
        @endif
        @if ($openmodalDokter)
            @livewire('dokter.modal-dokter-rajal', ['antrian' => $antrian])
        @endif
    </div>
</div>
