<div class="row">
    @include('components.layouts.flash_message')
    <div class="col-md-12">
        @if ($formImport)
            <x-adminlte-card title="Import Pasien" theme="secondary">
                <x-adminlte-input-file wire:model='filePasienImport' name="filePasienImport"
                    placeholder="{{ $filePasienImport ? $filePasienImport->getClientOriginalName() : 'Pilih File Pasien' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport file pasien saat ini ?' />
                    <x-adminlte-button theme="danger" wire:click='closeFormImport' class="btn-sm" icon="fas fa-times"
                        label="Kembali" data-dismiss="modal" />
                    <div wire:loading>
                        Loading...
                    </div>
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table Pasien" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <a href="{{ route('pasien.create') }}" wire:navigate>
                        <x-adminlte-button class="btn-sm" label="Tambah Pasien" theme="success"
                            icon="fas fa-user-plus" />
                    </a>
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload file pasien saat ini ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-file-export" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-file-import" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Pasien"
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
            <div class="table-responsive">
                <table class="table table-sm text-nowrap table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Action</th>
                            <th>No BPJS</th>
                            <th>NIK</th>
                            <th>IdPatient</th>
                            <th>No HP</th>
                            <th>Sex</th>
                            <th>Tgl Lahir</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Alamat</th>
                            <th>PIC</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $item)
                            <tr>
                                <td>{{ $loop->index + $pasiens->firstItem() }}</td>
                                <td>{{ $item->norm }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <a href="{{ route('pasien.edit', $item->norm) }}" wire:navigate>
                                        <x-adminlte-button class="btn-xs" label="Edit" theme="warning"
                                            icon="fas fa-edit" />
                                    </a>
                                </td>
                                <td>{{ $item->nomorkartu }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>
                                    {{ $item->idpatient }}
                                    <x-adminlte-button wire:click="getPatientId({{ $item->nik }})" class="btn-xs"
                                        theme="warning" icon="fas fa-sync" />
                                </td>
                                <td>{{ $item->nohp }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->tgl_lahir }} ({{ \Carbon\Carbon::parse($item->tgl_lahir)->age }})
                                </td>
                                <td>{{ $item->jenispeserta }}</td>
                                <td>{{ $item->desa_id }}, {{ $item->kecamatan_id }},
                                    {{ $item->kabupaten_id }}, {{ $item->provinsi_id }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pasiens->links() }}
        </x-adminlte-card>
    </div>
</div>
