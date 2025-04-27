<div class="row">
    <x-flash-message />
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $antrians->where('taskid', '!=', 99)->count() }}" text="Total Antrian"
                    theme="success" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $antrians->where('asesmenrajal.status_asesmen_perawat', 1)->count() }}"
                    text="Sudah Asesmen" theme="warning" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ $antrians->where('taskid', '!=', 99)->where('asesmenrajal.status_asesmen_perawat', 0)->count() }}"
                    text="Belum Asesmen" theme="danger" icon="fas fa-user-injured" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Data Antrian Keperawatan" theme="secondary" icon="fas fa-nurse">
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
                    <x-adminlte-input wire:model.live="search" name="search"
                        placeholder="Pencarian Berdasarkan Nama / No RM" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Cari" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            @php
                $heads = [
                    'No',
                    'Antrian',
                    'Kodebooking',
                    'Asesmen',
                    'No RM',
                    'Nama Pasien',
                    'Taskid',
                    'Jenis Pasien',
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
                        <tr>
                            <td>{{ $item->angkaantrean }}</td>
                            <td>{{ $item->nomorantrean }}</td>
                            <td>
                                <a href="{{ route('keperawatan.rajal.proses', $item->kodebooking) }}">
                                    {{ $item->kodebooking }}
                                </a>
                            </td>
                            <td>
                                @if ($item->asesmenrajal?->status_asesmen_perawat)
                                    <span class="badge badge-success">1. Sudah</span>
                                @else
                                    <span class="badge badge-danger">0. Belum</span>
                                @endif
                            </td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
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
                                        {{-- <a href="{{ route('tidakjadibatal') }}?kodebooking={{ $item->kodebooking }}"
                                            class="btn btn-xs btn-primary withLoad"><i class="fas fa-sync"></i> </a> --}}
                                    @break

                                    @default
                                        {{ $item->taskid }}
                                @endswitch
                            </td>
                            <td>{{ $item->jenispasien }} </td>
                            <td class="text-right">{{ money($item->layanans->sum('harga'), 'IDR') }} </td>
                            <td>{{ $item->kunjungan->units->nama ?? $item->namapoli }} </td>
                            <td>{{ $item->kunjungan->dokters->namadokter ?? $item->namadokter }}</td>
                            <td>{{ $item->pic2->name ?? 'Belum Diperiksa' }} </td>
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
