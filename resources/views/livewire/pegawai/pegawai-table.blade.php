<div>
    <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
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
                        <a wire:navigate href="{{ route('pegawai.edit', $user) }}">
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
</div>
@section('plugins.Datatables', true)
