<div>
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
        <x-adminlte-input wire:model="diagnosa" list="diagnosalist" name="diagnosa" label="Diagnosa"
            igroup-size="sm" />
        <datalist id="diagnosalist">
            <option value="Diagnonsa Database"></option>
        </datalist>
        <x-adminlte-input wire:model="icd1" list="icd1list" name="icd1" label="ICD-10 Primer"
            igroup-size="sm" />
        <datalist id="icd1list">
            <option value="Diagnonsa ICD10 1"></option>
        </datalist>
        <x-adminlte-input wire:model="icd2" list="icd2list" name="icd2" label="ICD-10 Sekunder"
            igroup-size="sm" />
        <datalist id="icd2list">
            <option value="Diagnonsa ICD10 2"></option>
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
        @php
        @endphp
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="simpanAsesmen" wire:confirm='Apakah anda ingin menyimpan asesmen ini ?' />
            <x-adminlte-button wire:click='modalPemeriksaanDokter' theme="danger" class="btn-sm" icon="fas fa-times"
                label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
