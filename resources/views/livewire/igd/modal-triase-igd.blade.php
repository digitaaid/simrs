<div>
    <x-adminlte-card theme="primary" title="Triase IGD" icon="fas fa-ambulance">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="tgl_masuk" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="tgl_masuk" label="Tanggal Masuk" />
                <x-adminlte-input wire:model="transportasi" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="transportasi" label="Sarana Transportasi" />
                <x-adminlte-input wire:model="rujukan_igd" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="rujukan_igd" label="Surat Rujukan" />
                <x-adminlte-input wire:model="kondisi_datang" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="kondisi_datang" label="Kondisi Kedatangan" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model="nama_pengantar" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="nama_pengantar" label="Nama Pengantar" />
                <x-adminlte-input wire:model="nohp_pengantar" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="nohp_pengantar" label="No HP Pengantar" />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="simpanTriase" wire:confirm='Apakah anda yakin akan simpan data ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary">
                </div>
                Loading ...
            </div>
            @if (flash()->message)
                <div class="text-{{ flash()->class }}" wire:loading.remove>
                    Loading Result : {{ flash()->message }}
                </div>
            @endif
        </x-slot>
    </x-adminlte-card>
</div>
