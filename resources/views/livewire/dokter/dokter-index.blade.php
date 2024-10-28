<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div id="editform">
            @if ($form)
                <x-adminlte-card title="Identitas Dokter" theme="secondary">
                    <form>
                        <input hidden wire:model="id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                                <x-adminlte-input wire:model="kode" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="kode" label="Kode" />
                                <x-adminlte-input wire:model="kodejkn" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="kodejkn" label="Kode JKN" />
                                <x-adminlte-input wire:model="nik" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="nik" label="NIK" />
                                <x-adminlte-input wire:model="idpractitioner" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="idpractitioner" label="IdPractitioner">
                                    <x-slot name="appendSlot">
                                        <div class="btn btn-primary"
                                            wire:click="cariIdPractitioner('{{ $nik }}')">
                                            <i class="fas fa-search"></i> Cari
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-select wire:model="gender" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="gender" label="Gender">
                                    <option value=null disabled>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </x-adminlte-select>
                                <x-adminlte-select wire:model="title" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="title" label="Title">
                                    <option value=null disabled>Pilih Title</option>
                                    <option>Dokter Umum</option>
                                    <option>Dokter Spesialis</option>
                                    <option>Dokter Sub Spesialis</option>
                                </x-adminlte-select>
                                <x-adminlte-input wire:model="sip" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="sip" label="SIP" />
                            </div>
                        </div>

                    </form>
                    <x-slot name="footerSlot">
                        <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                            wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan dokter ?"
                            form="formUpdate" theme="success" />
                        <a wire:navigate href="{{ route('dokter.index') }}">
                            <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                        </a>
                    </x-slot>
                </x-adminlte-card>
            @endif
        </div>
        @if ($formImport)
            <x-adminlte-card title="Import Dokter" theme="secondary">
                <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                    placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File Import' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport data dokter ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table Dokter" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah item" theme="success"
                        icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload semua data dokter ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Dokter"
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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Action</th>
                        <th>Kode JKN</th>
                        <th>NIK</th>
                        <th>IdPractitioner</th>
                        <th>Sex</th>
                        <th>Title</th>
                        <th>SIP</th>
                        <th>Status</th>
                        <th>PIC</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokters as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->index + $dokters->firstItem() }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <a href="#editform">
                                    <x-adminlte-button class="btn-xs" wire:click='edit({{ $item }})'
                                        label="Edit" theme="warning" icon="fas fa-edit" />
                                </a>
                                <x-adminlte-button class="btn-xs" wire:click='destroy({{ $item }})'
                                    wire:confirm="Apakah anda yakin ingin menghapus dokter ?" theme="danger"
                                    icon="fas fa-trash" />
                                <x-adminlte-button class="btn-xs" wire:click='nonaktif({{ $item }})'
                                    wire:confirm="Apakah anda yakin ingin nonactive dokter ?" label="Nonaktif"
                                    theme="danger" icon="fas fa-times" />
                            </td>
                            <td>{{ $item->kodejkn }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->idpractitioner }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->sip }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">active</span>
                                @else
                                    <span class="badge badge-danger">nonactive</span>
                                @endif
                            </td>
                            <td>{{ $item->pic }}</td>
                            <td>{{ $item->updated_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $dokters->links() }}
        </x-adminlte-card>
    </div>
</div>
