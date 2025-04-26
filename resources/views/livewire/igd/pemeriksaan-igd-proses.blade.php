<div class="row">
    <x-flash-message />
    {{-- navigasi --}}
    @include('livewire.igd.navigasi-pemeriksaan-igd')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        <div id="identitas">
            @livewire('igd.modal-identitas-pasien', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="generalconsent">
            @livewire('igd.modal-general-consent', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="triaseigd">
            @livewire('igd.modal-triase-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="asesmenigd">
            @livewire('igd.modal-asesmen-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="riwayatobat">
            @livewire('igd.modal-riwayat-obat', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="soap">
            @livewire('igd.modal-soap', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="layanan">
            @livewire('igd.modal-layanan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        <div id="resepobat">
            @livewire('igd.modal-resep-dokter-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
    </div>
</div>
