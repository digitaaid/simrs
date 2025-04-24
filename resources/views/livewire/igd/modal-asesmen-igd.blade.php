<div>
    <x-adminlte-card theme="primary" title="Asesmen Awal IGD" icon="fas fa-user-md">
        <h5>Anamnesis</h5>
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Keluhan Utama" name="keluhan_utama"
            wire:model="keluhan_utama" />
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Penyakit" name="riwayat_penyakit"
            wire:model="riwayat_penyakit" />
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Alergi" name="riwayat_alergi"
            wire:model="riwayat_alergi" />
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Pengobatan" name="riwayat_pengobatan"
            wire:model="riwayat_pengobatan" />
        <h5>Asesmen Nyeri</h5>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="skala_nyeri" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="skala_nyeri" label="Skala Nyeri" />
                <x-adminlte-input wire:model="sarana_transportasi" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="sarana_transportasi" label="Sarana Transportasi" />
                <x-adminlte-input wire:model="surat_rujukan" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="surat_rujukan" label="Surat Rujukan" />
                <x-adminlte-input wire:model="kondisi_kedatangan" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="kondisi_kedatangan" label="Kondisi Kedatangan" />
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <h5>Kajian Resiko Jatuh</h5>
        <h5>Pemeriksaan Fisik</h5>
        <h5>Skrining Luka Decubitus</h5>
        <h5>Skrining Batuk</h5>
        <h5>Skrining Gizi</h5>
    </x-adminlte-card>
</div>
