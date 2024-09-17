<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Tambah Jadwal Kerja" theme="primary">
            <x-adminlte-select wire:model='shift_id' igroup-size="sm" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" name="shift_id" label="Shift Kerja">
                <option value=null disabled selected>--Pilih Shift Kerja--</option>
                @foreach ($shifts as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->nama }}
                        ({{ $shift->jam_masuk }}-{{ $shift->jam_pulang }})
                    </option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-input wire:model="tgl_awal" fgroup-class="row" type="date" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" name="tgl_awal" label="Tanggal Awal" />
            <x-adminlte-input wire:model="tgl_akhir" fgroup-class="row" type="date" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" name="tgl_akhir" label="Tanggal Akhir" />
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                    wire:confirm="Apakah anda ingin menambahkan jadwal shift kerja pegawai ?" theme="success" />
                <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
            </x-slot>
        </x-adminlte-card>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Jadwal Kerja Pegawai" theme="primary">
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Shift Kerja</th>
                        <th>Tanggal</th>
                        <th>Jam Kerja</th>
                        <th>Absensi Masuk</th>
                        <th>Jarak Masuk</th>
                        <th>Foto Masuk</th>
                        <th>Absensi Pulang</th>
                        <th>Jarak Pulang</th>
                        <th>Foto Pulang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->shift_pegawai as $item)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $item->nama_shift }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam_masuk }}-{{ $item->jam_pulang }}</td>
                            <td>{{ $item->absensi_masuk ? \Carbon\Carbon::parse($item->absensi_masuk)->format('H:i:s') : '-' }}
                                @if (!$item->absensi_pulang)
                                    @if ($item->absensi_masuk)
                                        <x-adminlte-button wire:click="resetmasuk({{ $item->id }})" class="btn-xs"
                                            theme="warning" icon="fas fa-sync" />
                                    @endif
                                @endif
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
                                @if ($item->absensi_pulang)
                                    <x-adminlte-button wire:click="resetpulang({{ $item->id }})" class="btn-xs"
                                        theme="warning" icon="fas fa-sync" />
                                @endif
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

                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
