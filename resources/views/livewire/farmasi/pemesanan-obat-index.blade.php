<div class="row">
    <div class="col-md-12">
        @if ($form)
            <x-adminlte-card title="Formulir Obat" theme="primary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input wire:model="nomor" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nomor" label="Nomor" readonly />
                            <x-adminlte-input wire:model="tgl_pemesanan" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="tgl_pemesanan" type="date" label="Tgl Pemesanan" />
                            <x-adminlte-input wire:model="penanggungjawab" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="penanggungjawab" label="Penanggungjawab" />
                            <x-adminlte-input wire:model="jabatan" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="jabatan" label="Jabatan" />
                            <x-adminlte-input wire:model="sipa" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="sipa" label="No SIPA" />
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input wire:model.live="supplier" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" list="supplierlist" igroup-size="sm"
                                name="supplier" label="Supplier" />
                            <datalist id="supplierlist">
                                @foreach ($suppliers as $key => $nama)
                                    <option value="{{ $nama }}"></option>
                                @endforeach
                            </datalist>
                            <x-adminlte-input wire:model="alamat_supplier" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="alamat_supplier" label="Alamat" />
                            <x-adminlte-input wire:model="nohp_supplier" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="nohp_supplier" label="No HP" />
                            <x-adminlte-input wire:model="keterangan" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="keterangan" label="Keterangan" />
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input wire:model="apoteker" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="apoteker" label="Nama Apoteker" />
                            <x-adminlte-input wire:model="nama_sarana" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nama_sarana" label="Nama Sarana" />
                            <x-adminlte-input wire:model="alamat_sarana" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="alamat_sarana" label="Alamat Sarana" />
                            <x-adminlte-input wire:model="no_izin_sarana" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="no_izin_sarana" label="No Ijin Sarana (OSS)" />
                        </div>
                        <div class="col-md-12">
                            <h5>Obat Yang Dipesan</h5>
                            @foreach ($resepObat as $index => $obat)
                                <div class="row">
                                    <div class="col-md-2">
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
                                    <div class="col-md-2">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.kekuatan"
                                            name="kekuatan[]" igroup-size="sm" placeholder="kekuatan" />
                                    </div>
                                    <div class="col-md-1">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.satuan"
                                            name="satuan[]" igroup-size="sm" placeholder="satuan" />
                                    </div>
                                    <div class="col-md-2">
                                        <x-adminlte-input wire:model="resepObat.{{ $index }}.harga_beli"
                                            name="harga_beli[]" igroup-size="sm" placeholder="harga_beli" />
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
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="simpan"
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
                    <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Pemesanan"
                        theme="success" icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload data semua obat ? ' class="btn-sm mb-2"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='formimport' class="btn-sm mb-2" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tgl Pemesanan</th>
                        <th>Nomor</th>
                        <th>Keterangan</th>
                        <th>Supplier</th>
                        <th>Penganggungjawab</th>
                        <th>Apoteker</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tgl_pemesanan }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->nama_supplier }}</td>
                            <td>{{ $item->penanggungjawab }}</td>
                            <td>{{ $item->apoteker }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <x-adminlte-button wire:click='edit({{ $item->id }})' class="btn-xs"
                                    theme="warning" icon="fas fa-edit" />
                                <x-adminlte-button wire:click='hapus({{ $item->id }})' class="btn-xs"
                                    theme="danger" icon="fas fa-trash" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>

    </div>
</div>
