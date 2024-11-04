<div>
    <x-adminlte-card theme="primary" title="Resume Rawat Inap" icon="fas fa-file-medical">
        <div class="row">
            <div class="col-md-12">
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Diagnosis Masuk" name="diagnosis_masuk"
                    wire:model="diagnosis_masuk" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Anamnesis" name="anamnesis" wire:model="anamnesis" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Riwayat Alergi" name="riwayat_alergi"
                    wire:model="riwayat_alergi" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Pemeriksaan Fisik" name="pemeriksaan_fisik"
                    wire:model="pemeriksaan_fisik" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Alasan Pasien Dirawat" name="alasan_dirawat"
                    wire:model="alasan_dirawat" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Pemeriksaan Penunjang" name="pemeriksaan_penunjang"
                    wire:model="pemeriksaan_penunjang" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Diagnosis Akhir" name="diagnosis_primer"
                    wire:model="diagnosis_primer" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Diagnosis Secunder" name="diagnosis_sekunder"
                    wire:model="diagnosis_sekunder" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Tindakan Operasi" name="tindakan_operasi"
                    wire:model="tindakan_operasi" />
                <x-adminlte-textarea igroup-size="sm" rows=4 label="Pengobatan" name="pengobatan"
                    wire:model="pengobatan" />
                <label>Kondisi Saat Pulang</label>
                <div class="form-group row">
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="sembuh" wire:model='kondisi_pulang'
                            value="Sembuh" name="kondisi_pulang">
                        <label for="sembuh" class="custom-control-label">Sembuh</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="membaik" wire:model='kondisi_pulang'
                            value="Membaik" name="kondisi_pulang">
                        <label for="membaik" class="custom-control-label">Membaik</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="belumsembuh" wire:model='kondisi_pulang'
                            value="Belum Sembuh" name="kondisi_pulang">
                        <label for="belumsembuh" class="custom-control-label">Belum Sembuh</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="meninggalkurang48"
                            wire:model='kondisi_pulang' value="Meninggal < 48 Jam" name="kondisi_pulang">
                        <label for="meninggalkurang48" class="custom-control-label">Meninggal < 48 Jam</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="meninggallebih48"
                            wire:model='kondisi_pulang' value="Meninggal > 48 Jam" name="kondisi_pulang">
                        <label for="meninggallebih48" class="custom-control-label">Meninggal > 48 Jam</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <x-adminlte-select name="cara_pulang" label="Cara Pulang" wire:model.live="cara_pulang"
                    fgroup-class="row" label-class="text-left col-4" igroup-size="sm" igroup-class="col-8">
                    <option value="">Pilih Cara Pulang</option>
                    <option value="1">Atas Persetujuan Dokter</option>
                    <option value="2">Di Rujuk</option>
                    <option value="3">Atas Permintaan Sendiri</option>
                    <option value="4">Meninggal</option>
                    <option value="5">Lain-lain</option>
                </x-adminlte-select>
            </div>
            <div class="col-md-6">
                @if ($cara_pulang == 2)
                    <x-adminlte-input wire:model="dirujukke" name="dirujukke" label="Di Rujuk Ke" fgroup-class="row"
                        label-class="text-left col-4" igroup-size="sm" igroup-class="col-8" />
                @endif
                @if ($cara_pulang == 4)
                    <x-adminlte-input wire:model="noSuratMeninggal" name="noSuratMeninggal"
                        label="No Surat Meninggal" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                        igroup-class="col-8" />
                @endif

            </div>
            <div class="col-md-12">
                <hr>
                <h6>Intruksi Pasca Ranap</h6>
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model="tgl_kontrol" name="tgl_kontrol" label="Tanggal Kontrol"
                    igroup-size="sm" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" type='datetime-local' />
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model="tgl_resume" name="tgl_resume" label="Tanggal Resume" igroup-size="sm"
                    fgroup-class="row" label-class="text-left col-4" igroup-size="sm" igroup-class="col-8"
                    type="date" />
                <x-adminlte-input wire:model="ttd_pasien" name="ttd_pasien" label="Tanda Tangan Pasien"
                    igroup-size="sm" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" />
                <x-adminlte-input wire:model="ttd_dokter" name="ttd_dokter" label="Tanda Tangan DPJP"
                    igroup-size="sm" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="simpan"
                wire:confirm='Apakah anda yakin akan menyimpan data diatas ?' />
            <a href="{{ route('print.resumeranap') }}?kode={{ $kunjungan->kode }}" target="_blank">
                <x-adminlte-button theme="primary" icon="fas fa-print" class="btn-sm" label="Print" />
            </a>
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
