<div>
    <x-flash-message />
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ count($kunjungans) ? $kunjungans->where('status', '1')->count() : '-' }}"
                    text="Sedang Dirawat" theme="success" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $beds->where('status', 0)->count() }}" text="Ketersediaan Bed"
                    theme="warning" icon="fas fa-user-injured" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Data Pasien IGD" theme="secondary" icon="fas fa-user-injured">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change='tanggal' type="date" name="tanggal" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('pendaftaran.ranap.proses', 0) }}">
                        <x-adminlte-button class="btn-sm" theme="success" icon="fas fa-user-plus"
                            label="Daftar Ranap" />
                    </a>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Pasien"
                        igroup-size="sm">
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
                    'Kode',
                    'Counter',
                    'No RM',
                    'Nama Pasien',
                    'Status',
                    'Tgl Masuk',
                    'Tgl Pulang',
                    'Layanan',
                    'Unit',
                    'Dokter',
                    'Kartu BPJS',
                    'NIK',
                    'PIC',
                ];
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" bordered hoverable compressed>
                @foreach ($kunjungans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('pendaftaran.ranap.proses', $item->kode) }}">
                                {{ $item->kode }}
                            </a>
                        </td>
                        <td>{{ $item->counter }}</td>
                        <td>{{ $item->norm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @switch($item->status)
                                @case(1)
                                    <span class="badge bg-warning float-right">{{ $item->status }}. Aktif
                                    </span>
                                @break

                                @case(2)
                                    <span class="badge bg-success float-right">{{ $item->status }}. Selesai
                                    </span>
                                @break

                                @case(99)
                                    <span class="badge bg-danger float-right">{{ $item->status }}. Batal
                                    </span>
                                @break

                                @default
                            @endswitch
                        </td>
                        <td>{{ $item->tgl_masuk }}</td>
                        <td>{{ $item->tgl_pulang }}</td>
                        <td>
                            @if ($item->jeniskunjungan == 5)
                                IGD
                            @endif
                        </td>
                        <td>{{ $item->units->nama }}</td>
                        <td>{{ $item->dokters->nama }}</td>
                        <td>{{ $item->nomorkartu }}</td>
                        <td>{{ $item->nik }} </td>
                        <td>{{ $item->pic1->name }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
