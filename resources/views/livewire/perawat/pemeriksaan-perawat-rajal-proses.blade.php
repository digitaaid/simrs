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
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            @include('livewire.dokter.navigasi-pemeriksaan-rajal')
            <x-slot name="footerSlot">
                <x-adminlte-button wire:click='selesaiPerawat'
                    wire:confirm='Apakah anda yakin telah selesai pemeriksaan perawat ?' class="btn-xs"
                    label="Selesai & Kembali" theme="success" icon="fas fa-arrow-left" />
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                    </div>
                    Loading ...
                </div>
            </x-slot>
        </x-adminlte-card>
    </div>
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        @if ($openmodalCppt)
            @livewire('dokter.modal-cppt', ['pasien' => $pasien])
        @endif
        @if ($openmodalLayanan)
            @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian])
        @endif
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
