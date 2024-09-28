<div>
    <x-adminlte-card title="Log Aktifitas Anda" theme="secondary" icon="fas fa-history">
        <div style="overflow-y: auto ;max-height: 300px;">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Activity</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs->sortByDesc('created_at') as $log)
                        <tr>
                            <td class="text-nowrap">{{ $log->created_at }}</td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ $log->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-adminlte-card>
</div>
