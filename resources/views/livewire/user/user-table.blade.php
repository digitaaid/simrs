<div>
    @php
        $heads = ['#', 'Nama', 'Email', 'Verify', 'Updated', 'Action'];
        $config['paging'] = false;
        $config['scrollX'] = true;
    @endphp
    <x-adminlte-datatable id="table1" class="nowrap" :heads="$heads" :config="$config" bordered compressed>
        @foreach ($users as $user)
            <tr wire:key="{{ $user->id }}">
                <td scope="row">{{ $loop->index + $users->firstItem() }}</td>
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
    {{ $users->links() }}
</div>
