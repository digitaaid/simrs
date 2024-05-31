<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
          @include('livewire.jadwaldokter.form-jadwal-dokter')
        @endif
        <x-adminlte-card title="Table Jadwal Dokter Rawat Jalan" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='formJadwal' class="btn-sm" label="Tambah Jadwal" theme="success"
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
                        <th>Action</th>
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
                                <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                    wire:click="edit({{ $item }})" theme="warning" />
                                <x-adminlte-button class="btn-xs" icon="fas fa-trash"
                                    wire:click="destroy({{ $item }})"
                                    wire:confirm="Apakah anda yakin ingin menghapus jadwal ?" theme="danger" />
                                <x-adminlte-button label="Libur" class="btn-xs" icon="fas fa-times"
                                    wire:click="libur({{ $item }})"
                                    wire:confirm="Apakah anda yakin ingin meliburkan jadwal ?" theme="danger" />
                            </td>
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
