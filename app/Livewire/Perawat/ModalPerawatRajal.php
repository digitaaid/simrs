<?php

namespace App\Livewire\Perawat;

use App\Models\Antrian;
use App\Models\AsesmenRajal;
use App\Models\Kunjungan;
use Livewire\Component;

class ModalPerawatRajal extends Component
{
    public $antrian, $kodebooking, $antrian_id, $kodekunjungan, $kunjungan_id;
    public $sumber_data, $pernah_berobat, $keluhan_utama, $riwayat_pengobatan, $riwayat_penyakit, $riwayat_alergi, $denyut_jantung, $pernapasan, $sistole, $distole, $suhu, $berat_badan, $tinggi_badan, $bsa, $tingkat_kesadaran, $pemeriksaan_fisik_perawat, $pemeriksaan_lab, $pemeriksaan_rad, $pemeriksaan_penunjang, $diagnosa_keperawatan, $rencana_keperawatan, $tindakan_keperawatan, $evaluasi_keperawatan;
    public function simpanAsesmen()
    {
        $this->validate([
            'kodebooking' => 'required',
            'antrian_id' => 'required',
            'kodekunjungan' => 'required',
            'kunjungan_id' => 'required',
            // isi asesmen
            'sumber_data' => 'required',
            'pernah_berobat' => 'required',
            'keluhan_utama' => 'required',
            'riwayat_pengobatan' => 'required',
            'riwayat_penyakit' => 'required',
            'riwayat_alergi' => 'required',
            'denyut_jantung' => 'required',
            'pernapasan' => 'required',
            'sistole' => 'required',
            'distole' => 'required',
            'suhu' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
            'bsa' => 'required',
            'tingkat_kesadaran' => 'required',
        ]);
        // $antrian = Antrian::find($this->antrian_id);
        $kunjungan = Kunjungan::find($this->kunjungan_id);
        $asesmen = AsesmenRajal::updateOrCreate([
            'kodebooking' => $this->kodebooking,
            'antrian_id' => $this->antrian_id,
            'kodekunjungan' => $this->kodekunjungan,
            'kunjungan_id' => $this->kunjungan_id,
        ], [
            // isi asesmen
            'sumber_data' => $this->sumber_data,
            'pernah_berobat' => $this->pernah_berobat,
            'keluhan_utama' => $this->keluhan_utama,
            'riwayat_pengobatan' => $this->riwayat_pengobatan,
            'riwayat_penyakit' => $this->riwayat_penyakit,
            'riwayat_alergi' => $this->riwayat_alergi,
            'denyut_jantung' => $this->denyut_jantung,
            'pernapasan' => $this->pernapasan,
            'sistole' => $this->sistole,
            'distole' => $this->distole,
            'suhu' => $this->suhu,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'bsa' => $this->bsa,
            'tingkat_kesadaran' => $this->tingkat_kesadaran,
            'pemeriksaan_fisik_perawat' => $this->pemeriksaan_fisik_perawat,
            'pemeriksaan_lab' => $this->pemeriksaan_lab,
            'pemeriksaan_rad' => $this->pemeriksaan_rad,
            'pemeriksaan_penunjang' => $this->pemeriksaan_penunjang,
            'diagnosa_keperawatan' => $this->diagnosa_keperawatan,
            'rencana_keperawatan' => $this->rencana_keperawatan,
            'tindakan_keperawatan' => $this->tindakan_keperawatan,
            'evaluasi_keperawatan' => $this->evaluasi_keperawatan,
            // data asesmen
            'counter' => $kunjungan->counter,
            'norm' => $kunjungan->norm,
            'nama' => $kunjungan->nama,
            'tgl_lahir' => $kunjungan->tgl_lahir,
            'gender' => $kunjungan->gender,
            // asesmen perawat
            'waktu_asesmen_perawat' => now(),
            'status_asesmen_perawat' => '1',
            'user_perawat' => auth()->user()->id,
            'pic_perawat' => auth()->user()->name,
        ]);
        flash('Asesmen perawat saved successfully.', 'success');
        $this->dispatch('refreshPage');
    }
    function calculateBsa()
    {
        $bb = $this->berat_badan ? $this->berat_badan : 0;
        $tb = $this->tinggi_badan ? $this->tinggi_badan : 0;
        $bsa = ($bb * $tb / 3600);
        $this->bsa = number_format($bsa, 2);
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->kodebooking = $antrian->kodebooking;
        $this->antrian_id = $antrian->id;
        $this->kodekunjungan = $antrian->kunjungan->kode;
        $this->kunjungan_id = $antrian->kunjungan->id;
        $antrianlast = Antrian::where('norm', $this->antrian->norm)
            ->where('id', '<', $this->antrian->id)
            ->orderBy('id', 'desc')
            ->first();
        $this->sumber_data = $antrian->asesmenrajal?->sumber_data ?? $antrianlast?->asesmenrajal?->sumber_data;
        $this->pernah_berobat = $antrian->asesmenrajal?->pernah_berobat ?? $antrianlast?->asesmenrajal?->pernah_berobat;
        $this->keluhan_utama = $antrian->asesmenrajal?->keluhan_utama ?? $antrianlast?->asesmenrajal?->keluhan_utama;
        $this->riwayat_pengobatan = $antrian->asesmenrajal?->riwayat_pengobatan ?? $antrianlast?->asesmenrajal?->riwayat_pengobatan;
        $this->riwayat_penyakit = $antrian->asesmenrajal?->riwayat_penyakit ?? $antrianlast?->asesmenrajal?->riwayat_penyakit;
        $this->riwayat_alergi = $antrian->asesmenrajal?->riwayat_alergi ?? $antrianlast?->asesmenrajal?->riwayat_alergi;
        $this->denyut_jantung = $antrian->asesmenrajal?->denyut_jantung ?? $antrianlast?->asesmenrajal?->denyut_jantung;
        $this->pernapasan = $antrian->asesmenrajal?->pernapasan ?? $antrianlast?->asesmenrajal?->pernapasan;
        $this->sistole = $antrian->asesmenrajal?->sistole ?? $antrianlast?->asesmenrajal?->sistole;
        $this->distole = $antrian->asesmenrajal?->distole ?? $antrianlast?->asesmenrajal?->distole;
        $this->suhu = $antrian->asesmenrajal?->suhu ?? $antrianlast?->asesmenrajal?->suhu;
        $this->berat_badan = $antrian->asesmenrajal?->berat_badan ?? $antrianlast?->asesmenrajal?->berat_badan;
        $this->tinggi_badan = $antrian->asesmenrajal?->tinggi_badan ?? $antrianlast?->asesmenrajal?->tinggi_badan;
        $this->bsa = $antrian->asesmenrajal?->bsa ?? $antrianlast?->asesmenrajal?->bsa;
        $this->tingkat_kesadaran = $antrian->asesmenrajal?->tingkat_kesadaran ?? $antrianlast?->asesmenrajal?->tingkat_kesadaran;
        $this->pemeriksaan_fisik_perawat = $antrian->asesmenrajal?->pemeriksaan_fisik_perawat ?? $antrianlast?->asesmenrajal?->pemeriksaan_fisik_perawat;
        $this->pemeriksaan_lab = $antrian->asesmenrajal?->pemeriksaan_lab ?? $antrianlast?->asesmenrajal?->pemeriksaan_lab;
        $this->pemeriksaan_rad = $antrian->asesmenrajal?->pemeriksaan_rad ?? $antrianlast?->asesmenrajal?->pemeriksaan_rad;
        $this->pemeriksaan_penunjang = $antrian->asesmenrajal?->pemeriksaan_penunjang ?? $antrianlast?->asesmenrajal?->pemeriksaan_penunjang;
        $this->diagnosa_keperawatan = $antrian->asesmenrajal?->diagnosa_keperawatan ?? $antrianlast?->asesmenrajal?->diagnosa_keperawatan;
        $this->rencana_keperawatan = $antrian->asesmenrajal?->rencana_keperawatan ?? $antrianlast?->asesmenrajal?->rencana_keperawatan;
        $this->tindakan_keperawatan = $antrian->asesmenrajal?->tindakan_keperawatan ?? $antrianlast?->asesmenrajal?->tindakan_keperawatan;
        $this->evaluasi_keperawatan = $antrian->asesmenrajal?->evaluasi_keperawatan ?? $antrianlast?->asesmenrajal?->evaluasi_keperawatan;
    }
    public function modalPemeriksaanPerawat()
    {
        $this->dispatch('modalPemeriksaanPerawat');
    }
    public function render()
    {
        return view('livewire.perawat.modal-perawat-rajal');
    }
}
