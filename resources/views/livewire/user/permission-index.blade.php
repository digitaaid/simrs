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
    <div id="editPermission">
        @if ($form)
            <x-adminlte-card title="Permission" theme="secondary">
                <form>
                    <input type="hidden" wire:model="id" name="id">
                    <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="name" label="Nama"
                        placeholder="Nama Permission" />
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda yakin ingin menyimpan permission ?" theme="success" />
                    <x-adminlte-button wire:click='closeForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <x-adminlte-card title="Table Permission" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-2" label="Add Permission" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file user saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='openFormImport' class="btn-sm mb-2" label="Import" theme="primary"
                    icon="fas fa-download" />
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
        <table class="table table-sm table-bordered table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $item)
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="#editPermission">
                                <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                    wire:click="edit({{ $item->id }})" theme="warning" />
                            </a>
                            <x-adminlte-button label="Hapus" class="btn-xs" icon="fas fa-trash"
                                wire:click="destroy({{ $item->id }})"
                                wire:confirm="Apakah anda yakin ingin menghapus permission ?" theme="danger" />
                        </td>
                        <td>
                            @foreach ($item->roles as $item)
                                <span class="badge badge-warning">{{ $item->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $permissions->links() }}
    </x-adminlte-card>
</div>
