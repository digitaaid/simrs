<div class="row">
    <div class="col-md-12">
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
        @if ($formUser)
            <x-adminlte-card title="Identitas User" theme="secondary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="name" label="Nama" />
                    <x-adminlte-input wire:model="username" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="username" label="Username" />
                    <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="email" type="email" label="Email" />
                    <x-adminlte-input wire:model="phone" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="phone" label="Phone" />
                    <x-adminlte-select wire:model="role" name="role" label="Role" fgroup-class="row"
                        label-class="text-left col-3" igroup-class="col-9" igroup-size="sm">
                        <option value="">--Pilih Role--</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input wire:model="password" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" type="password" name="password" label="Password"
                        placeholder="Kosongkan jika tidak ingin ada perubahan" />
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="save"
                        wire:confirm="Apakah anda yakin ingin menambahkan user ?" form="formUpdate" theme="success" />
                    <x-adminlte-button class="btn-sm" wire:click="batal" label="Batal" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <div>
            <x-adminlte-card title="Table User" theme="secondary">
                <div class="row ">
                    <div class="col-md-8">
                        <x-adminlte-button class="btn-sm mb-2" wire:click='tambah' label="Tambah User" theme="success"
                            icon="fas fa-user-plus" />
                        <x-adminlte-button wire:click='export'
                            wire:confirm='Apakah anda yakin akan mendownload file user saat ini ? ' class="btn-sm mb-2"
                            label="Export" theme="primary" icon="fas fa-upload" />
                        <x-adminlte-button wire:click='openFormImport' class="btn-sm mb-2" label="Import"
                            theme="primary" icon="fas fa-download" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian"
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
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>PIC</th>
                            <th>Verify</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr wire:key="{{ $user->id }}">
                                <td scope="row">{{ $loop->index + $users->firstItem() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>{{ $user->pic }}</td>
                                <td>{{ $user->email_verified_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <x-adminlte-button class="btn-xs" wire:click="edit('{{ $user->id }}')"
                                        label="Edit" theme="warning" icon="fas fa-edit" />
                                    <x-adminlte-button wire:click="verifikasi('{{ $user->id }}')"
                                        wire:confirm="Apakah anda yakin ingin memverifikasi user {{ $user->name }} ?"
                                        class="btn-xs" title="Verifikasi Email"
                                        theme="{{ $user->email_verified_at ? 'danger' : 'success' }}"
                                        icon="fas fa-{{ $user->email_verified_at ? 'times' : 'check' }}" />
                                    <x-adminlte-button wire:click='hapus({{ $user->id }})'
                                        wire:confirm="Apakah anda yakin ingin menghapus user {{ $user->name }} ?"
                                        class="btn-xs" title="Hapus User" theme="danger" icon="fas fa-trash" />

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </x-adminlte-card>
        </div>
    </div>
</div>
