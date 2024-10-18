<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($formimport)
            <x-adminlte-card title="Import Data" theme="secondary">
                <x-adminlte-input-file wire:model='fileimport' name="fileimport"
                    placeholder="{{ $fileimport ? $fileimport->getClientOriginalName() : 'Pilih File' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import" wire:confirm='Apakah anda yakin akan mengimport data ?' />
                    <x-adminlte-button theme="danger" wire:click='importform' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-card>
        @endif
        @if ($form)
            <x-adminlte-card title="Detail Informasi Dokter" theme="secondary">
                <form>
                    <input type="hidden" name="id" wire:model='id'>
                    <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                    <x-adminlte-input wire:model="slug" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="slug" label="Slug" />
                    <x-adminlte-input wire:model="jam_masuk" fgroup-class="row" type="time"
                        label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="jam_masuk"
                        label="Jam Masuk" />
                    <x-adminlte-input wire:model="jam_pulang" fgroup-class="row" type="time"
                        label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="jam_pulang"
                        label="Jam Pulang" />
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda ingi menyimpan data shift kerja ?" theme="success" />
                    <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Jadwal Shift Kerja" theme="primary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Shift Kerja"
                        theme="success" icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export' wire:confirm='Apakah anda yakin akan export data ? '
                        class="btn-sm mb-2" label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='importform' class="btn-sm mb-2" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Shift Kerja</th>
                        <th>Slug</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->jam_masuk }}</td>
                            <td>{{ $item->jam_pulang }}</td>
                            <td>
                                <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs" label="Edit"
                                    theme="warning" icon="fas fa-edit" />
                                <x-adminlte-button wire:confirm='Apakah anda yakin akan menghapus jadwal tersebut ?'
                                    wire:click='hapus({{ $item }})' class="btn-xs" label="Hapus"
                                    theme="danger" icon="fas fa-trash" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
