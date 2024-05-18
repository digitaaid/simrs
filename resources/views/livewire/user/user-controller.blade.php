<div>
    <x-adminlte-modal id="modalUser" title="Theme Purple" theme="purple" icon="fas fa-bolt" size='lg'>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" wire:model="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" wire:click="store" label="Simpan" />
            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    {{-- Example button to open modal --}}
    <x-adminlte-button label="Open Modal" data-toggle="modal" data-target="#modalUser" class="bg-purple" />
    <x-adminlte-card title="Table User" theme="secondary">
        <div class="row ">
            <div class="col-md-6">
                <x-adminlte-button wire:click="openModal()" class="btn-sm" label="Tambah User" theme="success"
                    icon="fas fa-user-plus" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Pegawai"
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
                    <th>Email</th>
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
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <x-adminlte-button wire:click="edit({{ $user->id }})" class="btn-xs" label="Edit"
                                theme="warning" icon="fas fa-edit" />
                            <x-adminlte-button wire:click="delete({{ $user->id }})" class="btn-xs" label="Hapus"
                                theme="danger" icon="fas fa-trash" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </x-adminlte-card>
</div>
