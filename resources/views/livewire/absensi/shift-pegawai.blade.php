<div class="row ">
    <div class="col-md-12">
        <x-adminlte-card title="Jadwal Shift Kerja Pegawai" theme="primary">
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pegawai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('shift.pegawai.edit') }}?kode={{ $user->id }}">
                                    <x-adminlte-button class="btn-xs" label="Jadwal" theme="warning" icon="fas fa-clock" />
                                </a>
                                <a href="{{ route('print.laporan.absensi') }}?user={{ $user->id }}" target="_blank">
                                    <x-adminlte-button class="btn-xs" label="Laporan" theme="success"
                                        icon="fas fa-print" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
