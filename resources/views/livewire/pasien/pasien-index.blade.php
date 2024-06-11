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
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
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
            @php
                $heads = [
                    '#',
                    'No RM',
                    'Nama Pasien',
                    'Action',
                    'No BPJS',
                    'NIK',
                    'IdPatient',
                    'No HP',
                    'Sex',
                    'Tgl Lahir',
                    'Umur',
                    'Alamat',
                    'Alamat',
                    'PIC',
                    'Updated',
                ];
                $config['order'] = [0, 'asc'];
                $config['paging'] = false;
                $config['searching'] = false;
                $config['info'] = false;
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered
                hoverable compressed>
                @forelse ($pasiens as $item)
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ $loop->index + $pasiens->firstItem() }}</td>
                        <td>{{ $item->norm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $item->norm) }}" wire:navigate>
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                        <td>{{ $item->nomorkartu }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->idpatient }}</td>
                        <td>{{ $item->nohp }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->tgl_lahir }} ({{ \Carbon\Carbon::parse($item->tgl_lahir)->age }})</td>
                        <td>{{ $item->jenispeserta }}</td>
                        <td>{{ $item->desa_id }}, {{ $item->kecamatan_id }},
                            {{ $item->kabupaten_id }}, {{ $item->provinsi_id }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->pic }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @empty
                @endforelse
            </x-adminlte-datatable>
            {{ $pasiens->links() }}
        </x-adminlte-card>
    </div>
</div>
