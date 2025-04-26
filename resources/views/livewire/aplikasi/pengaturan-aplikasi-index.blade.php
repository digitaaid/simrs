<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                        <h3 class="card-title">Pengaturan</h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tabs-akun">Aplikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tabs-anjungan">Anjungan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabs-akun">
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                                <x-adminlte-input wire:model="nama_panjang" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="nama_panjang" label="Nama Panjang" />
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
                                        <input id="auth_img" type="file" name="auth_img" class="form-control"
                                            wire:model="auth_img">
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
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="anjungan_color" fgroup-class="row"
                                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                    name="anjungan_color" label="Warna Anjungan" />
                                <div class="form-group row">
                                    <label for="anjungan_qr" class="text-left col-4">
                                        QR Anjungan
                                    </label>
                                    <div class="input-group input-group-sm col-8">
                                        <input id="anjungan_qr" type="file" name="anjungan_qr" class="form-control"
                                            wire:model="anjungan_qr">
                                    </div>
                                    <div class=" col-4">
                                        @if ($anjungan_qr)
                                            <a href="{{ route('landingpage') . '/storage/pengaturan/' . $anjungan_qr }}"
                                                target="_blank">{{ $anjungan_qr }}</a>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        @error('anjungan_qr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="anjungan_img_info" class="text-left col-4">
                                        Gambar Info Anjungan
                                    </label>
                                    <div class="input-group input-group-sm col-8">
                                        <input id="anjungan_img_info" type="file" name="anjungan_img_info"
                                            class="form-control" wire:model="anjungan_img_info">
                                    </div>
                                    <div class=" col-4">
                                        @if ($anjungan_img_info)
                                            <a href="{{ route('landingpage') . '/storage/pengaturan/' . $anjungan_img_info }}"
                                                target="_blank">{{ $anjungan_img_info }}</a>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        @error('anjungan_img_info')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo_karcis" class="text-left col-4">
                                        Logo Karcis Antrian
                                    </label>
                                    <div class="input-group input-group-sm col-8">
                                        <input id="logo_karcis" type="file" name="logo_karcis"
                                            class="form-control" wire:model="logo_karcis">
                                    </div>
                                    <div class=" col-4">
                                        @if ($logo_karcis)
                                            <a href="{{ route('landingpage') . '/storage/pengaturan/' . $logo_karcis }}"
                                                target="_blank">{{ $logo_karcis }}</a>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        @error('logo_karcis')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-anjungan">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
            </div>
            <div class="card-footer">
                <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                    wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan unit ?" form="formUpdate"
                    theme="success" />
            </div>
        </div>
    </div>
</div>
