<div>
    <x-adminlte-card theme="primary" title="Antrian Pasien">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <form wire:submit="editAntrian">
            <input type="hidden" wire:model='kodebooking' name="kodebooking">
            <input type="hidden" wire:model='antrianId' name="antrianId">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input wire:model='nomorkartu' name="nomorkartu" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Nomor Kartu">
                        <x-slot name="appendSlot">
                            <div class="btn btn-primary" wire:click='cariNomorKartu'>
                                <i class="fas fa-search"></i> Cari
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input wire:model='nik' name="nik" class="nik-id" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="NIK">
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
                    <x-adminlte-input wire:model='nohp' name="nohp" class="nohp-id" label="Nomor HP"
                        fgroup-class="row" label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input wire:model='tanggalperiksa' name="tanggalperiksa" type='date'
                        label="Tanggal Periksa" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                        igroup-size="sm" />
                    <x-adminlte-select wire:model='jenispasien' fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="jenispasien" label="Jenis Pasien">
                        <option value=null disabled>Pilih Jenis Pasien</option>
                        <option value="JKN">JKN</option>
                        <option value="NON-JKN">NON-JKN</option>
                    </x-adminlte-select>
                    <x-adminlte-select wire:model='kodepoli' fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="kodepoli" label="Poliklinik">
                        <option value=null disabled>Pilih Poliklinik</option>
                        @foreach ($polikliniks as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-select wire:model='kodedokter' fgroup-class="row" label-class="text-left col-4"
                        igroup-class="col-8" igroup-size="sm" name="kodedokter" label="Dokter">
                        <option value=null disabled>Pilih Dokter</option>
                        @foreach ($dokters as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-adminlte-select>
                    @if ($antrian->jenispasien == 'JKN')
                        <x-adminlte-select fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                            igroup-size="sm" name="asalRujukan" class="asalRujukan-antrian" label="Jenis Rujukan">
                            <option value="1" {{ $antrian->jeniskunjungan == '1' ? 'selected' : null }}>
                                Rujukan
                                FKTP</option>
                            <option value="2" {{ $antrian->jeniskunjungan == '4' ? 'selected' : null }}>
                                Rujukan
                                Antar RS</option>
                        </x-adminlte-select>
                        <x-adminlte-input name="noRujukan" class="noRujukan-id" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="No Rujukan"
                            placeholder="No Rujukan" readonly value="{{ $antrian->nomorrujukan }}">
                            <x-slot name="appendSlot">
                                <div class="btn btn-primary" onclick="cariRujukanAntrian()">
                                    <i class="fas fa-search"></i> Cari
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="noSurat" class="noSurat-id" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                            label="No Surat Kontrol" placeholder="No Surat Kontrol"
                            value="{{ $antrian->nomorsuratkontrol }}" readonly>
                            <x-slot name="appendSlot">
                                <div class="btn btn-primary" onclick="cariSuratKontrol()">
                                    <i class="fas fa-search"></i> Cari
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    @endif
                </div>
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="editAntrian" wire:confirm='Apakah anda yakin akan menyimpan data antrian ?' />
            <x-adminlte-button wire:click='closeformAntrian' theme="danger" class="btn-sm" icon="fas fa-times"
                label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
