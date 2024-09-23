<div>
    <x-adminlte-card title="Jadwal Dokter Hari Ini" theme="secondary">
        <table class="table table-sm table-bordered table-hover text-nowrap table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dokter</th>
                    <th>Poliklinik</th>
                    <th>Jam Praktek</th>
                    <th>Jumlah Pasien</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namadokter }}</td>
                        <td>{{ $item->namasubspesialis }}</td>
                        <td>{{ $item->jampraktek }}</td>
                        <td>{{ count($antrians->where('taskid', '!=', 99)->where('jadwal_id', $item->id)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
    {{-- Because she competes with no one, no one can compete with her. --}}
</div>
