<div id="pemeriksaandokter">
    <x-adminlte-card theme="primary" title="Pemeriksaan Dokter">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <input type="hidden" name="kodebooking" wire:model="kodebooking">
        <input type="hidden" name="antrian_id" wire:model="antrian_id">
        <input type="hidden" name="kodekunjungan" wire:model="kodekunjungan">
        <input type="hidden" name="kunjungan_id" wire:model="kunjungan_id">
        <h6>Subjective (S) - Keluhan Utama & Riwayat Penyakit</h6>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-select name="sumber_data" label="Sumber Data" fgroup-class="row"
                    label-class="text-left col-3" igroup-size="sm" igroup-class="col-9" wire:model="sumber_data">
                    <option value=null disabled>Pilih Sumber Data</option>
                    <option>Pasien Sendiri / Autoanamase</option>
                    <option>Keluarga / Alloanamnesa</option>
                </x-adminlte-select>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4"><b>Riwayat Pernah Berobat :</b></div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="pernahberobat1" name="pernah_berobat"
                                value="Iya" wire:model="pernah_berobat">
                            <label for="pernahberobat1" class="custom-control-label">Iya</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="pernahberobat2" name="pernah_berobat"
                                value="Tidak" wire:model="pernah_berobat">
                            <label for="pernahberobat2" class="custom-control-label">Tidak</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Keluhan Utama" name="keluhan_utama"
                    wire:model="keluhan_utama" />
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Pengobatan" name="riwayat_pengobatan"
                    wire:model="riwayat_pengobatan" />
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Penyakit" name="riwayat_penyakit"
                    wire:model="riwayat_penyakit" />
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Alergi" name="riwayat_alergi"
                    wire:model="riwayat_alergi" />
            </div>
        </div>
        <h6>Objective (O) - Pemeriksaan Fisik</h6>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="denyut_jantung" label="Denyut Jantung" igroup-size="sm" type="number"
                    fgroup-class="row" label-class="text-left col-5" igroup-size="sm" igroup-class="col-7"
                    wire:model="denyut_jantung">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            bpm
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="pernapasan" label="Pernapasan" igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" type="number"
                    wire:model="pernapasan">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            spm
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="sistole" label="Sistole" igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" type="number"
                    wire:model="sistole">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            mmHg
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="distole" label="Diastole" igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" type="number"
                    wire:model="distole">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            mmHg
                        </div>
                    </x-slot>
                </x-adminlte-input>

            </div>
            <div class="col-md-6">
                <x-adminlte-input name="suhu" label="Suhu Tubuh" igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" wire:model="suhu">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            celcius
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="berat_badan" label="Berat Badan" igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" type="number"
                    wire:model.live="berat_badan" wire:change="calculateBsa">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            kg
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="tinggi_badan" type="number" label="Tinggi Badan" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" igroup-size="sm"
                    wire:model.live="tinggi_badan" wire:change="calculateBsa">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            cm
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="bsa" label="Index BSA (m2)" fgroup-class="row"
                    label-class="text-left col-5" igroup-size="sm" igroup-class="col-7" igroup-size="sm" readonly
                    wire:model="bsa">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-secondary">
                            kg/m2
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Pemeriksaan Fisik Perawat"
            name="pemeriksaan_fisik_perawat" wire:model="pemeriksaan_fisik_perawat" />
        <x-adminlte-textarea igroup-size="sm" rows=4 label="Pemeriksaan Fisik Dokter" name="pemeriksaan_fisik_dokter"
            wire:model="pemeriksaan_fisik_dokter" />
        <h6>Expertise Laboratorium, Radiologi, & Penunjang Lainnya</h6>
        <div class="row">
            <div class="col-md-4">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Hasil Pemeriksaan Laboratorium"
                    name="pemeriksaan_lab" wire:model="pemeriksaan_lab"></x-adminlte-textarea>
            </div>
            <div class="col-md-4">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Hasil Pemeriksaan Radiologi"
                    name="pemeriksaan_rad" wire:model="pemeriksaan_rad"></x-adminlte-textarea>
            </div>
            <div class="col-md-4">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Hasil Pemeriksaan Penunjang Lainnya"
                    name="pemeriksaan_penunjang" wire:model="pemeriksaan_penunjang"></x-adminlte-textarea>
            </div>
        </div>
        <h6>Assessment (A)</h6>
        <label>Diagnosa</label>
        @foreach ($diagnosa as $index => $diag)
            <div class="row" wire:key="diagnosa-field-{{ $index }}">
                <div class="col-md-6">
                    <x-adminlte-input wire:model="diagnosa.{{ $index }}" list="diagnosalist" name="diagnosa[]"
                        placeholder="Diagnosa" igroup-size="sm" />
                </div>
                <div class="col-md-6">
                    <button wire:click.prevent="removeDiagnosa({{ $index }})"
                        class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </div>
        @endforeach
        <div class="row" wire:key="diagnosa-field-{{ count($diagnosa) }}">
            <div class="col-md-6">
                <x-adminlte-input wire:model="diagnosa.{{ count($diagnosa) }}" list="diagnosalist" name="diagnosa[]"
                    placeholder="Diagnosa" igroup-size="sm" />
            </div>
            <div class="col-md-6">
                <button wire:click.prevent="addDiagnosa" class="btn btn-success btn-sm">Tambah</button>
            </div>
        </div>
        <datalist id="diagnosalist">
            @foreach ($diagnosas as $item)
                <option value="{{ $item }}"></option>
            @endforeach
        </datalist>
        <x-adminlte-input wire:model.live="icd1" list="icdlist" name="icd1" label="ICD-10 Primer"
            igroup-size="sm" />
        <label>ICD-10 Sekunder</label>
        @foreach ($icd2 as $index => $item)
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input wire:model.live="icd2.{{ $index }}" list="icdlist" name="icd2[]"
                        igroup-size="sm" placeholder="ICD-10 Sekunder" />
                </div>
                <div class="col-md-6">
                    <button wire:click.prevent="removeIcd2({{ $index }})"
                        class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </div>
        @endforeach
        <div class="row" wire:key="icd2-field-{{ count($icd2) }}">
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="icd2.{{ count($icd2) }}" list="icdlist" name="icd2[]"
                    igroup-size="sm" placeholder="ICD-10 Sekunder" />
            </div>
            <div class="col-md-6">
                <button wire:click.prevent="addIcd2" class="btn btn-success btn-sm">Tambah</button>
            </div>
        </div>
        <datalist id="icdlist">
            @foreach ($icd as $key => $item)
                <option value="{{ $item['nama'] }}"></option>
            @endforeach
        </datalist>
        <label>ICD-9 Procedure</label>
        @foreach ($icd9 as $index => $item)
            <div class="row" wire:key="icd9-field-{{ $index }}">
                <div class="col-md-6">
                    <x-adminlte-input wire:model.live="icd9.{{ $index }}" list="icd9list" name="icd9[]"
                        placeholder="ICD-9 Procedure" igroup-size="sm" />
                </div>
                <div class="col-md-6">
                    <button wire:click.prevent="removeIcd9({{ $index }})"
                        class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </div>
        @endforeach
        <div class="row" wire:key="icd9-field-{{ count($icd9) }}">
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="icd9.{{ count($icd9) }}" list="icd9list" name="icd9[]"
                    placeholder="ICD-9 Procedure" igroup-size="sm" />
            </div>
            <div class="col-md-6">
                <button wire:click.prevent="addIcd9" class="btn btn-success btn-sm">Tambah</button>
            </div>
        </div>
        <datalist id="icd9list">
            @foreach ($icd9s as $key => $item)
                <option value="{{ $item['nama'] }}"></option>
            @endforeach
        </datalist>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Diagnosa Dokter" name="diagnosa_dokter"
                    wire:model="diagnosa_dokter"></x-adminlte-textarea>
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Diagnosa Keperawatan" name="diagnosa_keperawatan"
                    wire:model="diagnosa_keperawatan"></x-adminlte-textarea>
            </div>
        </div>
        <h6>Planning (P)</h6>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Rencana Medis Dokter" name="rencana_medis"
                    wire:model="rencana_medis"></x-adminlte-textarea>
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Rencana Keperawatan" name="rencana_keperawatan"
                    wire:model="rencana_keperawatan"></x-adminlte-textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Tindakan Medis" name="tindakan_medis"
                    wire:model="tindakan_medis"></x-adminlte-textarea>
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Instruksi Medis" name="instruksi_medis"
                    wire:model="instruksi_medis"></x-adminlte-textarea>
            </div>
        </div>
        <h6>Resep Obat</h6>
        @foreach ($resepObat as $index => $obat)
            <div class="row">
                <div class="col-md-2">
                    @error('resepObat.' . $index . '.obat')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.obat" list="obatlist" name="obat[]"
                        igroup-size="sm" placeholder="Nama Obat" />
                    <datalist id="obatlist">
                        @foreach ($obats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    @error('resepObat.' . $index . '.jumlahobat')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlahobat" name="jumlahobat[]"
                        igroup-size="sm" type="number" placeholder="Jumlah Obat" />
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.frekuensiobat"
                        list="frekuensiobatlist" name="frekuensiobat[]" igroup-size="sm"
                        placeholder="Frekuensi Obat" />
                    <datalist id="frekuensiobatlist">
                        @foreach ($frekuensiObats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.waktuobat" list="waktuobatlist"
                        name="waktuobat[]" igroup-size="sm" placeholder="Waktu Obat" />
                    <datalist id="waktuobatlist">
                        @foreach ($waktuObats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan" name="keterangan[]"
                        igroup-size="sm" placeholder="Keterangan" />
                </div>
                <div class="col-md-2">
                    <button wire:click.prevent="removeObat({{ $index }})" class="btn btn-danger btn-sm">Hapus
                        Obat</button>
                </div>
            </div>
        @endforeach
        <button wire:click.prevent="addObat" class="btn btn-success btn-sm">Tambah Obat</button>
        {{-- <div class="row">
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Rencana Medis Dokter" name="rencana_medis"
                    wire:model="rencana_medis"></x-adminlte-textarea>
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Rencana Keperawatan" name="rencana_keperawatan"
                    wire:model="rencana_keperawatan"></x-adminlte-textarea>
            </div>
        </div> --}}
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="simpanAsesmen" wire:confirm='Apakah anda ingin menyimpan asesmen ini ?' />
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
            @if ($errors->any())
                <div class="text-danger">
                    Loading Result : {{ $errors->first() }}
                </div>
            @endif
        </x-slot>
    </x-adminlte-card>
</div>
