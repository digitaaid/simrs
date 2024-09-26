<div class="row">
    <div class="col-md-12">
        @if ($form)
            <x-adminlte-card title="Formulir Obat" theme="primary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input wire:model="nomor" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nomor" label="Nomor" />
                            <x-adminlte-input wire:model="tanggal_pemesanan" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="tanggal_pemesanan" label="Tgl Pemesanan" />
                            <x-adminlte-input wire:model="penanggungjawab" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="penanggungjawab" label="Penanggungjawab" />
                            <x-adminlte-input wire:model="jabatan" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="jabatan" label="Jabatan" />
                            <x-adminlte-input wire:model="sipa" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="sipa" label="No SIPA" />
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input wire:model="distributor" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="distributor" label="Distributor" />
                            <x-adminlte-input wire:model="alamat" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="alamat" label="Alamat" />
                            <x-adminlte-input wire:model="nohp" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nohp" label="No HP" />
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input wire:model="apoteker" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="apoteker" label="Nama Apoteker" />
                            <x-adminlte-input wire:model="faskes" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="faskes" label="Nama Sarana" />
                            <x-adminlte-input wire:model="alamat_faskes" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="alamat_faskes" label="Alamat Sarana" />
                            <x-adminlte-input wire:model="no_oss" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="no_oss" label="No Ijin Sarana (OSS)" />
                        </div>
                        <div class="col-md-12">
                            <h5>Obat Yang Dipesan</h5>
                            @foreach ($resepObat as $index => $obat)
                                <div class="row">
                                    <div class="col-md-3">
                                        @error('resepObat.' . $index . '.obat')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                        <x-adminlte-input wire:model.change="resepObat.{{ $index }}.obat"
                                            list="obatlist" name="obat[]" igroup-size="sm"
                                            placeholder="Nama Obat" />
                                        <datalist id="obatlist">
                                            @foreach ($obats as $key => $obat)
                                                <option value="{{ $obat->nama }}">
                                                    Rp. {{ $obat->harga_beli }} / {{ $obat->kemasan }}
                                                </option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="col-md-2">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.zat_aktif"
                                            name="zat_aktif[]" igroup-size="sm" placeholder="zat_aktif" />
                                    </div>
                                    <div class="col-md-1">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.satuan"
                                            name="satuan[]" igroup-size="sm" placeholder="satuan" />
                                    </div>
                                    <div class="col-md-2">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.kekuatan"
                                            name="kekuatan[]" igroup-size="sm" placeholder="kekuatan" />
                                    </div>
                                    <div class="col-md-1">
                                        @error('resepObat.' . $index . '.jumlah')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlah"
                                            name="jumlah[]" igroup-size="sm" type="number"
                                            placeholder="Jumlah Obat" />
                                    </div>
                                    <div class="col-md-1">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.kemasan"
                                            name="kemasan[]" igroup-size="sm" placeholder="kemasan" />
                                    </div>
                                    <div class="col-md-1">
                                        <x-adminlte-button wire:click='removeObat({{ $index }})'
                                            class="btn-sm" theme="danger" icon="fas fa-trash" />
                                    </div>
                                </div>
                            @endforeach
                            <button wire:click.prevent="addObat" class="btn btn-success btn-sm"><i
                                    class="fas fa-plus"></i>
                                Tambah Obat</button>
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda ingin menyimpan data pemesanan obat ?" theme="success" />
                    <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Data Pemesanan Obat" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tambah Pemesanan" theme="success"
                        icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload data semua obat ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='formimport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </x-adminlte-card>
    </div>
</div>
