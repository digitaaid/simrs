<div>
    <x-adminlte-card title="Formulir Kamar Rawat Inap" theme="secondary">
    </x-adminlte-card>
    <x-adminlte-card title="Kamar Rawat Inap" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-2" label="Add Role" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='openFormImport' class="btn-sm mb-2" label="Import" theme="primary"
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
    </x-adminlte-card>
</div>
