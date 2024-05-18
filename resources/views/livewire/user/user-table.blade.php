<div>
    <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl">
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
                        <a wire:navigate href="{{ route('user.edit', $user) }}">
                            <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
