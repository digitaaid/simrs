<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('taskid', '!=', 99)->count() : '-' }}"
                    text="Total Pasien" theme="success" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('taskid', '!=', 99)->where('jenispasien', 'JKN')->count() : '-' }}"
                    text="Pasien JKN" theme="warning" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('taskid', '!=', 99)->where('jenispasien', 'NON-JKN')->count() : '-' }}"
                    text="Pasien NON-JKN" theme="warning" icon="fas fa-user-injured" />
            </div>
            @if (count($antrians))
                <div class="col-lg-3 col-6">
                    @php
                        if ($antrians->where('taskid', 7)->count()) {
                            $pemanfaatan =
                                ($antrians->where('taskid', 7)->where('method', 'Mobile JKN')->count() /
                                    $antrians->where('taskid', 7)->count()) *
                                100;
                        } else {
                            $pemanfaatan = 0;
                        }
                        $pemanfaatan = number_format($pemanfaatan, 2);
                    @endphp
                    <x-adminlte-small-box
                        title="{{ $antrians->where('taskid', 7)->where('method', 'Mobile JKN')->count() }}"
                        text="{{ $pemanfaatan }}%  Pemanfaatan MJKN" theme="primary" icon="fas fa-user-injured" />
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Table Antrian Pendaftaran" theme="secondary">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change='tgl_awal' type="date" name="tgl_awal" igroup-size="sm" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change='tgl_akhir' type="date" name="tgl_akhir" igroup-size="sm" />
                </div>
                <div class="col-md-8">
                </div>

            </div>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tgl Periksa</th>
                        <th>Kodebooking</th>
                        <th>Nama</th>
                        <th>No RM</th>
                        <th>No BPJS</th>
                        <th>Method</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrians as $item)
                        <tr>
                            <td>{{ $item->tanggalperiksa }}</td>
                            <td>{{ $item->kodebooking }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nomorkartu }}</td>
                            <td>{{ $item->method }}</td>
                            <td>{{ $item->taskid }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tgl Periksa</th>
                        <th>Antrian Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrians->groupBy('tanggalperiksa') as $tgl => $antrian)
                        <tr>
                            <td>{{ $tgl }}</td>
                            <td>{{ count($antrian) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
