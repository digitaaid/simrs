<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Identitas Pegawai" theme="secondary">
            <form>
                <div class="row">
                    <input hidden wire:model="id" name="id">
                    <div class="col-md-4">
                        <x-adminlte-input wire:model="norm" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="norm" label="norm" placeholder="norm"
                            readonly />
                        <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nama" label="nama" placeholder="nama" />
                        <x-adminlte-input wire:model="nik" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nik" label="nik" placeholder="nik" />
                        <x-adminlte-input wire:model="nomorkartu" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nomorkartu" label="nomorkartu"
                            placeholder="nomorkartu" />
                        <x-adminlte-input wire:model="idpatient" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="idpatient" label="idpatient"
                            placeholder="idpatient" />
                        <x-adminlte-input wire:model="nohp" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nohp" label="nohp" placeholder="nohp" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input wire:model="tempat_lahir" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="tempat_lahir" label="tempat_lahir"
                            placeholder="tempat_lahir" />
                        @php
                            $config = ['format' => 'YYYY-MM-DD'];
                        @endphp
                        <x-adminlte-input-date wire:model="tgl_lahir" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" value="{{ $tgl_lahir ?? null }}" name="tgl_lahir"
                            label="tgl_lahir" placeholder="tgl_lahir" :config="$config" />
                        <x-adminlte-input wire:model="hakkelas" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="hakkelas" label="hakkelas"
                            placeholder="hakkelas" />
                        <x-adminlte-input wire:model="jenispeserta" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="jenispeserta" label="jenispeserta"
                            placeholder="jenispeserta" />
                        <x-adminlte-input wire:model="fktp" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="fktp" label="fktp" placeholder="fktp" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input wire:model="alamat" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="alamat" label="alamat"
                            placeholder="alamat" />
                        <x-adminlte-input wire:model="desa_id" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="desa_id" label="desa_id"
                            placeholder="desa_id" />
                        <x-adminlte-input wire:model="kecamatan_id" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="kecamatan_id" label="kecamatan_id"
                            placeholder="kecamatan_id" />
                        <x-adminlte-input wire:model="kabupaten_id" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="kabupaten_id" label="kabupaten_id"
                            placeholder="kabupaten_id" />
                        <x-adminlte-input wire:model="provinsi_id" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="provinsi_id" label="provinsi_id"
                            placeholder="provinsi_id" />
                        <x-adminlte-input wire:model="keterangan" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="keterangan" label="keterangan"
                            placeholder="keterangan" />
                    </div>
                </div>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                    wire:click="store" wire:confirm="Apakah anda yakin ingin menambahkan pasien ?" form="formUpdate"
                    theme="success" />
                <a wire:navigate href="{{ route('pasien.index') }}">
                    <x-adminlte-button class="btn-sm" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>

</div>
@push('js')
    <script>
        $(function() {
            // alert('init');
        });

        function store() {
            console.log($('#tgl_lahir').val());
            @this.set('tgl_lahir', $('#tgl_lahir').val());
        }
    </script>
@endpush
