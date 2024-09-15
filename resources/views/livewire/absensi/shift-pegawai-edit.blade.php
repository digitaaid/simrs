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
                        <th>Tanggal</th>
                        <th>Nama Pegawai</th>
                        <th>Shift Kerja</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->shift_pegawai as $item)
                    <tr>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $item->nama_shift }}</td>
                        <td>{{ $item->jam_masuk }}</td>
                        <td>{{ $item->jam_pulang }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
