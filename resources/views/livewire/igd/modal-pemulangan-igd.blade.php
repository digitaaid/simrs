<div>
    <x-adminlte-card theme="primary" title="Pemulangan Pasien" icon="fas fa-ambulance">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="kode" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                    igroup-size="sm" name="kode" label="Kode" readonly />
                <x-adminlte-input wire:model="counter" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="counter" label="Counter" readonly />
                <x-adminlte-input wire:model="noSep" name="noSep" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" label="Nomor SEP" readonly />
                <x-adminlte-input wire:model="tgl_masuk" type='datetime-local' fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tgl_masuk"
                    label="Tanggal Masuk" />
                <x-adminlte-input wire:model="tgl_pulang" type='datetime-local' fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tgl_pulang"
                    label="Tanggal Pulang" />
            </div>
            <div class="col-md-6">
                <x-adminlte-select wire:model.live="status_pulang" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="status_pulang" label="Status Pulang">
                    <option value="">Pilih Status Pulang</option>
                    <option value="1">Atas Persetujuan Dokter</option>
                    <option value="3">Atas Permintaan Sendiri</option>
                    <option value="4">Meninggal</option>
                    <option value="5">Lain-lain</option>
                </x-adminlte-select>
                @if ($status_pulang == 4)
                    <x-adminlte-input wire:model="tgl_meninggal" type='date' fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tgl_meninggal"
                        label="Tanggal Meninggal" />
                    <x-adminlte-input wire:model="noSuratMeninggal" fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="noSuratMeninggal" label="No Surat Meninggal" />
                @endif
                <x-adminlte-input wire:model="noLPManual" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="noLPManual" label="No LP Kecelakaan"
                    placeholder="Jika Kasus Kecelakaan" />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-bed" class="btn-sm" label="Simpan"
                wire:click="editKunjungan"
                wire:confirm='Apakah anda yakin akan menyimpan kunjungan pasien rawat inap ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
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
