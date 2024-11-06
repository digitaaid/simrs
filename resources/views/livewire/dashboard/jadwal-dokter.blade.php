<div>
    <x-adminlte-card title="Kunjungan Rawat Jalan (Today)" theme="secondary" icon="fas fa-clinic-medical">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover text-nowrap">
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
        </div>
    </x-adminlte-card>
</div>
