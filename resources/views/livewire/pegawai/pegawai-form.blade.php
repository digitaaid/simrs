<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Identitas Pegawai" theme="secondary">
            <form>
                <div class="row">
                    <input hidden wire:model="id" name="id">
                    <div class="col-md-6">
                        <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="name" label="Nama"
                            placeholder="Nama Lengkap" />
                        <x-adminlte-input wire:model="nik" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="nik" label="NIK" placeholder="NIK" />
                        <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="email" type="email" label="Email"
                            placeholder="Email" />
                        <x-adminlte-input wire:model="nohp" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="nohp" label="No HP" placeholder="No HP" />
                        <x-adminlte-input wire:model="alamat" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="alamat" label="Alamat" placeholder="Alamat" />
                        <x-adminlte-input wire:model="jabatan" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="jabatan" label="Jabatan"
                            placeholder="Jabatan" />
                        <x-adminlte-input wire:model="awal_kerja" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="awal_kerja" label="Awal Kerja"
                            placeholder="Awal Kerja" />
                    </div>
                    <div class="col-md-6">
                        <x-adminlte-input wire:model="pendidikan" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="pendidikan" label="Pendidikan"
                            placeholder="Pendidikan" />
                        <x-adminlte-input wire:model="sekolah" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="sekolah" label="Sekolah"
                            placeholder="Sekolah" />
                        <x-adminlte-input wire:model="jurusan" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="jurusan" label="Jurusan"
                            placeholder="Jurusan" />
                        <x-adminlte-input wire:model="sip" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="sip" label="SIP" placeholder="SIP" />
                        <x-adminlte-input wire:model="sip_expire" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="sip_expire" label="Masa Berlaku"
                            placeholder="Masa Berlaku" />
                        <x-adminlte-input wire:model="str" fgroup-class="row" label-class="text-left col-3"
                            igroup-class="col-9" igroup-size="sm" name="str" label="STR"
                            placeholder="STR" />
                    </div>
                </div>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="save"
                    wire:confirm="Apakah anda yakin ingin menambahkan user ?" form="formUpdate" theme="success" />
                <a wire:navigate href="{{ route('pegawai.index') }}">
                    <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
