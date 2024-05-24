<div>
    <x-adminlte-card theme="primary" title="Catatan Perkembangan Pasien Terintegrasi">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <table class="table table-bordered table-sm mb-2">
            <thead>
                <tr>
                    <th>Kunjungan</th>
                    <th>Perawat</th>
                    <th>Dokter</th>
                    <th>Penunjang</th>
                    <th>Farmasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>
                            {{ $kunjungan->units->nama }} <br>
                            {{ $kunjungan->dokters->nama }} <br>
                            Masuk : {{ \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d/m/Y h:i') }}
                        </td>
                        <td>
                            <b>Keluhan :</b> {{ $kunjungan->asesmenrajal?->keluhan_utama }} <br>
                            <b>Rwyat Pengobatan :</b> {{ $kunjungan->asesmenrajal?->riwayat_pengobatan }} <br>
                            <b>Rwyat Penyakit :</b> {{ $kunjungan->asesmenrajal?->riwayat_penyakit }} <br>
                            <b>Rwyat Alergi :</b> {{ $kunjungan->asesmenrajal?->riwayat_alergi }} <br>
                            <b>dj:</b> {{ $kunjungan->asesmenrajal?->denyut_jantung }} bpm,
                            <b>rr:</b> {{ $kunjungan->asesmenrajal?->pernapasan }} spm, <br>
                            <b>td:</b>
                            {{ $kunjungan->asesmenrajal?->sistole }}/{{ $kunjungan->asesmenrajal?->distole }} mmHG,
                            <b>suhu:</b> {{ $kunjungan->asesmenrajal?->suhu }} C, <br>
                            <b>bb:</b> {{ $kunjungan->asesmenrajal?->berat_badan }} kg,
                            <b>tb:</b> {{ $kunjungan->asesmenrajal?->tinggi_badan }} cm,
                            <b>bsa:</b> {{ $kunjungan->asesmenrajal?->bsa }} m2<br>
                            <b>Kesadaran :</b> {{ $kunjungan->asesmenrajal?->tingkat_kesadaran }} <br>
                            <b>Pemeriksaan Fisik :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_fisik_perawat }} <br>
                            <b>Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa_keperawatan }} <br>
                            <b>Rencana :</b> {{ $kunjungan->asesmenrajal?->rencana_keperawatan }} <br>
                            <b>Tindakan :</b> {{ $kunjungan->asesmenrajal?->tindakan_keperawatan }} <br>
                            <b>Evaluasi :</b> {{ $kunjungan->asesmenrajal?->evaluasi_keperawatan }} <br>
                            {{ $kunjungan->asesmenrajal?->pic_perawat }} <br>
                            {{ $kunjungan->asesmenrajal?->waktu_asesmen_perawat }} <br>
                        </td>
                        <td>
                            <b>Pemeriksaan Fisik :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_fisik_dokter }} <br>
                            <b>Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa }} <br>
                            <b>ICD10 Primer :</b> {{ $kunjungan->asesmenrajal?->icd1 }} <br>
                            <b>ICD10 Second :</b> {{ $kunjungan->asesmenrajal?->icd2 }} <br>
                            <b>Catatan Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa_dokter }} <br>
                            <b>Rencana :</b> {{ $kunjungan->asesmenrajal?->rencana_medis }} <br>
                            <b>Tindakan :</b> {{ $kunjungan->asesmenrajal?->tindakan_medis }} <br>
                            <b>Instruksi :</b> {{ $kunjungan->asesmenrajal?->instruksi_medis }} <br>
                            {{ $kunjungan->asesmenrajal?->pic_dokter }}
                            {{ $kunjungan->asesmenrajal?->waktu_asesmen_dokter }}
                        </td>
                        <td>
                            <b>Laboratorium :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_lab }} <br>
                            <b>Radiologi :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_rad }} <br>
                            <b>Penunjang :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_penunjang }} <br>
                        </td>
                        <td>
                            @foreach ($kunjungan->resepobatdetails as $item)
                                <b>Rx {{ $item->nama }}</b> ({{ $item->jumlah }}) {{ $item->frekuensi }}
                                {{ $item->waktu }} {{ $item->keterangan }}<br>
                            @endforeach
                            <b>Kode :</b> {{ $kunjungan->resepobat?->kode }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kunjungans->links() }}
        <x-slot name="footerSlot">
            <x-adminlte-button wire:click='modalCppt' theme="danger" class="btn-sm" icon="fas fa-times" label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
