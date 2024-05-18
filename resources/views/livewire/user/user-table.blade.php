<div>
    @if ($form)
        @livewire('user.user-form', ['id' => $id])
    @endif
    <x-adminlte-card title="Table User" theme="secondary">
        <div class="row ">
            <div class="col-md-6">
                <x-adminlte-button wire:click="formShow(null)" class="btn-sm" label="Tambah User" theme="success"
                    icon="fas fa-user-plus" />
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
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
                            <x-adminlte-button wire:click="formShow({{ $user->id }})" class="btn-xs"
                                label="Edit" theme="warning" icon="fas fa-edit" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </x-adminlte-card>
</div>
