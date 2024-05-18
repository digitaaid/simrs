<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Identitas User" theme="secondary">
            @if (flash()->message)
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            @endif
            <form>
                <input hidden wire:model="id" name="id">
                <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="name" label="Nama" placeholder="Nama Lengkap" />
                <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="email" type="email" label="Email"
                    placeholder="Email" />
                <x-adminlte-select wire:model="role" name="role" label="Role" fgroup-class="row"
                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm">
                    <option selected disabled>Pilih Role</option>
                    @foreach ($roles as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </x-adminlte-select>
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
