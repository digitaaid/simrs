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
                <div class="col-md-4">
                    <x-adminlte-input wire:model.change='tanggalperiksa' type="date" name="tanggalperiksa"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Pilih" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search"
                        placeholder="Pencarian Berdasarkan Nama / No RM" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>

            @php
                $heads = [
                    'No',
                    'Antrian',
                    'Kodebooking',
                    'No RM',
                    'Nama Pasien',
                    'Jenis Pasien',
                    'SEP',
                    'Action',
                    'Taskid',
                    'Layanan',
                    'Unit',
                    'Dokter',
                    'PIC',
                    'Kartu BPJS',
                    'NIK',
                    'Method',
                    'Status',
                ];
                $config['order'] = [5, 'asc'];
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered
                hoverable compressed>
                @isset($antrians)
                    @foreach ($antrians as $item)
                        <tr
                            class="{{ $item->nomorkartu ? ($item->jenispasien == 'JKN' ? $item->sep ?? 'table-danger' : null) : null }}">
                            <td>{{ $item->angkaantrean }}</td>
                            <td>{{ $item->nomorantrean }}</td>
                            <td>{{ $item->kodebooking }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenispasien }}</td>
                            <td>
                                {{ $item->nomorkartu ? ($item->jenispasien == 'JKN' ? $item->sep ?? 'Belum Input' : null) : null }}
                            </td>
                            <td>
                                @if ($item->taskid <= 2)
                                    <a href="{{ route('pendaftaran.rajal.proses', $item->kodebooking) }}">
                                        <x-adminlte-button class="btn-xs" label="Proses" theme="success"
                                            icon="fas fa-user-plus" />
                                    </a>
                                @else
                                    <a href="{{ route('pendaftaran.rajal.proses', $item->kodebooking) }}">
                                        <x-adminlte-button class="btn-xs" label="Lihat" theme="secondary"
                                            icon="fas fa-user-plus" />
                                    </a>
                                @endif

                                {{-- @switch($item->taskid)
                                    @case(1)
                                        <a href="{{ route('prosespendaftaran') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-warning withLoad">Proses</a>
                                        <a href="{{ route('lihatpendaftaran') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-secondary withLoad">Lihat</a>
                                    @break

                                    @case(2)
                                        <a href="{{ route('lihatpendaftaran') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-primary withLoad">Proses</a>
                                    @break

                                    @default
                                        <a href="{{ route('lihatpendaftaran') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-secondary withLoad">Lihat</a>
                                @endswitch --}}
                            </td>
                            <td>
                                @switch($item->taskid)
                                    @case(0)
                                        <span class="badge badge-secondary">98. Belum Checkin</span>
                                    @break

                                    @case(1)
                                        <span class="badge badge-warning">1. Menunggu Pendaftaran</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-primary">0. Proses Pendaftaran</span>
                                    @break

                                    @case(3)
                                        <span class="badge badge-warning">3. Menunggu Poliklinik</span>
                                    @break

                                    @case(4)
                                        <span class="badge badge-primary">4. Pelayanan Poliklinik</span>
                                    @break

                                    @case(5)
                                        <span class="badge badge-warning">5. Tunggu Farmasi</span>
                                    @break

                                    @case(6)
                                        <span class="badge badge-primary">6. Racik Obat</span>
                                    @break

                                    @case(7)
                                        <span class="badge badge-success">7. Selesai</span>
                                    @break

                                    @case(99)
                                        <span class="badge badge-danger">99. Batal</span>
                                        {{-- <a href="{{ route('tidakjadibatal') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-primary withLoad"><i class="fas fa-sync"></i> </a> --}}
                                    @break

                                    @default
                                        {{ $item->taskid }}
                                @endswitch
                            </td>
                            <td class="text-right">{{ money($item->layanans->sum('harga'), 'IDR') }} </td>
                            <td>{{ $item->kunjungan->units->nama ?? $item->namapoli }} </td>
                            <td>{{ $item->kunjungan->dokters->namadokter ?? $item->namadokter }}</td>
                            <td>{{ $item->pic1->name ?? 'Belum Didaftarkan' }} </td>
                            <td>{{ $item->nomorkartu }}</td>
                            <td>{{ $item->nik }} </td>
                            <td>{{ $item->method }} </td>
                            <td>
                                @switch($item->kunjungan?->status)
                                    @case(1)
                                        <span class="badge badge-warning">Aktif</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-success">Selesai</span>
                                    @break

                                    @case(99)
                                        <span class="badge badge-danger">Batal</span>
                                    @break

                                    @default
                                        <span class="badge badge-secondary">{{ $item->kunjungan?->status }}</span>
                                @endswitch

                            </td>
                        </tr>
                    @endforeach
                @endisset
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
