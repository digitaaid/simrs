<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <x-adminlte-card title="Jadwal Dokter Rawat Jalan" theme="secondary">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" wire:model="id" name="id">
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="hari" igroup-size="sm" name="dokter" label="dokter">
                            @forelse ($haris as $kode =>  $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @empty
                                <option disabled>Data Hari Tidak Ditemukan</option>
                            @endforelse
                        </x-adminlte-select>
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="dokter" igroup-size="sm" name="dokter" label="dokter">
                            @forelse ($dokters as $kode =>  $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @empty
                                <option disabled>Data Dokter Tidak Ditemukan</option>
                            @endforelse
                        </x-adminlte-select>
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="unit" igroup-size="sm" name="unit" label="unit">
                            @forelse ($units as $kode =>  $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @empty
                                <option disabled>Data Unit Tidak Ditemukan</option>
                            @endforelse
                        </x-adminlte-select>
                        <x-adminlte-input wire:model="jampraktek" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="jampraktek" label="jampraktek"
                            placeholder="jampraktek" />
                        <x-adminlte-input wire:model="kapasitas" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="kapasitas" label="kapasitas"
                            placeholder="kapasitas" />
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda yakin ingin menyimpan permission ?" theme="success" />
                    <x-adminlte-button wire:click='closeForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table Jadwal Dokter Rawat Jalan" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah Jadwal" theme="success"
                        icon="fas fa-user-plus" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Jadwal Dokter"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Dokter</th>
                        <th>Unit</th>
                        <th>Jampraktek</th>
                        <th>Kapasitas</th>
                        <th>Libur</th>
                        <th>Action</th>
                        <th>PIC</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namahari }}</td>
                            <td>{{ $item->namadokter }}</td>
                            <td>{{ $item->namapoli }}</td>
                            <td>{{ $item->jampraktek }}</td>
                            <td>{{ $item->kapasitas }}</td>
                            <td>{{ $item->libur }}</td>
                            <td>
                                <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                    wire:click="edit({{ $item }})" theme="warning" />
                                <x-adminlte-button label="Hapus" class="btn-xs" icon="fas fa-trash"
                                    wire:click="destroy({{ $item }})"
                                    wire:confirm="Apakah anda yakin ingin menghapus jadwal ?" theme="danger" />
                            </td>
                            <td>{{ $item->pic }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $jadwals->links() }}
        </x-adminlte-card>
    </div>
</div>
