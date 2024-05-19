<div>
    @if ($form)
        <x-adminlte-card title="Aplikasi Integrasi" theme="secondary">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" wire:model="id" name="id">
                        <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="name" label="Nama"
                            placeholder="Nama Aplikasi Integrasi" />
                        <x-adminlte-input wire:model="slug" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="slug" label="slug" placeholder="slug" />
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
    <x-adminlte-card title="Table Aplikasi Integrasi" theme="secondary">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-8">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-3" label="Add Permission" theme="success"
                    icon="fas fa-user-plus" />
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
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
                            <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                wire:click="edit({{ $item->id }})" theme="warning" />
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
    </x-adminlte-card>
</div>
