<div>
    @if ($form)
        <x-adminlte-card title="Role" theme="secondary">
            <form>
                <input type="hidden" wire:model="id" name="id">
                <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="name" label="Nama" placeholder="Nama Role" />
                <div class="form-group">
                    <div class="row">
                        @foreach ($permissions as $id => $name)
                            <div class="custom-control custom-checkbox col-md-4">
                                <input class="custom-control-input" type="checkbox" name="selectedPermissions" id="permission{{ $id }}"
                                    wire:model="selectedPermissions"
                                    value="{{ $name }}" >
                                <label for="permission{{ $id }}"
                                    class="custom-control-label">{{ $name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                    wire:confirm="Apakah anda yakin ingin menyimpan Role ?" theme="success" />
                <x-adminlte-button wire:click='closeForm' class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
            </x-slot>
        </x-adminlte-card>
    @endif
    <x-adminlte-card title="Table Role" theme="secondary">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-3" label="Add Role" theme="success"
                    icon="fas fa-user-plus" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Role" igroup-size="sm">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click="test" theme="primary" label="Cari" />
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
                    <th>Name</th>
                    <th>Permission</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $item)
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @forelse ($item->permissions as $permission)
                                <span class="badge badge-warning">{{ $permission->name }}</span>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td></td>
                        <td>
                            <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                wire:click="edit({{ $item->id }})" theme="warning" />
                            <x-adminlte-button label="Hapus" class="btn-xs" icon="fas fa-trash"
                                wire:click="destroy({{ $item->id }})"
                                wire:confirm="Apakah anda yakin ingin menghapus Role {{ $item->name }} ?"
                                theme="danger" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
</div>
