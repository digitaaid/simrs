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
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="logo_icon" class="text-left col-4">
                        Logo Bundar
                    </label>
                    <div class="input-group input-group-sm col-8">
                        <input id="logo_icon" type="file" name="logo_icon" class="form-control"
                            wire:model="logo_icon">
                    </div>
                    <div class=" col-4">
                        @if ($logo_icon)
                            <a href="{{ route('landingpage') . '/storage/pengaturan/' . $logo_icon }}"
                                target="_blank">{{ $logo_icon }}</a>
                        @endif
                    </div>
                    <div class="col-8">
                        @error('logo_icon')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="auth_img" class="text-left col-4">
                        Auth Image
                    </label>
                    <div class="input-group input-group-sm col-8">
                        <input id="auth_img" type="file" name="auth_img" class="form-control" wire:model="auth_img">
                    </div>
                    <div class=" col-4">
                        @if ($auth_img)
                            <a href="{{ route('landingpage') . '/storage/pengaturan/' . $auth_img }}"
                                target="_blank">{{ $auth_img }}</a>
                        @endif
                    </div>
                    <div class="col-8">
                        @error('auth_img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save" wire:click="store"
                wire:confirm="Apakah anda yakin ingin menambahkan unit ?" form="formUpdate" theme="success" />
        </x-slot>
    </x-adminlte-card>
</div>
