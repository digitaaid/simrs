<div>
    <x-adminlte-card title="Jadwal Shift Kerja" theme="primary">
        <div class="row ">
            <div class="col-md-8">
                <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah Shift Kerja" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload data semua obat ? ' class="btn-sm"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                    icon="fas fa-download" />
            </div>
            <div class="col-md-4">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Obat"
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
                    <th>Nama Shift Kerja</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </x-adminlte-card>
</div>
