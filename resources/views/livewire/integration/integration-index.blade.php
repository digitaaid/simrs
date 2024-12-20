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
    <div id="editIntegration">
        @if ($isFormVisible)
            <x-adminlte-card title="Aplikasi Integrasi" theme="secondary">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="id" name="id">
                            <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="name" label="Nama"
                                placeholder="Nama Aplikasi Integrasi" />
                            <x-adminlte-input wire:model="slug" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="slug" label="slug"
                                placeholder="slug" />
                            <x-adminlte-input wire:model="description" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="description" label="description"
                                placeholder="description" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input wire:model="auth_url" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="auth_url" label="auth_url"
                                placeholder="auth_url" />
                            <x-adminlte-input wire:model="base_url" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="base_url" label="base_url"
                                placeholder="base_url" />
                            <x-adminlte-input wire:model="user_id" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="user_id" label="user_id"
                                placeholder="user_id" />
                            <x-adminlte-input wire:model="user_key" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="user_key" label="user_key"
                                placeholder="user_key" />
                            <x-adminlte-input wire:model="secret_key" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" name="secret_key" label="secret_key"
                                placeholder="secret_key" />
                        </div>
                    </div>

                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda yakin ingin menyimpan Aplikasi Integrasi ?" theme="success" />
                    <x-adminlte-button wire:click='closeForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <x-adminlte-card title="Table Aplikasi Integrasi" theme="secondary">
        <div class="row">
            <div class="col-md-8">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-2" label="Tambah Integrasi"
                    theme="success" icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='openFormImport' class="btn-sm mb-2" label="Import" theme="primary"
                    icon="fas fa-download" />
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap table-sm table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th>User</th>
                        <th>BaseUrl</th>
                        <th>AuthUrl</th>
                        <th>UserKey</th>
                        <th>SecretKey</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($integrations as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="#editIntegration">
                                    <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                        wire:click="edit({{ $item->id }})" theme="warning" />
                                </a>
                            </td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->base_url }}</td>
                            <td>{{ $item->auth_url }}</td>
                            <td>{{ $item->user_key }}</td>
                            <td>{{ $item->secret_key }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-adminlte-card>
</div>
