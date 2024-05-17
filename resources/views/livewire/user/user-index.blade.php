<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table User" theme="secondary">
            @php
                $heads = ['#', 'Nama', 'Email', 'Verify', 'Updated', 'Action'];
                $config['paging'] = false;
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="nowrap" :heads="$heads" :config="$config" bordered compressed>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a wire:navigate href="{{ route('user.edit', $user) }}">
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            <x-slot name="footerSlot">
                <a wire:navigate href="{{ route('user.create') }}">
                    <x-adminlte-button class="btn-sm" label="Tambah User" theme="success" icon="fas fa-user-plus" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
@section('plugins.Datatables', true)
