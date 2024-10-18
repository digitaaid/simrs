<div>
    <x-adminlte-card theme="primary" title="Triase IGD" icon="fas fa-ambulance">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="sarana_transportasi" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="sarana_transportasi" label="Sarana Transportasi" />
                <x-adminlte-input wire:model="surat_rujukan" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="surat_rujukan" label="Surat Rujukan" />
                <x-adminlte-input wire:model="kondisi_kedatangan" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="kondisi_kedatangan" label="Kondisi Kedatangan" />
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Keluhan Utama" name="keluhan_utama"
                    wire:model="keluhan_utama" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Penyakit" name="riwayat_penyakit"
                    wire:model="riwayat_penyakit" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Alergi" name="riwayat_alergi"
                    wire:model="riwayat_alergi" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Pengobatan" name="riwayat_pengobatan"
                    wire:model="riwayat_pengobatan" />
            </div>
        </div>
    </x-adminlte-card>
</div>
