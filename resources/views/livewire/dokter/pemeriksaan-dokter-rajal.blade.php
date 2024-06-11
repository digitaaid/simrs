<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    @if (isset($antrians))
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $antrians->where('taskid', '!=', 99)->count() }}" text="Total Antrian"
                        theme="success" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box
                        title="{{ $antrians->where('asesmenrajal.status_asesmen_dokter', 1)->count() }}"
                        text="Sudah Asesmen Perawat" theme="warning" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box
                        title="{{ $antrians->where('taskid', '!=', 99)->where('asesmenrajal.status_asesmen_dokter', 0)->count() }}"
                        text="Belum Asesmen Perawat" theme="danger" icon="fas fa-user-injured" />
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table Antrian Pemeriksaan Perawat" theme="secondary">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change='tanggalperiksa' type="date" name="tanggalperiksa"
                        igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-3">
                    <x-adminlte-select wire:model.change="jadwal" name="jadwal" fgroup-class="row" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                        <option value="">Semua Jadwal</option>
                        @foreach ($jadwals as $item)
                            <option value="{{ $item->id }}">{{ $item->namadokter }} {{ $item->namapoli }}
                                {{ $item->jampraktek }}</option>
                        @endforeach
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='cariantrian' theme="primary" label="Pilih" />
                        </x-slot>
                    </x-adminlte-select>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="search" placeholder="Pencarian Berdasarkan Nama / No RM" igroup-size="sm">
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
                    'No RM',
                    'Nama Pasien',
                    'Action',
                    'Taskid',
                    'Asesmen',
                    'Jenis Pasien',
                    'Layanan',
                    'Unit',
                    'Dokter',
                    'PIC',
                    'Kartu BPJS',
                    'NIK',
                    'Method',
                    'Status',
                    'Kodebooking',
                ];
                $config['order'] = [5, 'asc'];
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered
                hoverable compressed>
                @isset($antrians)
                    @foreach ($antrians as $item)
                        <tr>
                            <td>{{ $item->angkaantrean }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if ($item->taskid == 5)
                                    <a href="{{ route('pemeriksaan.dokter.rajal.proses', $item->kodebooking) }}">
                                        <x-adminlte-button class="btn-xs" label="Lihat" theme="secondary"
                                            icon="fas fa-user-md" />
                                    </a>
                                @else
                                    <a href="{{ route('pemeriksaan.dokter.rajal.proses', $item->kodebooking) }}">
                                        <x-adminlte-button class="btn-xs" label="Proses" theme="success"
                                            icon="fas fa-user-md" />
                                    </a>
                                @endif
                            </td>
                            <td>
                                @switch($item->taskid)
                                    @case(0)
                                        <span class="badge badge-secondary">98. Belum Checkin</span>
                                    @break

                                    @case(1)
                                        <span class="badge badge-warning">97. Menunggu Pendaftaran</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-primary">96. Proses Pendaftaran</span>
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
                                    @break

                                    @default
                                        {{ $item->taskid }}
                                @endswitch
                            </td>
                            <td>
                                @if ($item->asesmenrajal?->status_asesmen_dokter)
                                    <span class="badge badge-success">1. Sudah</span>
                                @else
                                    <span class="badge badge-danger">0. Belum</span>
                                @endif
                            </td>
                            <td>{{ $item->jenispasien }} </td>
                            <td class="text-right">{{ money($item->layanans->sum('harga'), 'IDR') }} </td>
                            <td>{{ $item->kunjungan->units->nama ?? $item->namapoli }} </td>
                            <td>{{ $item->kunjungan->dokters->namadokter ?? $item->namadokter }}</td>
                            <td>{{ $item->pic1->name ?? 'Belum Didaftarkan' }} </td>
                            <td>{{ $item->nomorkartu }}</td>
                            <td>{{ $item->nik }} </td>
                            <td>{{ $item->method }} </td>
                            <td>{{ $item->status }} </td>
                            <td>{{ $item->kodebooking }}</td>
                        </tr>
                    @endforeach
                @endisset
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
