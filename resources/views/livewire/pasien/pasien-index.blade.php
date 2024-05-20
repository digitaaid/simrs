<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card title="Table Pasien" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <a href="{{ route('pasien.create') }}" wire:navigate>
                        <x-adminlte-button class="btn-sm" label="Tambah Pasien" theme="success"
                            icon="fas fa-user-plus" />
                    </a>
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
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No RM</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No BPJS</th>
                        <th>IdPatient</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                        <tr wire:key="{{ $pasien->id }}">
                            <td>{{ $loop->index + $pasiens->firstItem() }}</td>
                            <td>{{ $pasien->norm }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->nik }}</td>
                            <td>{{ $pasien->nomorkartu }}</td>
                            <td>{{ $pasien->idpatient }}</td>
                            <td>{{ $pasien->updated_at }}</td>
                            <td>
                                <a href="{{ route('pasien.edit', $pasien->norm) }}" wire:navigate>
                                    <x-adminlte-button class="btn-xs" label="Edit" theme="warning"
                                        icon="fas fa-edit" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pasiens->links() }}
        </x-adminlte-card>
    </div>
</div>
