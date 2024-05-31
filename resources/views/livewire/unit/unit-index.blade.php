<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <x-adminlte-card title="Identitas Dokter" theme="secondary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                            <x-adminlte-input wire:model="kode" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="kode" label="Kode" />
                            <x-adminlte-input wire:model="kodejkn" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="kodejkn" label="Kode JKN" />
                            <x-adminlte-input wire:model="idorganization" fgroup-class="row"
                                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                name="idorganization" label="idorganization" />
                            <x-adminlte-input wire:model="idlocation" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="idlocation" label="idlocation" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-select wire:model="jenis" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="jenis" label="jenis">
                                <option value=null disabled>Pilih Jenis</option>
                                <option>Pelayanan Rawat Jalan</option>
                                <option>Pelayanan Rawat Inap</option>
                                <option>Pelayanan Rawat IGD</option>
                                <option>Pelayanan Farmasi</option>
                            </x-adminlte-select>
                            <x-adminlte-input wire:model="lokasi" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="lokasi" label="lokasi" />
                        </div>
                    </div>

                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                        wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan unit ?" form="formUpdate"
                        theme="success" />
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
        @if ($formImport)
            <x-adminlte-card title="Import Dokter" theme="secondary">
                <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                    placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File Import' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import" wire:confirm='Apakah anda yakin akan mengimport data dokter ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table item" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah item" theme="success"
                        icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload semua data dokter ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Dokter"
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
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Kode JKN</th>
                        <th>Nama</th>
                        <th>IdOrganizataion</th>
                        <th>IdLocation</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>PIC</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->index + $units->firstItem() }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->kodejkn }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->idorganization }}</td>
                            <td>{{ $item->idlocation }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">active</span>
                                @else
                                    <span class="badge badge-danger">nonactive</span>
                                @endif
                            </td>
                            <td>
                                <x-adminlte-button class="btn-xs" wire:click='edit({{ $item }})'
                                    label="Edit" theme="warning" icon="fas fa-edit" />
                                <x-adminlte-button class="btn-xs" wire:click='destroy({{ $item }})'
                                    wire:confirm="Apakah anda yakin ingin menghapus unit ?" theme="danger"
                                    icon="fas fa-trash" />
                                <x-adminlte-button class="btn-xs" wire:click='nonaktif({{ $item }})'
                                    wire:confirm="Apakah anda yakin ingin nonactive unit ?" label="Nonaktif"
                                    theme="danger" icon="fas fa-times" />
                            </td>
                            <td>{{ $item->pic }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $units->links() }}
        </x-adminlte-card>
    </div>
</div>
