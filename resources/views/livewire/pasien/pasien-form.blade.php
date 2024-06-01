<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Identitas Pasien" theme="secondary">
            @if (flash()->message)
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            @endif
            <div class="row">
                <input hidden wire:model="id" name="id">
                <div class="col-md-4">
                    <x-adminlte-input wire:model="norm" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="norm" label="No RM" readonly />
                    <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                    <x-adminlte-input wire:model="nik" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="nik" label="NIK">
                        <x-slot name="appendSlot">
                            <div class="btn btn-primary" wire:click='cariNIK'>
                                <i class="fas fa-search"></i> Cari
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input wire:model="nomorkartu" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="nomorkartu" label="No Kartu">
                        <x-slot name="appendSlot">
                            <div class="btn btn-primary" wire:click='cariNomorKartu'>
                                <i class="fas fa-search"></i> Cari
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input wire:model="idpatient" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="idpatient" label="IdPatient">
                        <x-slot name="appendSlot">
                            <div class="btn btn-primary" wire:click='cariNomorKartu'>
                                <i class="fas fa-search"></i> Cari
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input wire:model="nohp" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="nohp" label="No HP" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-select wire:model="gender" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="gender" label="Sex">
                        <option value=null disabled>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </x-adminlte-select>
                    <x-adminlte-input wire:model.live="tempat_lahir" list="tempat_lahir_list" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tempat_lahir"
                        label="Tempat Lahir" />
                    <datalist id="tempat_lahir_list">
                        @foreach ($kabupatens as $code => $name)
                            <option value="{{ $name }}"></option>
                        @endforeach
                    </datalist>
                    <x-adminlte-input wire:model="tgl_lahir" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="tgl_lahir" label="Tgl Lahir" type="date" />
                    <x-adminlte-input wire:model="hakkelas" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="hakkelas" label="Hak Kelas" />
                    <x-adminlte-input wire:model="jenispeserta" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="jenispeserta" label="Jns Peserta" />
                    <x-adminlte-input wire:model="fktp" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="fktp" label="FKTP" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model="alamat" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="alamat" label="Alamat" />
                    <x-adminlte-input wire:model.live="provinsi_id" list="provinsi_id_list" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="provinsi_id"
                        label="Provinsi" />
                    <datalist id="provinsi_id_list">
                        @foreach ($provinsis as $code => $name)
                            <option value="{{ $name }}"></option>
                        @endforeach
                    </datalist>
                    <x-adminlte-input wire:model.live="kabupaten_id" list="kabupaten_id_list" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="kabupaten_id"
                        label="Kabupaten" />
                    <datalist id="kabupaten_id_list">
                        @foreach ($kabupatens as $code => $name)
                            <option value="{{ $name }}"></option>
                        @endforeach
                    </datalist>
                    <x-adminlte-input wire:model.live="kecamatan_id" list="kecamatan_id_list" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="kecamatan_id"
                        label="Kecamatan" />
                    <datalist id="kecamatan_id_list">
                        @foreach ($kecamatans as $code => $name)
                            <option value="{{ $name }}"></option>
                        @endforeach
                    </datalist>
                    <x-adminlte-input wire:model.live="desa_id" list="desa_id_list" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="Desa"
                        label="Desa" />
                    <datalist id="desa_id_list">
                        @foreach ($desas as $code => $name)
                            <option value="{{ $name }}"></option>
                        @endforeach
                    </datalist>
                    <x-adminlte-input wire:model="keterangan" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="keterangan" label="Keterangan" />
                </div>
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                    wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan pasien ?" form="formUpdate"
                    theme="success" />
                <a wire:navigate href="{{ route('pasien.index') }}">
                    <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
                <div wire:loading>Loading...</div>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
