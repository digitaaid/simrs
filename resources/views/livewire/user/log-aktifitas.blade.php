<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Log Aktifitas" theme="secondary">
            <table class="table text-nowrap table-sm table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Craeted_at</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->user?->name ?? 'Anonim' }}</td>
                            <td>{{ $item->activity }}</td>
                            <td>{{ $item->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
