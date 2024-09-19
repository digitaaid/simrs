<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    @if ($formimport)
        <x-adminlte-card title="Import Kamar" theme="secondary">
            <x-adminlte-input-file wire:model='fileimport' name="fileimport"
                placeholder="{{ $fileimport ? $fileimport->getClientOriginalName() : 'Pilih File Kamar' }}"
                igroup-size="sm" label="File Import" />
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                    theme="success" label="Import" wire:confirm='Apakah anda yakin akan mengimport data kamar ?' />
                <x-adminlte-button theme="danger" wire:click='importform' class="btn-sm" icon="fas fa-times"
                    label="Tutup" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-card>
    @endif
    @if ($form)
        <x-adminlte-card title="Formulir Kamar Rawat Inap" theme="primary">
            <x-adminlte-select wire:model='unit_id' igroup-size="sm" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" name="unit_id" label="Unit">
                <option value=null disabled selected>--Pilih Unit--</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-select wire:model='kodekelas' igroup-size="sm" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" name="kodekelas" label="Kelas">
                <option value=null disabled selected>--Pilih Kelas--</option>
                <option value="1">Kelas I</option>
                <option value="2">Kelas II</option>
                <option value="3">Kelas III</option>
                <option value="4">Kelas VIP</option>
            </x-adminlte-select>
            <x-adminlte-input wire:model="kapasitastotal" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" igroup-size="sm" name="kapasitastotal" label="Kapasitas Total" />
            <x-adminlte-input wire:model="kapasitaspria" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" igroup-size="sm" name="kapasitaspria" label="Kapasitas Pria" />
            <x-adminlte-input wire:model="kapasitaswanita" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" igroup-size="sm" name="kapasitaswanita" label="Kapasitas Wanita" />
            <x-adminlte-input wire:model="kapasitaspriawanita" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" igroup-size="sm" name="kapasitaspriawanita" label="Kapasitas Pria-Wanita" />
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                    wire:confirm="Apakah anda ingin menyimpan data kamar ?" theme="success" />
                <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
            </x-slot>
        </x-adminlte-card>
    @endif
    <x-adminlte-card title="Kamar Rawat Inap" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Kamar" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='importform' class="btn-sm mb-2" label="Import" theme="primary"
                    icon="fas fa-download" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian" igroup-size="sm">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click="cari" theme="primary" label="Cari" />
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
                    <th>#</th>
                    <th>Nama Kamar</th>
                    <th>Kelas</th>
                    <th>Kapasitas Total</th>
                    <th>K.Pria</th>
                    <th>K.Wanita</th>
                    <th>K.PriaWanita</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kamars as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namaruang }}</td>
                        <td>
                            @switch($item->kodekelas)
                                @case(1)
                                    Kelas I
                                @break

                                @case(2)
                                    Kelas II
                                @break

                                @case(3)
                                    Kelas III
                                @break

                                @default
                            @endswitch
                        </td>
                        <td>{{ $item->kapasitastotal }}</td>
                        <td>{{ $item->kapasitaspria }}</td>
                        <td>{{ $item->kapasitaswanita }}</td>
                        <td>{{ $item->kapasitaspriawanita }}</td>
                        <td>
                            <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs" theme="warning"
                                icon="fas fa-edit" />
                            <x-adminlte-button wire:click='hapus({{ $item }})' class="btn-xs" theme="danger"
                                icon="fas fa-trash" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
</div>
