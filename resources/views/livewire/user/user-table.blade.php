<div>
    <x-adminlte-card title="Table User" theme="secondary">
        <div class="row ">
            <div class="col-md-8">
                <a href="{{ route('user.create') }}" wire:navigate>
                    <x-adminlte-button class="btn-sm" label="Tambah User" theme="success" icon="fas fa-user-plus" />
                </a>
            </div>
            <div class="col-md-4">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian USer" igroup-size="sm">
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
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" wire:navigate>
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
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
