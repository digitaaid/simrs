<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table Pegawai" theme="secondary">
            @php
                $heads = ['#', 'Nama', 'NIK', 'No HP', 'Email', 'Action', 'Verify', 'PIC', 'Updated'];
                $config['paging'] = false;
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="nowrap" :heads="$heads" :config="$config" bordered compressed>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->pegawai?->nik }}</td>
                        <td>{{ $user->pegawai?->nohp }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a wire:navigate href="{{ route('pegawai.edit', $user) }}">
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->pegawai?->pic }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            <x-slot name="footerSlot">
                <a wire:navigate href="{{ route('pegawai.create') }}">
                    <x-adminlte-button class="btn-sm" label="Tambah Pegawai" theme="success" icon="fas fa-user-plus" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
