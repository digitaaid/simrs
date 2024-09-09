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
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            @include('livewire.dokter.navigasi-pemeriksaan-rajal')
            <x-slot name="footerSlot">
                <a
                    href="{{ route('pemeriksaan.dokter.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}&jadwal={{ $antrian->jadwal_id }}">
                    <x-adminlte-button class="btn-xs mb-2" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
                @if ($antrian->taskid == 3 || $antrian->taskid == 4)
                    <x-adminlte-button wire:click='panggilPemeriksaan' class="btn-xs mb-2" label="Panggil"
                        theme="primary" icon="fas fa-microphone" />
                    <x-adminlte-button wire:click='panggilPemeriksaanMute' class="btn-xs mb-2"
                        label="Panggil Tanpa Suara" theme="warning" icon="fas fa-microphone-slash" />
                @endif
                @if ($antrian->taskid == 4 && $antrian->asesmenrajal?->pic_dokter)
                    <br>
                    <x-adminlte-button wire:click='lanjutFarmasi'
                        wire:confirm='Apakah anda yakin pasien ini dilanjukan ke farmasi untuk pengambilan obat ?'
                        class="btn-xs mb-2" label="Lanjutkan Farmasi" theme="success" icon="fas fa-pills" />
                    <x-adminlte-button wire:click='selesaiPelayanan'
                        wire:confirm='Apakah anda yakin pasien ini telah selesai pelayanan ?' class="btn-xs mb-2"
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
        <div id="icare">
            @livewire('dokter.modal-icare', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="cppt">
            @livewire('dokter.modal-cppt', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="laboratorium">
            @livewire('laboratorium.modal-laboratorium', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="radiologi">
            @livewire('radiologi.modal-radiologi', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="penunjang">
            @livewire('penunjang.modal-penunjang', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="layanan">
            @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian, 'lazy' => true])
        </div>
        <div id="asesmenrajal">
            @livewire('dokter.modal-asesmen-rajal')
        </div>
        @can('perawat')
            <div id="pemeriksaanperawat">
                @livewire('perawat.modal-perawat-rajal', ['antrian' => $antrian, 'lazy' => true])
            </div>
        @endcan
        @can('dokter')
            <div id="pemeriksaandokter">
                @livewire('dokter.modal-dokter-rajal', ['antrian' => $antrian, 'lazy' => true])
            </div>
        @endcan
        <div id="resumerajal">
            @livewire('dokter.modal-resume-rajal', ['antrian' => $antrian, 'lazy' => true])
        </div>
    </div>
</div>
