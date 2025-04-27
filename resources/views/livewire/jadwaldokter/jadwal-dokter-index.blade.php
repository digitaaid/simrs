<div class="row">
    <x-flash-message />
    <div class="col-md-12">
        @if ($form)
            <x-modal size="xl" title="Jadwal Dokter" icon="fas fa-calendar-alt" theme="dark">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" wire:model="id" name="id">
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="hari" igroup-size="sm" name="hari" label="Hari">
                            <option value=null disabled>Silahkan Pilih Hari</option>
                            @foreach ($haris as $kode => $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @endforeach
                        </x-adminlte-select>
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="dokter" igroup-size="sm" name="dokter" label="Dokter">
                            <option value=null disabled>Silahkan Pilih Dokter</option>
                            @foreach ($dokters as $kode => $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @endforeach
                        </x-adminlte-select>
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                            wire:model="unit" igroup-size="sm" name="unit" label="Unit">
                            <option value=null disabled>Silahkan Pilih Unit</option>
                            @foreach ($units as $kode => $nama)
                                <option value="{{ $kode }}">{{ $nama }}</option>
                            @endforeach
                        </x-adminlte-select>
                        <x-adminlte-input wire:model="kapasitas" type='number' fgroup-class="row"
                            label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="kapasitas"
                            label="Kapasitas" />
                        <x-adminlte-input wire:model="huruf" type='text' fgroup-class="row"
                            label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="huruf"
                            label="huruf" />
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="mulai" fgroup-class="row" type='time'
                                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="mulai"
                                    label="Mulai" />
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="selesai" fgroup-class="row" type='time'
                                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="selesai"
                                    label="Selesai" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda yakin ingin menyimpan permission ?" theme="success" />
                    <x-adminlte-button wire:click='formJadwal' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-modal>
        @endif
        @if ($formImport)
            <x-modal size="lg" title="Import Data" icon="fas fa-file-import" theme="dark">
                <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                    placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File Import' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="btn-sm" icon="fas fa-save"
                        theme="success" label="Import" wire:confirm='Apakah anda yakin akan mengimport data dokter ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-modal>
        @endif
        <x-adminlte-card title="Data Jadwal Dokter" theme="secondary" icon="fas fa-calendar-alt">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='formJadwal' class="btn-sm" title="Tambah Data" theme="success"
                        icon="fas fa-folder-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload semua data ? ' class="btn-sm" title="Export"
                        theme="primary" icon="fas fa-file-export" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" title="Import" theme="primary"
                        icon="fas fa-file-import" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Jadwal Dokter"
                        igroup-size="sm">
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
                        <th>Action</th>
                        <th>Huruf</th>
                        <th>Jampraktek</th>
                        <th>Kapasitas</th>
                        <th>Libur</th>
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
                            <td>
                                <a href="#editJadwal">
                                    <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                        wire:click="edit({{ $item }})" theme="warning" />
                                </a>
                                <x-adminlte-button class="btn-xs" icon="fas fa-trash"
                                    wire:click="destroy({{ $item }})"
                                    wire:confirm="Apakah anda yakin ingin menghapus jadwal ?" theme="danger" />
                                <x-adminlte-button label="Libur" class="btn-xs" icon="fas fa-times"
                                    wire:click="libur({{ $item }})"
                                    wire:confirm="Apakah anda yakin ingin meliburkan jadwal ?" theme="danger" />
                            </td>
                            <td>{{ $item->huruf }}</td>
                            <td>{{ $item->jampraktek }}</td>
                            <td>{{ $item->kapasitas }}</td>
                            <td>
                                @if ($item->libur)
                                    <span class="badge badge-danger">Libur</span>
                                @else
                                    <span class="badge badge-success">Masuk</span>
                                @endif
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
