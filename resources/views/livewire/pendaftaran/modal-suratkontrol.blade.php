<div id="suratkontrol">
    <x-adminlte-card theme="primary" title="Surat Kontrol Pasien">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                    wire:model='nomorkartu' name="nomorkartu" label="Nomor Kartu" />
                <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="noSEP" wire:model='noSEP' label="No SEP">
                    <option value=null>Pilih No SEP</option>
                    @foreach ($seps as $key => $item)
                        <option value="{{ $item['noSep'] }}">{{ $item['noSep'] }}
                            {{ $item['tglSep'] }} {{ $item['poli'] }} {{ $item['ppkPelayanan'] }}</option>
                    @endforeach
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariSEP'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-input wire:model='tglRencanaKontrol' name="tglRencanaKontrol" type='date'
                    label="Tgl Rencana Kontrol" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" />
                <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="poliKontrol" wire:model='poliKontrol' label="Poli Kontrol">
                    <option value=null>Pilih Poli Kontrol</option>
                    @foreach ($polis as $key => $item)
                        <option value="{{ $item['kodePoli'] }}">{{ $item['namaPoli'] }} ({{ $item['persentase'] }} %)
                        </option>
                    @endforeach
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariPoli'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="kodeDokter" wire:model='kodeDokter' label="Dokter">
                    <option value=null>Pilih Poli Kontrol</option>
                    @foreach ($dokters as $key => $item)
                        <option value="{{ $item['kodeDokter'] }}">{{ $item['namaDokter'] }}
                            ({{ $item['jadwalPraktek'] }})
                        </option>
                    @endforeach
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariDokter'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-select>
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="buatSuratKontrol" wire:confirm='Apakah anda yakin ingin membuat surat kontrol ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
