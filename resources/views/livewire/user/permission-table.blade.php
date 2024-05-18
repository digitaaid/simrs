<div>
    <x-adminlte-card title="Table Permission" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button class="btn-sm mb-3" label="Add Permission" theme="success" icon="fas fa-user-plus" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Permission"
                    igroup-size="sm">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click="test" theme="primary" label="Cari" />
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
