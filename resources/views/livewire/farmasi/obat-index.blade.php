<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <x-adminlte-card title="Formulir Obat" theme="primary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                            <x-adminlte-input wire:model="kemasan" list="kemasanlist" name="kemasan" label="kemasan"
                                fgroup-class="row" label-class="text-right col-4" igroup-class="col-8"
                                igroup-size="sm" />
                            <datalist id="kemasanlist">
                                <option value="Kemasan"></option>
                            </datalist>
                            <x-adminlte-input wire:model="konversi_satuan" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="konversi_satuan" label="konversi_satuan" type="number" />
                            <x-adminlte-input wire:model="satuan" list="satuanlist" name="satuan" label="satuan"
                                fgroup-class="row" label-class="text-right col-4" igroup-class="col-8"
                                igroup-size="sm" />
                            <datalist id="satuanlist">
                                <option value="Satuan"></option>
                            </datalist>
                            <x-adminlte-input wire:model="stok_minimum" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="stok_minimum"
                                type="number" label="stok_minimum" />
                            <x-adminlte-select wire:model="jenisobat" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="jenisobat" label="jenisobat">
                                <option value=null disabled>Pilih Jenis Obat</option>
                                <option>Obat</option>
                                <option>Obat Kronis</option>
                                <option>Obat Kemoterapi</option>
                                <option>BMHP</option>
                                <option>Alkes</option>
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input wire:model="harga_beli" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="harga_beli" type="number"
                                label="Harga Beli/Kemasan" />
                            <br>
                            <b>Harga Beli Satuan = </b>
                            <x-adminlte-input wire:model="harga_jual" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="harga_jual" type="number"
                                label="harga_jual" />
                            <x-adminlte-input wire:model="harga_bpjs" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="harga_bpjs" type="number"
                                label="harga_bpjs" />
                            <x-adminlte-input wire:model="merk" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="merk" label="merk" />
                            <x-adminlte-input wire:model="distributor" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="distributor" label="distributor" />
                            <x-adminlte-input wire:model="bpom" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="bpom" label="bpom" />
                            <x-adminlte-input wire:model="barcode" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="barcode" label="barcode" />
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda ingin menyimpan data obat ?" form="formUpdate" theme="success" />
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                    @if ($obat)
                        <x-adminlte-button label="Non-Aktifkan" class="btn-sm" icon="fas fa-trash"
                            wire:click="nonaktif({{ $obat->id }})"
                            wire:confirm="Apakah anda ingin menonaktifkan obat ?" theme="danger" />
                    @endif

                </x-slot>
            </x-adminlte-card>
        @endif
        @if ($formImport)
            <x-adminlte-card title="Import Obat" theme="secondary">
                <x-adminlte-input-file wire:model='fileObatImport' name="fileObatImport"
                    placeholder="{{ $fileObatImport ? $fileObatImport->getClientOriginalName() : 'Pilih File Obat' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport data obat ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $obataktif ?? '-' }}" text="Semua Obat" theme="success"
                    icon="fas fa-pills" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $stokterbatas ?? '-' }}" text="Stok Obat Minimum" theme="danger"
                    icon="fas fa-pills" url="{{ route('obat.index') }}?filter=minimum" url-text="View details" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $stokminus ?? '-' }}" text="Stok Obat Minus" theme="danger"
                    icon="fas fa-pills" url="{{ route('obat.index') }}?filter=minus" url-text="View details" />
            </div>
        </div>
        <x-adminlte-card title="Data Obat-Obat" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah Obat" theme="success"
                        icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload data semua obat ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Obat"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            @if ($paginate)
                <table class="table text-nowrap table-sm table-hover table-bordered table-responsive mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            <th>Harga/Kemasan</th>
                            <th>Satuan/Kemasasn</th>
                            <th>Harga/Satuan</th>
                            <th>Harga BPJS</th>
                            <th>Action</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Merek</th>
                            <th>Distributor</th>
                            <th>BPOM</th>
                            <th>Barcode</th>
                            <th>PIC</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td>{{ $loop->index + $obats->firstItem() }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->real_stok }}</td>
                                <td>{{ $item->stok_minimum }}</td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_beli) ? money(floatval($item->harga_beli), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td>{{ $item->konversi_satuan }} {{ $item->satuan }} / {{ $item->kemasan }}</td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_jual) ? money(floatval($item->harga_jual), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_bpjs) ? money(floatval($item->harga_bpjs), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td>
                                    @can('farmasi')
                                        <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                            label="Edit" theme="warning" icon="fas fa-edit" />
                                    @endcan
                                    <a href="{{ route('stokobat.index') }}?kode={{ $item->id }}">
                                        <x-adminlte-button class="btn-xs" label="Stok" theme="primary"
                                            icon="fas fa-box" />
                                    </a>
                                </td>
                                <td>{{ $item->jenisobat }}</td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->distributor }}</td>
                                <td>{{ $item->bpom }}</td>
                                <td>{{ $item->barcode }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $obats->links() }}
            @else
                <table class="table text-nowrap table-sm table-hover table-bordered table-responsive mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            <th>Harga/Kemasan</th>
                            <th>Satuan/Kemasasn</th>
                            <th>Harga/Satuan</th>
                            <th>Harga BPJS</th>
                            <th>Action</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Merek</th>
                            <th>Distributor</th>
                            <th>BPOM</th>
                            <th>Barcode</th>
                            <th>PIC</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->real_stok }}</td>
                                <td>{{ $item->stok_minimum }}</td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_beli) ? money(floatval($item->harga_beli), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td>{{ $item->konversi_satuan }} {{ $item->satuan }} / {{ $item->kemasan }}</td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_jual) ? money(floatval($item->harga_jual), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td class="text-right">
                                    {{ is_numeric($item->harga_bpjs) ? money(floatval($item->harga_bpjs), 'IDR') : 'Tidak Valid' }}
                                </td>
                                <td>
                                    <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                        label="Edit" theme="warning" icon="fas fa-edit" />
                                    <a href="{{ route('stokobat.index') }}?kode={{ $item->id }}">
                                        <x-adminlte-button class="btn-xs" label="Stok" theme="primary"
                                            icon="fas fa-box" />
                                    </a>
                                </td>
                                <td>{{ $item->jenisobat }}</td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->distributor }}</td>
                                <td>{{ $item->bpom }}</td>
                                <td>{{ $item->barcode }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </x-adminlte-card>
    </div>
</div>
