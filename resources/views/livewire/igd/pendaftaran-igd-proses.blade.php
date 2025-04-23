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
    @include('livewire.igd.navigasi-pendaftaran-igd')
    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        <div id="datapasien">
            @livewire('pendaftaran.modal-pasien-rajal', ['lazy' => true])
        </div>
        <div id="kunjunganigd">
            @livewire('igd.modal-kunjungan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
        </div>
        @if ($kunjungan)
            <div id="suratkontrol">
                @livewire('pendaftaran.modal-suratkontrol', ['kunjungan' => $kunjungan, 'lazy' => true])
            </div>
            <div id="modalsep">
                @livewire('pendaftaran.modal-sep', ['kunjungan' => $kunjungan, 'lazy' => true])
            </div>
            {{-- <div id="triaseigd">
                @livewire('igd.modal-triase-igd', ['lazy' => true])
            </div> --}}
            <div id="layanan">
                @livewire('igd.modal-layanan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
            </div>
            <div id="resepdokterigd">
                @livewire('igd.modal-resep-dokter-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
            </div>
            {{-- <div id="asesmenigd">
                @livewire('igd.modal-asesmen-igd', ['lazy' => true])
            </div> --}}
            {{-- <div id="tranferrawatinap">
                @livewire('igd.modal-transfer-ranap', ['lazy' => true, 'kunjungan' => $kunjungan])
            </div> --}}
            <div id="invoiceigd">
                <x-adminlte-card theme="primary" title="Nota Pembayaran Pasien">
                    <iframe src="{{ route('print.notarajalf', $kunjungan->kode) }}" width="100%" height="500"
                        frameborder="0"></iframe>
                </x-adminlte-card>
            </div>
            <div id="pemulanganigd">
                @livewire('igd.modal-pemulangan-igd', ['lazy' => true, 'kunjungan' => $kunjungan])
            </div>
        @endif
    </div>
</div>
