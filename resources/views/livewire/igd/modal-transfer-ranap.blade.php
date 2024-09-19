<div>
    <x-adminlte-card theme="primary" title="Tranfer Rawat Inap" icon="fas fa-bed">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model='nomorkartu' name="nomorkartu" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" label="Nomor Kartu">
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariNomorKartu'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input wire:model='nik' name="nik" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" label="NIK">
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariNIK'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input wire:model='norm' name="norm" label="No RM" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm">
                    <x-slot name="appendSlot">
                        <div class="btn btn-primary" wire:click='cariNoRM'>
                            <i class="fas fa-search"></i> Cari
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input wire:model='nama' name="nama" label="Nama Pasien" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                <x-adminlte-input wire:model='nohp' name="nohp" label="No HP" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                <x-adminlte-input wire:model='tgl_lahir' name="tgl_lahir" type='date' label="Tanggal Lahir"
                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                <x-adminlte-input wire:model='gender' name="gender" label="Jenis Kelamin" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                <x-adminlte-input wire:model='hakkelas' name="hakkelas" label="Kelas Pasien" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                <x-adminlte-input wire:model='jenispeserta' name="jenispeserta" label="Jenis Peserta" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model="kode_transfer" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="kode_transfer" label="Kode Transfer" readonly />
                <x-adminlte-input wire:model="kode" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="kode" label="Kode IGD" readonly />
                <x-adminlte-input wire:model="counter" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="counter" label="Counter" readonly />
                <x-adminlte-input wire:model="tgl_transfer" type='datetime-local' fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tgl_transfer"
                    label="Tanggal Transfer" />
                <x-adminlte-select wire:model.change='unit' fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="unit" label="Kamar/Ruangan">
                    <option value=null disabled>--Pilih Unit--</option>
                    @foreach ($units as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-select wire:model='bed' fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="bed" label="Bed">
                    <option value=null disabled>--Pilih Bed--</option>
                    @foreach ($beds as $bed)
                        <option value="{{ $bed->id }}" {{ $bed->status ? 'disabled' : null }}>BED
                            {{ $bed->nomorbed }} {{ $bed->status ? '(Dipakai)' : null }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-select wire:model='dokter' fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="dokter" label="Dokter DPJP">
                    <option value=null disabled>Pilih Dokter</option>
                    @foreach ($dokters as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-select wire:model="cara_masuk" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="cara_masuk" label="Cara Masuk">
                    <option value=null disabled>Pilih Cara masuk</option>
                    <option value="gp">Rujukan FKTP</option>
                    <option value="hosp-trans">Rujukan FKRTL</option>
                    <option value="mp">Rujukan Spesialis</option>
                    <option value="outp">Dari Rawat Jalan</option>
                    <option value="inp">
                        Dari
                        Rawat Inap</option>
                    <option value="emd">
                        Dari
                        Rawat Darurat</option>
                    <option value="born">
                        Lahir
                        di RS</option>
                    <option value="nursing">
                        Rujukan Panti Jompo</option>
                    <option value="psych">
                        Rujukan dari RS Jiwa</option>
                    <option value="rehab">
                        Rujukan Fasilitas Rehab</option>
                    <option value="other">
                        Lain-lain</option>
                </x-adminlte-select>
                <x-adminlte-select wire:model="jeniskunjungan" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" name="jeniskunjungan" label="Jenis Kunjungan">
                    <option value=null disabled>Pilih Jenis Kunjungan</option>
                    <option value="6">
                        Pelayanan Rawat Inap</option>
                </x-adminlte-select>
                <x-adminlte-select wire:model='penjamin' igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" name="penjamin" label="Jaminan Pasien">
                    <option value=null disabled>Pilih Jaminan</option>
                    @foreach ($jaminans as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-input wire:model="nomorreferensi" name="nomorreferensi" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Nomor Referensi" />
                <x-adminlte-input wire:model="sep" name="sep" fgroup-class="row" label-class="text-left col-4"
                    igroup-class="col-8" igroup-size="sm" label="Nomor SEP" />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-bed" class="btn-sm" label="Transfer"
                wire:click="editKunjungan" wire:confirm='Apakah anda yakin akan mentransfer pasien ke rawat inap ?' />
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
