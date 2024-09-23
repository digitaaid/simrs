<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Jadwal Kerja Pegawai" theme="primary">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('print.laporan.absensi') }}" target="_blank">
                        <x-adminlte-button wire:click='print' class="btn-sm mb-2" label="Print Laporan" theme="success"
                            icon="fas fa-print" />
                    </a>
                </div>
                <div class="col-md-4">
                    {{-- <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Obat"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input> --}}
                </div>
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shift Kerja</th>
                        <th>Tanggal</th>
                        <th>Jam Kerja</th>
                        <th>Absensi Masuk</th>
                        <th>Jarak Masuk</th>
                        <th>Foto Masuk</th>
                        <th>Absensi Pulang</th>
                        <th>Jarak Pulang</th>
                        <th>Foto Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis->sortBy('tanggal') as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_shift }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam_masuk }}-{{ $item->jam_pulang }}</td>
                            <td>{{ $item->absensi_masuk ? \Carbon\Carbon::parse($item->absensi_masuk)->format('H:i:s') : '-' }}
                            </td>
                            <td>
                                @if ($item->jarak_masuk)
                                    {{ round($item->jarak_masuk) }} meter
                                @endif
                            </td>
                            <td>
                                @if ($item->foto_absensi_masuk)
                                    <img height="30px" src="{{ url('storage/app/' . $item->foto_absensi_masuk) }}"
                                        alt="Foto Absensi Pulang">
                                @endif
                            </td>
                            <td>{{ $item->absensi_pulang ? \Carbon\Carbon::parse($item->absensi_pulang)->format('H:i:s') : '-' }}
                            </td>
                            <td>
                                @if ($item->jarak_pulang)
                                    {{ round($item->jarak_pulang) }} meter
                                @endif
                            </td>
                            <td>
                                @if ($item->foto_absensi_pulang)
                                    <img width="30px" src="{{ url('storage/app/' . $item->foto_absensi_pulang) }}"
                                        alt="Foto Absensi Pulang">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
