<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    @if ($formImport)
        <x-adminlte-card title="Import File" theme="secondary">
            <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File' }}" igroup-size="sm"
                label="File Import" />
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                    theme="success" label="Import"
                    wire:confirm='Apakah anda yakin akan mengimport file pasien saat ini ?' />
                <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                    label="Kembali" data-dismiss="modal" />
                <div wire:loading>
                    Loading...
                </div>
            </x-slot>
        </x-adminlte-card>
    @endif
    @if ($form)
        <x-adminlte-card title="Formulir Satuan Obat" theme="primary">
            <!-- Nama Satuan -->
            <x-adminlte-input wire:model="nama" name="nama" label="Nama Satuan" placeholder="Masukkan Nama Satuan"
                fgroup-class="row" label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" />
            <!-- Tombol Aksi -->
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" icon="fas fa-save" class="btn-sm" theme="success" wire:click="store"
                    wire:loading.attr="disabled" wire:confirm="Apakah Anda yakin ingin menyimpan data satuan?" />
                <x-adminlte-button wire:click="tutup" class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
            </x-slot>
        </x-adminlte-card>
    @endif

    <x-adminlte-card title="Daftar Satuan Obat" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Satuan" theme="success"
                    icon="fas fa-plus" />
                <x-adminlte-button wire:click='export' class="btn-sm mb-2" label="Export" theme="primary"
                    icon="fas fa-file-export" />
                <x-adminlte-button wire:click='importform' class="btn-sm mb-2" label="Import" theme="primary"
                    icon="fas fa-file-import" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian" igroup-size="sm">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click="cari" theme="primary" label="Cari" />
                    </x-slot>
                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Satuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($satuanObat as $satuan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $satuan->nama }}</td>
                        <td>
                            <x-adminlte-button wire:click='edit({{ $satuan->id }})' class="btn-xs" theme="warning"
                                icon="fas fa-edit" />
                            <x-adminlte-button wire:click='hapus({{ $satuan->id }})' class="btn-xs" theme="danger"
                                icon="fas fa-trash" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $satuanObat->links() }}
    </x-adminlte-card>
</div>
