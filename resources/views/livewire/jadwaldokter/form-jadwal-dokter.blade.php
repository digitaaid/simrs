<x-adminlte-card title="Jadwal Dokter Rawat Jalan" theme="secondary">
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" wire:model="id" name="id">
            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                wire:model="hari" igroup-size="sm" name="hari" label="Hari">
                <option value=null disabled>Silahkan Pilih Hari</option>
                @foreach ($haris as $kode => $nama)
                    <option value="{{ $kode }}">{{ $nama }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                wire:model="dokter" igroup-size="sm" name="dokter" label="Dokter">
                <option value=null disabled>Silahkan Pilih Dokter</option>
                @foreach ($dokters as $kode => $nama)
                    <option value="{{ $kode }}">{{ $nama }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                wire:model="unit" igroup-size="sm" name="unit" label="Unit">
                <option value=null disabled>Silahkan Pilih Unit</option>
                @foreach ($units as $kode => $nama)
                    <option value="{{ $kode }}">{{ $nama }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-input wire:model="kapasitas" type='number' fgroup-class="row"
                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="kapasitas"
                label="Kapasitas" />
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input wire:model="mulai" fgroup-class="row" type='time'
                        label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" name="mulai"
                        label="Mulai" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input wire:model="selesai" fgroup-class="row" type='time'
                        label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                        name="selesai" label="Selesai" />
                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <x-slot name="footerSlot">
        <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
            wire:confirm="Apakah anda yakin ingin menyimpan permission ?" theme="success" />
        <x-adminlte-button wire:click='formJadwal' class="btn-sm" label="Tutup" theme="danger"
            icon="fas fa-times" />
    </x-slot>
</x-adminlte-card>
