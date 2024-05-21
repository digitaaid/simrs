<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <x-adminlte-card title="Table item" theme="secondary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="col-md-6">
                        <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nama" label="nama" placeholder="nama" />
                        <x-adminlte-input wire:model="kode" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="kode" label="kode" placeholder="kode" />
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                        wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan dokter ?" form="formUpdate"
                        theme="success" />
                    <a wire:navigate href="{{ route('dokter.index') }}">
                        <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                    </a>
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table item" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah item" theme="success"
                        icon="fas fa-user-plus" />
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
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokters as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->index + $dokters->firstItem() }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <x-adminlte-button class="btn-xs" wire:click='edit({{ $item }})' label="Edit"
                                    theme="warning" icon="fas fa-edit" />
                                <x-adminlte-button class="btn-xs" wire:click='destroy({{ $item }})'
                                    wire:confirm="Apakah anda yakin ingin menghapus dokter ?" label="Hapus"
                                    theme="danger" icon="fas fa-trash" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $dokters->links() }}
        </x-adminlte-card>
    </div>
</div>
