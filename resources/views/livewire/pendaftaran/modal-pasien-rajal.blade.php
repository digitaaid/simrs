    <div>
        <x-adminlte-card theme="primary" title="Data Pasien" icon="fas fa-user-injured">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="searchPasien" placeholder="Pencarian Pasien"
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
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>No BPJS</th>
                        <th>NIK</th>
                        <th>Sex</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $item)
                        <tr>
                            <td>{{ $loop->index + $pasiens->firstItem() }}</td>
                            <td>{{ $item->norm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nomorkartu }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nohp }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-slot name="footerSlot">
                <x-adminlte-button wire:click='closeformPasien' theme="danger" class="btn-sm" icon="fas fa-times"
                    label="Tutup" />
            </x-slot>
        </x-adminlte-card>
    </div>
