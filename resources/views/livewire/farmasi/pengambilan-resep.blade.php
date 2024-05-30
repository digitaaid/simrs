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
                    <x-adminlte-small-box title="{{ $antrians->where('taskid', 1)->count() }}" text="Sisa Antrian"
                        theme="warning" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $antrians->where('taskid', '!=', 99)->count() }}"
                        text="Total Antrian" theme="success" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $antrians->where('taskid', 99)->count() }}" text="Batal Antrian"
                        theme="danger" icon="fas fa-user-injured" />
                </div>
            </div>
        </div>
    @endif
    @if ($formEdit)
        <div class="col-md-12">
            <x-adminlte-card title="Resep Obat {{ $antrianedit->nama }}" theme="primary">
                <h6>Resep Obat</h6>
                @foreach ($resepObat as $index => $obat)
                    <div class="row">
                        <div class="col-md-2">
                            @error('resepObat.' . $index . '.obat')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.obat" list="obatlist"
                                name="obat[]" igroup-size="sm" placeholder="Nama Obat" />
                            <datalist id="obatlist">
                                @foreach ($obats as $key => $item)
                                    <option value="{{ $item }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-1">
                            @error('resepObat.' . $index . '.jumlahobat')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlahobat" name="jumlahobat[]"
                                igroup-size="sm" type="number" placeholder="Jumlah Obat" />
                        </div>
                        <div class="col-md-1">
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.frekuensiobat"
                                list="frekuensiobatlist" name="frekuensiobat[]" igroup-size="sm"
                                placeholder="Frekuensi Obat" />
                            <datalist id="frekuensiobatlist">
                                @foreach ($frekuensiObats as $key => $item)
                                    <option value="{{ $item }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-2">
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.waktuobat" list="waktuobatlist"
                                name="waktuobat[]" igroup-size="sm" placeholder="Waktu Obat" />
                            <datalist id="waktuobatlist">
                                @foreach ($waktuObats as $key => $item)
                                    <option value="{{ $item }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-2">
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan" name="keterangan[]"
                                igroup-size="sm" placeholder="Keterangan" />
                        </div>
                        <div class="col-md-2">
                            <button wire:click="removeObat({{ $index }})" class="btn btn-danger btn-sm">Hapus
                                Obat</button>

                        </div>
                    </div>
                @endforeach
                <button wire:click.prevent="addObat" class="btn btn-success btn-sm">Tambah Obat</button>
                <x-slot name="footerSlot">
                    <x-adminlte-button wire:confirm='Apakah anda yakin akan menyimpan resep obat terbaru ini ?'
                        wire:click='simpanResep' class="btn-sm" label="Simpan" theme="success" icon="fas fa-save" />
                    <x-adminlte-button wire:click='openformEdit' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                    <a href="{{ route('print.etiket') }}?kode={{ $antrianedit->kodebooking }}">
                        <button class="btn btn-success btn-sm">Etiket Obat</button>
                    </a>
                    <div wire:loading>
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                        </div>
                        Loading ...
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table Pengambilan Resep Obat" theme="secondary">
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
                    <x-adminlte-input name="search" placeholder="Pencarian Berdasarkan Nama / No RM"
                        igroup-size="sm">
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
                    'Jenis Pasien',
                    'Layanan',
                    'Obat',
                    'Unit',
                    'PIC',
                    'Dokter',
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
                        <tr wire:key='{{ $item->id }}'>
                            <td>{{ $item->angkaantrean }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if ($item->taskid == 5 && $item->status == 0)
                                    <x-adminlte-button wire:click='terimaResep({{ $item }})' class="btn-xs"
                                        label="Terima Resep" theme="success" icon="fas fa-user-nurse" />
                                @endif
                                @if ($item->taskid == 6)
                                    <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                        theme="warning" icon="fas fa-edit" />
                                    <a href="{{ route('print.resep', $item->kodebooking) }}" target="_blank">
                                        <x-adminlte-button class="btn-xs" theme="primary" icon="fas fa-print" />
                                    </a>
                                    <x-adminlte-button wire:confirm='Apakah anda yakin pasien telah mendapatkan obat ?'
                                        wire:click='selesai({{ $item }})' class="btn-xs" label="Selesai"
                                        theme="success" icon="fas fa-check" />
                                @endif
                                @if ($item->taskid == 7)
                                    <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                        theme="warning" icon="fas fa-edit" />
                                    <a href="{{ route('print.resep', $item->kodebooking) }}" target="_blank">
                                        <x-adminlte-button class="btn-xs" theme="primary" icon="fas fa-print" />
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
                                        @if ($item->status == 0)
                                            <span class="badge badge-warning">5. Tunggu Farmasi</span>
                                        @else
                                            <span class="badge badge-success">7. Selesai</span>
                                        @endif
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
                            <td>{{ $item->jenispasien }} </td>
                            <td class="text-right">{{ money($item->layanans->sum('harga'), 'IDR') }} </td>
                            <td class="text-right">{{ money($item->resepobatdetails->sum('subtotal'), 'IDR') }} </td>
                            <td>{{ $item->kunjungan->units->nama ?? $item->namapoli }} </td>
                            <td>{{ $item->pic4->name ?? '-' }} </td>
                            <td>{{ $item->kunjungan->dokters->namadokter ?? $item->namadokter }}</td>
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
