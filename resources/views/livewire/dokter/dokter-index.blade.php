<div class="row">
    <x-flash-message />
    <div class="col-md-12">
        @if ($form)
            <x-modal size="xl" title="Dokter" icon="fas fa-user-md" theme="dark">
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
                                    <div class="btn btn-primary" wire:click="cariIdPractitioner('{{ $nik }}')">
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
                        wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan dokter ?" form="formUpdate"
                        theme="success" />
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Batal" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-modal>
        @endif
        @if ($formImport)
            <x-modal size="lg" title="Import Unit" icon="fas fa-file-import" theme="dark">
                <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                    placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File Import' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport data dokter ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-modal>
        @endif
        <x-adminlte-card title="Data Dokter" theme="secondary" icon="fas fa-user-md">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" title="Tambah" theme="success"
                        icon="fas fa-folder-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload semua data dokter ? ' class="btn-sm"
                        title="Export" theme="primary" icon="fas fa-file-export" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" title="Import" theme="primary"
                        icon="fas fa-file-import" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian"
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
                            <td>
                                {{ $item->idpractitioner }}
                                <x-adminlte-button wire:click="getPractitionerId({{ $item->nik }})" class="btn-xs"
                                    theme="warning" icon="fas fa-sync" />
                            </td>
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
