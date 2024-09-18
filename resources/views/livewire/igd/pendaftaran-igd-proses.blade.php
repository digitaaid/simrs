<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            @include('livewire.igd.modal-profil-igd')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    @include('livewire.igd.modal-navigasi-igd')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        <div id="datapasien">
            @livewire('pendaftaran.modal-pasien-rajal', ['lazy' => true])
        </div>
        <div id="kunjunganigd">
            @livewire('igd.modal-kunjungan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="triaseigd">
            @livewire('igd.modal-triase-igd', ['lazy' => true])
        </div>
        <div id="layanan">
            @livewire('igd.modal-layanan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="resepdokterigd">
            @livewire('igd.modal-resep-dokter-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="asesmenigd">
            @livewire('igd.modal-asesmen-igd', ['lazy' => true])
        </div>
        <div id="tranferrawatinap">
            @livewire('igd.modal-transfer-ranap', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>


    </div>
</div>
