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
        @livewire('pendaftaran.modal-pasien-rajal', ['lazy' => true])
        @livewire('pendaftaran.modal-antrian-rajal', ['antrian' => $antrian, 'lazy' => true])
        @livewire('pendaftaran.modal-kunjungan-rajal', ['antrian' => $antrian, 'lazy' => true])
        @if ($antrian->pasien && $antrian->jenispasien == 'JKN')
            @livewire('pendaftaran.modal-sep', ['antrian' => $antrian, 'lazy' => true])
            @livewire('pendaftaran.modal-suratkontrol', ['antrian' => $antrian, 'lazy' => true])
        @endif
        @if ($antrian->kunjungan)
            @livewire('dokter.modal-cppt', ['antrian' => $antrian, 'lazy' => true])
            @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian, 'lazy' => true])
            <div id="notaPembayaran">
                <x-adminlte-card theme="primary" title="Nota Pembayaran Pasien">
                    {{-- <iframe src="{{ route('print.notarajal', $antrian->kodebooking) }}" width="100%" height="500"
                        frameborder="0"></iframe> --}}
                </x-adminlte-card>
            </div>
        @endif
    </div>
</div>
