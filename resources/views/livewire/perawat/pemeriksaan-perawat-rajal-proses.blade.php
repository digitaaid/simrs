<div class="row">
    {{-- profiles --}}
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
    {{-- navigasis --}}
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            @include('livewire.dokter.navigasi-pemeriksaan-rajal')
            <x-slot name="footerSlot">
                <a
                    href="{{ route('pemeriksaan.perawat.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}&jadwal={{ $antrian->jadwal_id }}">
                    <x-adminlte-button class="btn-xs mb-2" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
                <x-adminlte-button wire:click='selesaiPerawat'
                    wire:confirm='Apakah anda yakin telah selesai pemeriksaan perawat ?' class="btn-xs mb-2"
                    label="Selesai & Kembali" theme="success" icon="fas fa-check" />
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
        @livewire('dokter.modal-icare', ['antrian' => $antrian, 'lazy' => true])
        <div id="cppt">
            @livewire('dokter.modal-cppt', ['antrian' => $antrian, 'lazy' => true])
        </div>
        @livewire('laboratorium.modal-laboratorium', ['antrian' => $antrian, 'lazy' => true])
        @livewire('radiologi.modal-radiologi', ['antrian' => $antrian, 'lazy' => true])
        @livewire('penunjang.modal-penunjang', ['antrian' => $antrian, 'lazy' => true])
        @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian, 'lazy' => true])
        {{-- @livewire('dokter.modal-asesmen-rajal') --}}
        @can('perawat')
            @livewire('perawat.modal-perawat-rajal', ['antrian' => $antrian, 'lazy' => true])
        @endcan
        @can('dokter')
            @livewire('dokter.modal-dokter-rajal', ['antrian' => $antrian, 'lazy' => true])
        @endcan
        <div id="resumerajal">
            @livewire('dokter.modal-resume-rajal', ['antrian' => $antrian, 'lazy' => true])
        </div>
    </div>
</div>
