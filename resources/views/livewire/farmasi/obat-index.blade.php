<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div id="editObat">
            @if ($form)
                <x-adminlte-card title="Formulir Obat" theme="primary">
                    <form>
                        <input hidden wire:model="id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                                <x-adminlte-input wire:model="kemasan" list="kemasanlist" name="kemasan" label="kemasan"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <datalist id="kemasanlist">
                                    @foreach ($satuans as $key => $satuan)
                                        <option value="{{ $satuan }}"></option>
                                    @endforeach
                                </datalist>
                                <x-adminlte-input wire:model.live="konversi_satuan" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="konversi_satuan" label="Jml Satauan/Kemasan" type="number" />
                                <x-adminlte-input wire:model="satuan" list="satuanlist" name="satuan" label="satuan"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <datalist id="satuanlist">
                                    @foreach ($satuans as $key => $satuan)
                                        <option value="{{ $satuan }}"></option>
                                    @endforeach
                                </datalist>
                                <x-adminlte-input wire:model="stok_minimum" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="stok_minimum" type="number" label="Stok Minimum" />
                                <x-adminlte-select wire:model="jenisobat" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="jenisobat"
                                    label="Jenis Obat">
                                    <option value=null disabled>Pilih Jenis Obat</option>
                                    <option>Obat</option>
                                    <option>Obat Kronis</option>
                                    <option>Obat Kemoterapi</option>
                                    <option>BMHP</option>
                                    <option>Alkes</option>
                                </x-adminlte-select>
                                <x-adminlte-input wire:model="zat_aktif" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="zat_aktif"
                                    label="Zat Aktif" />
                                <x-adminlte-input wire:model="kekuatan" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="kekuatan" label="Kekuatan" />
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-input wire:model.live="harga_beli" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="harga_beli" type="number" label="Harga Beli/Kemasan" />
                                <div class="row mb-4">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <b>Hrg Beli PPN 11% = {{ money(floatval($hargabelippn), 'IDR') }}</b> <br>
                                        <b>Hrg Beli Satuan = {{ money(floatval($hargabelisatuan), 'IDR') }}</b> <br>
                                        <b>Hrg Beli Satuan PPN = {{ money(floatval($hargabelisatuanppn), 'IDR') }}</b>
                                        <br>
                                        <b>Hrg Beli Satuan Margin 25% =
                                            {{ money(floatval($hargabelimargin), 'IDR') }}</b> <br>
                                        <b>Hrg Jual Satuan PPN 11% = {{ money(floatval($hargajualppn), 'IDR') }}</b>
                                        <br>
                                    </div>
                                </div>
                                <x-adminlte-input wire:model="harga_jual" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="harga_jual" type="number" label="harga_jual" />
                                <x-adminlte-input wire:model="harga_bpjs" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="harga_bpjs" type="number" label="harga_bpjs" />
                                <x-adminlte-input wire:model="merk" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="merk" label="merk" />
                                <x-adminlte-input wire:model="distributor" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="distributor" label="distributor" />
                                <x-adminlte-input wire:model="bpom" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="bpom" label="bpom" />
                                <x-adminlte-input wire:model="barcode" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="barcode" label="barcode" />
                            </div>
                        </div>
                    </form>
                    <x-slot name="footerSlot">
                        <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                            wire:confirm="Apakah anda ingin menyimpan data obat ?" form="formUpdate"
                            theme="success" />
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
        </div>
        @if ($formImport)
            <x-modal size="lg" title="Import Data" icon="fas fa-file-import" theme="dark">
                <x-adminlte-input-file wire:model='fileObatImport' name="fileObatImport"
                    placeholder="{{ $fileObatImport ? $fileObatImport->getClientOriginalName() : 'Pilih File Obat' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport data obat ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-modal>
        @endif
        @livewire('farmasi.hitung-stok-obat', ['lazy' => true])
        <x-adminlte-card title="Data Obat" theme="secondary" icon="fas fa-pills">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" title="Tambah" theme="success"
                        icon="fas fa-folder-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload semua data dokter ? ' class="btn-sm"
                        title="Export" theme="primary" icon="fas fa-file-export" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" title="Import" theme="primary"
                        icon="fas fa-file-import" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian"
                        igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>

            @if ($paginate)
                <div class="table-responsive">
                    <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
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
                                            <a href="#editObat">
                                                <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                                    label="Edit" theme="warning" icon="fas fa-edit" />
                                            </a>
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
                </div>
                {{ $obats->links() }}
            @else
                <div class="table-responsive">
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
                </div>
            @endif
        </x-adminlte-card>
    </div>
</div>
