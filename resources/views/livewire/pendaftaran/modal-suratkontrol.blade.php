<div id="suratkontrol">
    <x-adminlte-card theme="primary" title="Surat Kontrol Pasien">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-4">
                <x-adminlte-select wire:model="formatfilter" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="formatfilter" label="Filter">
                    <option value=null disabled>Pilih Format Filter</option>
                    <option value="2">Tanggal Rencana Kontrol</option>
                    <option value="1">Tanggal Entri</option>
                </x-adminlte-select>
            </div>
            <div class="col-md-4">
                <x-adminlte-input wire:model="nomorkartu" name="nomorkartu" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="No BPJS">
                </x-adminlte-input>
            </div>
            <div class="col-md-4">
                <x-adminlte-input wire:model="tanggal" type="month" name="tanggal" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Bulan Tahun">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click='cariDataSuratKontrol' theme="primary" label="Cari" />
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <table class="table table-sm table-responsive table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>No Surat Kontrol</th>
                    <th>Jenis Pelayanan</th>
                    <th>Jenis Kontrol</th>
                    <th>Nama Jenis Kontrol</th>
                    <th>Tanggal Rencana Kontrol</th>
                    <th>Tanggal Terbit Kontrol</th>
                    <th>No SEP Asal Kontrol</th>
                    <th>Poli Asal</th>
                    <th>Nama Poli Asal</th>
                    <th>Poli Tujuan</th>
                    <th>Nama Poli Tujuan</th>
                    <th>Tanggal SEP</th>
                    <th>Kode Dokter</th>
                    <th>Nama Dokter</th>
                    <th>No Kartu</th>
                    <th>Nama</th>
                    <th>Terbit SEP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratkontrols as $item)
                    <tr>
                        <td>{{ $item->noSuratKontrol }}</td>
                        <td>{{ $item->jnsPelayanan }}</td>
                        <td>{{ $item->jnsKontrol }}</td>
                        <td>{{ $item->namaJnsKontrol }}</td>
                        <td>{{ $item->tglRencanaKontrol }}</td>
                        <td>{{ $item->tglTerbitKontrol }}</td>
                        <td>{{ $item->noSepAsalKontrol }}</td>
                        <td>{{ $item->poliAsal }}</td>
                        <td>{{ $item->namaPoliAsal }}</td>
                        <td>{{ $item->poliTujuan }}</td>
                        <td>{{ $item->namaPoliTujuan }}</td>
                        <td>{{ $item->tglSEP }}</td>
                        <td>{{ $item->kodeDokter }}</td>
                        <td>{{ $item->namaDokter }}</td>
                        <td>{{ $item->noKartu }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->terbitSEP }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-sm" label="Buat Surat Kontrol"
                wire:click="openForm" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
    @if ($form)
        <x-adminlte-card theme="primary" title="Surat Kontrol Pasien">
            @if (flash()->message)
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                        igroup-size="sm" wire:model='nomorkartu' name="nomorkartu" label="Nomor Kartu" />
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
                        label="Tgl Rencana Kontrol" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" />
                    <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                        igroup-size="sm" name="poliKontrol" wire:model='poliKontrol' label="Poli Kontrol">
                        <option value=null>Pilih Poli Kontrol</option>
                        @foreach ($polis as $key => $item)
                            <option value="{{ $item['kodePoli'] }}">{{ $item['namaPoli'] }}
                                ({{ $item['persentase'] }} %)
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
    @endif

</div>
