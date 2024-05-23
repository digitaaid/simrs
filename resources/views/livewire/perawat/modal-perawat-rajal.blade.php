<div>
    <x-adminlte-card theme="primary" title="Pemeriksaan Perawat">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <h6>Subjective (S) - Keluhan Utama & Riwayat Penyakit</h6>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-select name="sumber_data" label="Sumber Data" fgroup-class="row" label-class="text-left col-3"
                    igroup-size="sm" igroup-class="col-9">
                    <option>Pasien Sendiri / Autoanamase</option>
                    <option>Keluarga / Alloanamnesa</option>
                </x-adminlte-select>
                <x-adminlte-textarea igroup-size="sm" rows=5 label="Keluhan Utama" name="keluhan_utama" />
                <div class="row">
                    <div class="col-md-4"><b>Riwayat Pernah Berobat :</b></div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="pernahberobat1" name="pernah_berobat"
                                value="Iya">
                            <label for="pernahberobat1" class="custom-control-label">Iya</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="pernahberobat2" name="pernah_berobat"
                                value="Tidak">
                            <label for="pernahberobat2" class="custom-control-label">Tidak</label>
                        </div>
                    </div>
                </div>
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Pengobatan" name="riwayat_pengobatan" />
            </div>
            <div class="col-md-6">
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Penyakit Dahulu" name="riwayat_penyakit" />
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Penyakit Keluarga"
                    name="riwayat_penyakit_keluarga" />
                <x-adminlte-textarea igroup-size="sm" rows=3 label="Riwayat Alergi" name="riwayat_alergi" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h6>Asesmen Nyeri</h6>
                <img src="{{ asset('bekerwong.png') }}" width="100%">
                <div class="row">
                    <div class="col-md-3">
                        <label for="skala_nyeri">Skala Nyeri</label>
                    </div>
                    <div class="col-md-2">
                        <x-adminlte-input name="skala_nyeri" type="number" placeholder="Skala" />
                    </div>
                    <div class="col-md-7">
                        <x-adminlte-input name="keluhan_nyeri" placeholder="Keluhan Nyeri" />
                    </div>
                </div>
                <h6>Asesmen Glasgow Coma Scale (GCS)</h6>
                <div class="row">
                    <div class="col-md-5">
                        <label for="respon_buka_mata">Respon Membuka Mata</label>
                    </div>
                    <div class="col-md-7">
                        <x-adminlte-select name="respon_buka_mata">
                            <option value="4">Spontan</option>
                            <option value="3">Terhadap Rangsangan Suara</option>
                            <option value="2">Terhadap Nyeri</option>
                            <option value="1">Tidak Ada</option>
                        </x-adminlte-select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="respon_verbal">Respon Verbal</label>
                    </div>
                    <div class="col-md-7">
                        <x-adminlte-select name="respon_verbal">
                            <option value="5">
                                Orientasi Baik</option>
                            <option value="4">
                                Orientasi Terganggu</option>
                            <option value="3">
                                Kata-kata Tidak Jelas</option>
                            <option value="2">
                                Suara Tidak Jelas</option>
                            <option value="1">
                                Tidak Ada Respon</option>
                        </x-adminlte-select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="respon_motorik">Respon Motorik</label>
                    </div>
                    <div class="col-md-7">
                        <x-adminlte-select name="respon_motorik">
                            <option value="6">Mampu Bergerak</option>
                            <option value="5">Melokalisasi Nyeri</option>
                            <option value="4">Fleksi Mekanik</option>
                            <option value="3">Fleksi Abnormal</option>
                            <option value="2">Ekstensi</option>
                            <option value="1">Tidak Ada Respon</option>
                        </x-adminlte-select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Asesmen Resiko Jatuh</h6>
                <table class="table table-bordered table-sm">
                    <tr>
                        <th colspan="2" class="text-center">Assesmen Resiko Jatuh (Up And Go Test)</th>
                    </tr>
                    <tr>
                        <th>Faktor</th>
                        <th>Skala</th>
                    </tr>
                    <tr>
                        <td>a</td>
                        <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak tidak seimbang
                            (
                            sempoyongan / limbung ) ?</td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan
                            duduk ?</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-3">
                        <label for="resiko_jatuh">Resiko Jatuh</label>
                    </div>
                    <div class="col-md-9">
                        <x-adminlte-select name="resiko_jatuh">
                            <option value="Tidak Bersiko (tidak ditemukan a dan b)">Tidak Bersiko (tidak ditemukan a dan b)</option>
                            <option value="Resiko Rendah (ditemukan a atau b)">Resiko Rendah (ditemukan a atau b)</option>
                            <option value="Resiko Tinggi (ditemukan a dan b)">Resiko Tinggi (ditemukan a dan b)</option>
                        </x-adminlte-select>
                    </div>
                </div>
                <h6>Asesmen Status Fungsional</h6>
                <div class="row">
                    <div class="col-md-3">
                        <label for="alat_bantu">Alat Bantu</label>
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-select name="alat_bantu">
                            <option>Tidak Ada</option>
                            <option>Kursi Roda</option>
                            <option>Tongkat</option>
                            <option>Alat Bantu Pendengaran</option>
                            <option>Lain-lain</option>
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-5">
                        <x-adminlte-input name="alat_bantu_text" placeholder="Alat Bantu Lainnya" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="cacat_fisik">Cacat Fisik</label>
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-select name="cacat_fisik">
                            <option>Tidak Ada</option>
                            <option>Ada</option>
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-5">
                        <x-adminlte-input name="cacat_fisik_text" placeholder="Cacat Fisik Lainnya" />
                    </div>
                </div>
            </div>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="editAntrian" wire:confirm='Apakah anda yakin akan menyimpan data antrian ?' />
            <x-adminlte-button wire:click='modalPemeriksaanPerawat' theme="danger" class="btn-sm"
                icon="fas fa-times" label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
