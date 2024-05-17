<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Identitas User" theme="secondary">
            <form>
                <input hidden wire:model="id" name="id">
                <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="name" label="Nama" placeholder="Nama Lengkap" />
                <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="email" type="email" label="Email"
                    placeholder="Email" />
                <x-adminlte-input wire:model="password" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="password" type="password" label="Password"
                    placeholder="Password" />
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="save"
                    wire:confirm="Apakah anda yakin ingin menambahkan user ?" form="formUpdate" theme="success" />
                <a wire:navigate href="{{ route('user.index') }}">
                    <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
