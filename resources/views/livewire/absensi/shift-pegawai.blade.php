<div class="row ">
    <div class="col-md-12" id="tambahabsensi">
        @if ($formTambah)
            <x-adminlte-card title="Tambah Jadwal Absensi" theme="success">
                <input type="hidden" name="id" wire:model='id'>
                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                    igroup-size="sm" name="nama" label="Nama Pegawai" readonly />
                <x-adminlte-input wire:model="tanggal" fgroup-class="row" type="date" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="tanggal" label="Tanggal" readonly />
                <x-adminlte-select wire:model='shift_id' igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" name="shift_id" label="Shift Kerja">
                    <option value=null disabled selected>--Pilih Shift Kerja--</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->nama }}
                            ({{ $shift->jam_masuk }}-{{ $shift->jam_pulang }})
                        </option>
                    @endforeach
                </x-adminlte-select>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda ingin menambahkan jadwal absensi ?" theme="success" />
                    <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-12" id="editabsensi">
        @if ($formEdit)
            <x-adminlte-card title="Edit Jadwal Absensi" theme="warning">
                <input type="hidden" name="id" wire:model='id'>
                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="nama" label="Nama Pegawai" readonly />
                <x-adminlte-input wire:model="tanggal" fgroup-class="row" type="date" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="tanggal" label="Tanggal" readonly />

                <x-adminlte-select wire:model='shift_id' igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" name="shift_id" label="Shift Kerja">
                    <option value=null disabled selected>--Pilih Shift Kerja--</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->nama }}
                            ({{ $shift->jam_masuk }}-{{ $shift->jam_pulang }})
                        </option>
                    @endforeach
                </x-adminlte-select>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Update" class="btn-sm" icon="fas fa-save" wire:click="update"
                        wire:confirm="Apakah anda ingin mengedit jadwal shift kerja pegawai ?" theme="success" />
                    <x-adminlte-button wire:click='tutupedit' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Jadwal Shift Kerja Pegawai" theme="secondary" icon="fas fa-calendar">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Nama Pegawai"
                        igroup-size="sm">
                        <x-slot name="prependSlot">
                            <x-adminlte-button theme="primary" icon="fas fa-search" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change="bulan" name="bulan" type="month" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <x-adminlte-button theme="primary" icon="fas fa-calendar" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-8">
                </div>
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pegawai</th>
                        <th>Action</th>
                        @foreach ($tanggals as $item)
                            <th class="text-center">{{ explode('-', $item)[2] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('shift.pegawai.edit') }}?kode={{ $user->id }}">
                                    <x-adminlte-button class="btn-xs" title="Jadwal" theme="warning"
                                        icon="fas fa-clock" />
                                </a>
                                <a href="{{ route('print.laporan.absensi') }}?user={{ $user->id }}"
                                    target="_blank">
                                    <x-adminlte-button class="btn-xs" title="Laporan" theme="success"
                                        icon="fas fa-print" />
                                </a>
                            </td>
                            @foreach ($tanggals as $tanggal)
                                <td class="text-center">
                                    @if ($this->absensis->where('user_id', $user->id)->where('tanggal', $tanggal)->first())
                                        @php
                                            $jadwalx = $this->absensis
                                                ->where('user_id', $user->id)
                                                ->where('tanggal', $tanggal)
                                                ->first();
                                        @endphp
                                        <a href="#editabsensi">
                                            <x-adminlte-button class="btn-xs" theme="warning"
                                                wire:click="edit({{ $jadwalx->id }})"
                                                label="{{ explode(':', $jadwalx->jam_masuk)[0] }}-{{ explode(':', $jadwalx->jam_pulang)[0] }}" />
                                        </a>
                                    @else
                                        <a href="#tambahabsensi">
                                            <x-adminlte-button class="btn-xs" theme="secondary" label="Libur"
                                                wire:click="tambah('{{ $tanggal }}', {{ $user }})" />
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
