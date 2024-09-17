<div>
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
                    title="{{ count($kunjungans) ? $kunjungans->where('jeniskunjungan', '5')->count() : '-' }}"
                    text="Pasien IGD" theme="success" icon="fas fa-user-injured" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Table Antrian Pendaftaran" theme="secondary">
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-2">
                    <a href="{{ route('pendaftaran.igd.proses') }}">
                        <x-adminlte-button class="btn-sm" theme="success" icon="fas fa-user-plus" label="Daftar IGD" />
                    </a>
                </div>
                <div class="col-md-3">
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
                    'Tgl Masuk',
                    'Counter',
                    'No RM',
                    'Nama Pasien',
                    'Action',
                    'Layanan',
                    'Unit',
                    'Dokter',
                    'PIC',
                    'Kartu BPJS',
                    'NIK',
                    'Status',
                ];
                $config['order'] = [5, 'asc'];
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered
                hoverable compressed>
                @isset($kunjungans)
                    @foreach ($kunjungans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tgl_masuk }}</td>
                            <td>{{ $item->counter }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>

                            </td>
                            <td>{{ $item->jeniskunjungan }}</td>
                            <td>{{ $item->units->nama }}</td>
                            <td>{{ $item->dokters->nama }}</td>
                            <td>{{ $item->pic1->name }}</td>
                            <td>{{ $item->nomorkartu }}</td>
                            <td>{{ $item->nik }} </td>
                            <td>{{ $item->status }} </td>
                        </tr>
                    @endforeach
                @endisset
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
