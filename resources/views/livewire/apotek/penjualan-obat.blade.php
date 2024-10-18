<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div id="penjualanobat" class="col-md-12">
        @if ($form)
            <x-adminlte-card title="Resep Penjualan Obat" theme="primary">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Identitas Pembeli Obat</h6>
                        <x-adminlte-input wire:model='kode' name="kode" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Kode Resep"
                            readonly />
                        <x-adminlte-input wire:model='nomorkartu' name="nomorkartu" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Nomor Kartu">
                            <x-slot name="appendSlot">
                                <div class="btn btn-primary" wire:click='cariNomorKartu'>
                                    <i class="fas fa-search"></i> Cari
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input wire:model='nik' name="nik" class="nik-id" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="NIK">
                            <x-slot name="appendSlot">
                                <div class="btn btn-primary" wire:click='cariNIK'>
                                    <i class="fas fa-search"></i> Cari
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input wire:model='norm' name="norm" label="No RM" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm">
                            <x-slot name="appendSlot">
                                <div class="btn btn-primary" wire:click='cariNoRM'>
                                    <i class="fas fa-search"></i> Cari
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input wire:model='nama' name="nama" label="Nama Pasien" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                        <x-adminlte-input wire:model='nohp' name="nohp" class="nohp-id" label="Nomor HP"
                            fgroup-class="row" label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />

                        {{-- <a target="_blank" href="{{ route('print.etiket') }}?kode={{ $resep->kode }}">
                            <x-adminlte-button class="btn-sm" theme="success" icon="fas fa-print" label="Etiket Obat" />
                        </a>
                        <a href="{{ route('print.resep', $resep->kode) }}" target="_blank">
                            <x-adminlte-button class="btn-sm" theme="primary" icon="fas fa-print" label="Cetak Resep" />
                        </a> --}}
                    </div>
                    <div class="col-md-8">
                        <h6>Resep Obat Farmasi</h6>
                        @foreach ($resepObat as $index => $obat)
                            <div class="row">
                                <div class="col-md-3">
                                    @error('resepObat.' . $index . '.obat')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                    <x-adminlte-input wire:model="resepObat.{{ $index }}.obat" list="obatlist"
                                        name="obat[]" igroup-size="sm" placeholder="Nama Obat" />
                                    <datalist id="obatlist">
                                        @foreach ($obats as $nama => $harga)
                                            <option value="{{ $nama }}">
                                                Rp. {{ $harga }}
                                            </option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-1">
                                    @error('resepObat.' . $index . '.jumlahobat')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                    <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlahobat"
                                        name="jumlahobat[]" igroup-size="sm" type="number" placeholder="Jumlah Obat" />
                                </div>
                                <div class="col-md-2">
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
                                    <x-adminlte-input wire:model="resepObat.{{ $index }}.waktuobat"
                                        list="waktuobatlist" name="waktuobat[]" igroup-size="sm"
                                        placeholder="Waktu Obat" />
                                    <datalist id="waktuobatlist">
                                        @foreach ($waktuObats as $key => $item)
                                            <option value="{{ $item }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-2">
                                    <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan"
                                        name="keterangan[]" igroup-size="sm" placeholder="Keterangan" />
                                </div>
                                <div class="col-md-2">
                                    <button wire:click="removeObat({{ $index }})"
                                        class="btn btn-danger btn-sm">Hapus
                                        Obat</button>

                                </div>
                            </div>
                        @endforeach
                        <button wire:click.prevent="addObat" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i>
                            Tambah Obat</button>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button wire:confirm='Apakah anda yakin akan menyimpan resep obat terbaru ini ?'
                        wire:click='simpanResep' class="btn-sm" label="Simpan" theme="success"
                        icon="fas fa-save" />
                    <x-adminlte-button wire:click='openformEdit' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                    <div wire:loading>
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                        </div>
                        Loading ...
                    </div>
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Data Penjualan" theme="secondary">
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input wire:model.change='tanggal' type="date" name="tanggal" igroup-size="sm">
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
                    <x-adminlte-button wire:click='tambah' class="btn-sm" label="Penjualan Obat" theme="success"
                        icon="fas fa-user-plus" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live='search' name="search" placeholder="Pencarian Resep"
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
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>No RM</th>
                        <th>Pasien</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Rp. Obat</th>
                        <th>Unit</th>
                        <th>PIC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reseps as $resep)
                        <tr>
                            <td>{{ $resep->kode }}</td>
                            <td>{{ $resep->norm }}</td>
                            <td>{{ $resep->nama }}</td>
                            <td>
                                @switch($resep->status)
                                    @case(1)
                                        <span class="badge badge-warning">{{ $resep->status }}. Order</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-primary">{{ $resep->status }}. Peracikan</span>
                                    @break

                                    @case(3)
                                        <span class="badge badge-success">{{ $resep->status }}. Selesai</span>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                @if ($resep->status == 1)
                                    <x-adminlte-button wire:click='terimaResep({{ $resep }})' class="btn-xs"
                                        label="Terima Resep" theme="success" icon="fas fa-user-nurse" />
                                @endif
                                @if ($resep->status == 2)
                                    <a href="#editresep">
                                        <x-adminlte-button wire:click='edit({{ $resep }})' class="btn-xs"
                                            label="Edit" theme="warning" icon="fas fa-edit" />
                                    </a>
                                    <x-adminlte-button wire:click='selesai({{ $resep }})' class="btn-xs"
                                        label="Selesai" theme="success" icon="fas fa-check" />
                                @endif
                                @if ($resep->status == 3)
                                    <a href="#editresep">
                                        <x-adminlte-button wire:click='edit({{ $resep }})' class="btn-xs"
                                            label="Edit" theme="warning" icon="fas fa-edit" />
                                    </a>
                                    {{-- <x-adminlte-button wire:confirm='Apakah anda yakin panggil pasien ?'
                                        wire:click='panggil({{ $resep }})' class="btn-xs" label="Panggil"
                                        theme="primary" icon="fas fa-check" /> --}}
                                    <a href="{{ route('print.penjualanobat', $resep->kode) }}" target="_blank">
                                        <x-adminlte-button class="btn-xs" theme="success" title="Cetak Resep Farmasi"
                                            icon="fas fa-print" />
                                    </a>
                                @endif
                            </td>
                            <td class="text-right">
                                {{ money($resep->resepfarmasidetails->sum('subtotal'), 'IDR') }}
                                <a href="{{ route('print.notapenjualanobat', $resep->kode) }}" target="_blank">
                                    <x-adminlte-button class="btn-xs" title="Print Invoice Pelayanan" theme="success"
                                        icon="fas fa-print" />
                                </a>
                            </td>
                            <td>{{ $resep->namaunit }}</td>
                            <td>{{ $resep->pic }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
