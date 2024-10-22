<div>
    <x-adminlte-card theme="primary" title="Catatan Perkembangan Pasien Terintegrasi">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($kunjungans)
            <div class="table-responsive">
                <table class="table table-sm table-bordered  table-xl mb-2">
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
                                    Masuk : {{ \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d/m/Y h:i') }} <br>
                                    Kunjungan : {{ $kunjungan->kode }}
                                    @switch($kunjungan->status)
                                        @case(1)
                                            <span class="badge badge-warning">Aktif</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-success">Selesai</span>
                                        @break

                                        @case(99)
                                            <span class="badge badge-danger">Batal</span>
                                        @break

                                        @default
                                            <span class="badge badge-secondary">{{ $kunjungan->status }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($kunjungan->asesmenrajal?->keluhan_utama)
                                        <b>Keluhan :</b> {{ $kunjungan->asesmenrajal?->keluhan_utama }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->riwayat_pengobatan)
                                        <b>Rwyat Pengobatan :</b> {{ $kunjungan->asesmenrajal?->riwayat_pengobatan }}
                                        <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->riwayat_penyakit)
                                        <b>Rwyat Penyakit :</b> {{ $kunjungan->asesmenrajal?->riwayat_penyakit }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->riwayat_alergi)
                                        <b>Rwyat Alergi :</b> {{ $kunjungan->asesmenrajal?->riwayat_alergi }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->denyut_jantung)
                                        <b>dj:</b> {{ $kunjungan->asesmenrajal?->denyut_jantung }} bpm,
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->pernapasan)
                                        <b>rr:</b> {{ $kunjungan->asesmenrajal?->pernapasan }} spm, <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->sistole && $kunjungan->asesmenrajal?->distole)
                                        <b>td:</b>
                                        {{ $kunjungan->asesmenrajal?->sistole }}/{{ $kunjungan->asesmenrajal?->distole }}
                                        mmHG,
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->suhu)
                                        <b>suhu:</b> {{ $kunjungan->asesmenrajal?->suhu }} C, <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->berat_badan)
                                        <b>bb:</b> {{ $kunjungan->asesmenrajal?->berat_badan }} kg,
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->tinggi_badan)
                                        <b>tb:</b> {{ $kunjungan->asesmenrajal?->tinggi_badan }} cm,
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->bsa)
                                        <b>bsa:</b> {{ $kunjungan->asesmenrajal?->bsa }} m2<br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->tingkat_kesadaran)
                                        <b>Kesadaran :</b> {{ $kunjungan->asesmenrajal?->tingkat_kesadaran }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->pemeriksaan_fisik_perawat)
                                        <b>Pemeriksaan Fisik :</b>
                                        {{ $kunjungan->asesmenrajal?->pemeriksaan_fisik_perawat }}
                                        <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->diagnosa_keperawatan)
                                        <b>Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa_keperawatan }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->rencana_keperawatan)
                                        <b>Rencana :</b> {{ $kunjungan->asesmenrajal?->rencana_keperawatan }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->tindakan_keperawatan)
                                        <b>Tindakan :</b> {{ $kunjungan->asesmenrajal?->tindakan_keperawatan }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->evaluasi_keperawatan)
                                        <b>Evaluasi :</b> {{ $kunjungan->asesmenrajal?->evaluasi_keperawatan }} <br>
                                    @endif
                                    {{ $kunjungan->asesmenrajal?->pic_perawat }} <br>
                                    {{ $kunjungan->asesmenrajal?->waktu_asesmen_perawat }} <br>
                                </td>
                                <td>
                                    @if ($kunjungan->asesmenrajal?->pemeriksaan_fisik_dokter)
                                        <b>Pemeriksaan Fisik :</b>
                                        {{ $kunjungan->asesmenrajal?->pemeriksaan_fisik_dokter }}
                                        <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->diagnosa)
                                        <b>Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->icd1)
                                        <b>ICD10 Primer :</b> {{ $kunjungan->asesmenrajal?->icd1 }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->icd2)
                                        <b>ICD10 Second :</b> {{ $kunjungan->asesmenrajal?->icd2 }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->icd9)
                                        <b>ICD9 Procedure :</b> {{ $kunjungan->asesmenrajal?->icd9 }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->diagnosa_dokter)
                                        <b>Catatan Diagnosa :</b> {{ $kunjungan->asesmenrajal?->diagnosa_dokter }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->rencana_medis)
                                        <b>Rencana :</b> {{ $kunjungan->asesmenrajal?->rencana_medis }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->tindakan_medis)
                                        <b>Tindakan :</b> {{ $kunjungan->asesmenrajal?->tindakan_medis }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->instruksi_medis)
                                        <b>Instruksi :</b> {{ $kunjungan->asesmenrajal?->instruksi_medis }} <br>
                                    @endif
                                    @if (count($kunjungan->resepobatdetails))
                                        <br>
                                        <b>Resep Obat :</b> {{ $kunjungan->resepobat?->kode }} <br>
                                        @foreach ($kunjungan->resepobatdetails as $item)
                                            <b>Rx {{ $item->nama }}</b> ({{ $item->jumlah }})
                                            {{ $item->frekuensi }}
                                            {{ $item->waktu }} {{ $item->keterangan }}<br>
                                        @endforeach
                                    @endif
                                    {{ $kunjungan->asesmenrajal?->pic_dokter }} <br>
                                    {{ $kunjungan->asesmenrajal?->waktu_asesmen_dokter }}
                                </td>
                                <td>
                                    @if ($kunjungan->asesmenrajal?->pemeriksaan_lab)
                                        <b>Laboratorium :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_lab }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->pemeriksaan_rad)
                                        <b>Radiologi :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_rad }} <br>
                                    @endif
                                    @if ($kunjungan->asesmenrajal?->pemeriksaan_penunjang)
                                        <b>Penunjang :</b> {{ $kunjungan->asesmenrajal?->pemeriksaan_penunjang }} <br>
                                    @endif
                                </td>
                                <td>
                                    @if (count($kunjungan->resepfarmasidetails))
                                        <b>Resep Obat :</b> {{ $kunjungan->resepobat?->kode }} <br>
                                        @foreach ($kunjungan->resepfarmasidetails as $item)
                                            <b>Rx {{ $item->nama }}</b> ({{ $item->jumlah }})
                                            {{ $item->frekuensi }}
                                            {{ $item->waktu }} {{ $item->keterangan }}<br>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $kunjungans->links() }}
        @endif
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
