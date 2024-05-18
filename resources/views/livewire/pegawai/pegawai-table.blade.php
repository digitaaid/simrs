<div>
    <x-adminlte-card title="Table Pegawai" theme="secondary">
        <div class="row ">
            <div class="col-md-8">
                <a wire:navigate href="{{ route('pegawai.create') }}">
                    <x-adminlte-button class="btn-sm" label="Tambah Pegawai" theme="success" icon="fas fa-user-plus" />
                </a>
            </div>
            <div class="col-md-4">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Pegawai"
                    igroup-size="sm">
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
                    <th wire:click="sort('name')">
                        @if ($sortBy === 'name')
                            @if ($sortDirection === 'asc')
                                <i class="fa fa-sort-alpha-down"></i>
                            @else
                                <i class="fa fa-sort-alpha-up"></i>
                            @endif
                        @endif
                        Nama
                    </th>
                    <th>NIK</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Action</th>
                    <th>Verify</th>
                    <th>PIC</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td scope="row">{{ $loop->index + $users->firstItem() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->pegawai?->nik }}</td>
                        <td>{{ $user->pegawai?->nohp }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a wire:navigate href="{{ route('pegawai.edit', $user->id) }}">
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->pegawai?->pic }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </x-adminlte-card>
</div>
