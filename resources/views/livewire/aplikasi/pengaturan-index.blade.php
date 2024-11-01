<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Pengaturan Aplikasi" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                    igroup-size="sm" name="nama" label="Nama" />
                <x-adminlte-input wire:model="idorganization" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="idorganization" label="IdOrganization" />
                <x-adminlte-input wire:model="phone" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="phone" label="Phone" />
                <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="email" label="Email" />
                <x-adminlte-input wire:model="website" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="website" label="Website" />
                <x-adminlte-input wire:model="address" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="address" label="Address" />
                <x-adminlte-input wire:model="postalCode" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="postalCode" label="Postal Code" />
                <x-adminlte-input wire:model="province" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="province" label="Province" />
                <x-adminlte-input wire:model="city" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="city" label="City" />
                <x-adminlte-input wire:model="district" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="district" label="District" />
                <x-adminlte-input wire:model="village" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="village" label="Village" />
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save" wire:click="store"
                wire:confirm="Apakah anda yakin ingin menambahkan unit ?" form="formUpdate" theme="success" />
        </x-slot>
    </x-adminlte-card>
</div>
