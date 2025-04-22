<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Referensi Vclaim BPJS" theme="secondary" collapsible>
            {{-- Input Diagnosa --}}
            <x-adminlte-input wire:model.live="diagnosa" name="diagnosa" igroup-size="sm" label="Diagnosa">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingDiagnosa" :data="$diagnosas" :columns="['Kode ICD-10', 'Nama Diagnosa']" clickEvent="selectDiagnosa" />
            {{-- Input Procedure --}}
            <x-adminlte-input wire:model.live="procedure" name="procedure" igroup-size="sm" label="Procedure">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingProcedure" :data="$procedures" :columns="['Kode ICD-9', 'Nama Procedure']" clickEvent="selectProcedure" />
            {{-- Input Faskes --}}
            <x-adminlte-select wire:model="jenisfaskes" name="jenisfaskes" label="Jenis Faskes">
                <option value=null>Pilih Jenis Faskes</option>
                <option value="1">FKTP (Puskesmas / Klinik Pratama)</option>
                <option value="2">FKTL (RS / Klinik Utama)</option>
            </x-adminlte-select>
            <x-adminlte-input wire:model.live="faskes" name="faskes" igroup-size="sm" label="Faskes">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingFaskes" :data="$faskess" :columns="['Kode Faskes', 'Nama Faskes']" clickEvent="selectFaskes" />

            <x-adminlte-input wire:model="tanggal" type="date" name="tanggal" igroup-size="sm" label="tanggal" />
            <x-adminlte-select wire:model="jenispelayanan" name="jenispelayanan" label="Jenis Pelayanan">
                <option value=null>Pilih Jenis Pelayanan</option>
                <option value="1">Rawat Inap</option>
                <option value="2">Rawat Jalan</option>
            </x-adminlte-select>
            {{-- Input Poliklinik --}}
            <x-adminlte-input wire:model.live="poliklinik" name="poliklinik" igroup-size="sm" label="Poliklinik">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingPoliklinik" :data="$polikliniks" :columns="['Kode Poliklinik', 'Nama Poliklinik']" clickEvent="selectPoliklinik" />

            {{-- Input Dokter --}}
            <x-adminlte-input wire:model.live="dokter" name="dokter" igroup-size="sm" label="Dokter">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingDokter" :data="$dokters" :columns="['Kode Dokter', 'Nama Dokter']" clickEvent="selectDokter" />

            <x-adminlte-input wire:model.live="provinsi" name="provinsi" igroup-size="sm" label="provinsi">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingProvinsi" :data="$provinsis" :columns="['Kode Provinsi', 'Nama Provinsi']" clickEvent="selectProvinsi" />

            <x-adminlte-input wire:model.live="kabupaten" name="kabupaten" igroup-size="sm" label="kabupaten">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingKabupaten" :data="$kabupatens" :columns="['Kode Kabupaten', 'Nama Kabupaten']" clickEvent="selectKabupaten" />

            <x-adminlte-input wire:model.live="kecamatan" name="kecamatan" igroup-size="sm" label="kecamatan">
            </x-adminlte-input>
            <x-search-table :isSearching="$searchingKecamatan" :data="$kecamatans" :columns="['Kode Kecamatan', 'Nama Kecamatan']" clickEvent="selectKecamatan" />

        </x-adminlte-card>
    </div>
</div>
