<div class="row">
    <x-flash-message />
    @if ($formAntrian)
        <x-modal size="xl" title="Antrian Kodebooking " icon="fas fa-file-import" theme="dark">
            <div class="row">
                <div class="col-md-4">
                    @if ($antrian)
                        <table>
                            <tr>
                                <td>jeniskunjungan</td>
                                <td>:</td>
                                <td>{{ $antrian->jeniskunjungan }}</td>
                            </tr>
                            <tr>
                                <td>nomorreferensi</td>
                                <td>:</td>
                                <td>{{ $antrian->nomorreferensi }}</td>
                            </tr>
                            <tr>
                                <td>createdtime</td>
                                <td>:</td>
                                <td>{{ $antrian->createdtime }}</td>
                            </tr>
                            <tr>
                                <td>kodebooking</td>
                                <td>:</td>
                                <td>{{ $antrian->kodebooking }}</td>
                            </tr>
                            <tr>
                                <td>norekammedis</td>
                                <td>:</td>
                                <td>{{ $antrian->norekammedis }}</td>
                            </tr>
                            <tr>
                                <td>nik</td>
                                <td>:</td>
                                <td>{{ $antrian->nik }}</td>
                            </tr>
                            <tr>
                                <td>nokapst</td>
                                <td>:</td>
                                <td>{{ $antrian->nokapst }}</td>
                            </tr>
                            <tr>
                                <td>noantrean</td>
                                <td>:</td>
                                <td>{{ $antrian->noantrean }}</td>
                            </tr>
                            <tr>
                                <td>kodepoli</td>
                                <td>:</td>
                                <td>{{ $antrian->kodepoli }}</td>
                            </tr>
                            <tr>
                                <td>sumberdata</td>
                                <td>:</td>
                                <td>{{ $antrian->sumberdata }}</td>
                            </tr>
                            <tr>
                                <td>estimasidilayani</td>
                                <td>:</td>
                                <td>{{ $antrian->estimasidilayani }}</td>
                            </tr>
                            <tr>
                                <td>kodedokter</td>
                                <td>:</td>
                                <td>{{ $antrian->kodedokter }}</td>
                            </tr>
                            <tr>
                                <td>jampraktek</td>
                                <td>:</td>
                                <td>{{ $antrian->jampraktek }}</td>
                            </tr>
                            <tr>
                                <td>nohp</td>
                                <td>:</td>
                                <td>{{ $antrian->nohp }}</td>
                            </tr>
                            <tr>
                                <td>tanggal</td>
                                <td>:</td>
                                <td>{{ $antrian->tanggal }}</td>
                            </tr>
                            <tr>
                                <td>ispeserta</td>
                                <td>:</td>
                                <td>{{ $antrian->ispeserta }}</td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td>:</td>
                                <td>{{ $antrian->status }}</td>
                            </tr>
                        </table>
                    @else
                        Antrian tidak ditemukan
                    @endif
                </div>
                <div class="col-md-8">
                    @if ($taskid)
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Taskid</th>
                                    <th>Kodebooking</th>
                                    <th>Taskname</th>
                                    <th>Waktu RS</th>
                                    <th>Waktu Server</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taskid as $item)
                                    <tr>
                                        <td>{{ $item->taskid }}</td>
                                        <td>{{ $item->kodebooking }}</td>
                                        <td>{{ $item->taskname }}</td>
                                        <td>{{ $item->wakturs }}</td>
                                        <td>{{ $item->waktu }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        Antrian belum checkin
                    @endif
                </div>
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button theme="danger" wire:click='form' class="btn-sm" icon="fas fa-times" label="Tutup"
                    data-dismiss="modal" />
            </x-slot>
        </x-modal>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Antrian Per Tanggal" theme="secondary" icon='fas fa-calendar-day'>
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.live="tanggal" type="date" name="tanggal" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='cari' theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <x-loading-placeholder />
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive mb-3">
                <thead>
                    <tr>
                        <th>tanggal</th>
                        <th>no</th>
                        <th>kodebooking</th>
                        <th>action</th>
                        <th>norekammedis</th>
                        <th>nik</th>
                        <th>nokapst</th>
                        <th>nohp</th>
                        <th>kodepoli</th>
                        <th>kodedokter</th>
                        <th>jeniskunjungan</th>
                        <th>nomorreferensi</th>
                        <th>sumberdata</th>
                        <th>status</th>
                        <th>createdtime</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrians as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->noantrean }}</td>
                            <td>
                                <a href="{{ route('antrian.antreankodebooking', $item->kodebooking) }}">
                                    {{ $item->kodebooking }}
                                </a>
                            </td>
                            <td>
                                <x-adminlte-button wire:click="lihat('{{ $item->kodebooking }}')" class="btn-xs"
                                    theme="warning" label="Lihat" icon="fas fa-eye" />
                            </td>
                            <td>{{ $item->norekammedis }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nokapst }}</td>
                            <td>{{ $item->nohp }}</td>
                            <td>{{ $item->kodepoli }}</td>
                            <td>{{ $item->kodedokter }}</td>
                            <td>{{ $item->jeniskunjungan }}</td>
                            <td>{{ $item->nomorreferensi }}</td>
                            <td>{{ $item->sumberdata }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestampMs($item->createdtime)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
