<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    @if ($form)
        <x-adminlte-card title="Formulir Bed Rawat Inap" theme="primary">
            <input type="hidden" name="id" wire:model='id'>
            <x-adminlte-select wire:model='kamar_id' igroup-size="sm" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" name="kamar_id" label="Kamar/Ruangan">
                <option value=null disabled selected>--Pilih Unit--</option>
                @foreach ($kamars as $kamars)
                    <option value="{{ $kamars->id }}">{{ $kamars->namaruang }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-input wire:model="nomorbed" fgroup-class="row" label-class="text-right col-4"
                igroup-class="col-8" igroup-size="sm" name="nomorbed" label="Nomor Bed" />
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                    wire:confirm="Apakah anda ingin menyimpan data kamar ?" theme="success" />
                <x-adminlte-button wire:click='tambah' class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
            </x-slot>
        </x-adminlte-card>
    @endif
    <x-adminlte-card title="Bed Rawat Inap" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Bed" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='import' class="btn-sm mb-2" label="Import" theme="primary"
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
                    <th>No Bed</th>
                    <th>Kamar</th>
                    <th>Pria</th>
                    <th>Wanita</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beds as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomorbed }}</td>
                        <td>{{ $item->namaruang }}</td>
                        <td>{{ $item->bedpria }}</td>
                        <td>{{ $item->bedwanita }}</td>
                        <td>{{ $item->status }}</td>
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
