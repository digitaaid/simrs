<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            <a href="{{ route('pemeriksaan.dokter.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                <x-adminlte-button class="btn-xs" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            @if ($antrian->taskid <= 4)
                <x-adminlte-button wire:click='panggilPemeriksaan' class="btn-xs" label="Panggil Pemeriksaan"
                    theme="primary" icon="fas fa-microphone" />
            @endif
            @include('livewire.pendaftaran.modal-profil-rajal')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            @include('livewire.dokter.navigasi-pemeriksaan-rajal')
            <x-slot name="footerSlot">
                <a href="{{ route('pemeriksaan.dokter.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                    <x-adminlte-button class="btn-xs" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
                @if ($antrian->taskid <= 4)
                    <x-adminlte-button wire:click='lanjutFarmasi'
                        wire:confirm='Apakah anda yakin pasien ini dilanjukan ke farmasi untuk pengambilan obat ?'
                        class="btn-xs" label="Lanjutkan Farmasi" theme="success" icon="fas fa-pills" />
                    <x-adminlte-button wire:click='selesaiPelayanan'
                        wire:confirm='Apakah anda yakin pasien ini telah selesai pelayanan ?' class="btn-xs"
                        label="Selesai Pelayanan" theme="success" icon="fas fa-check" />
                @endif
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
