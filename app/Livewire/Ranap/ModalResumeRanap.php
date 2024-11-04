<?php

namespace App\Livewire\Ranap;

use App\Models\Kunjungan;
use App\Models\ResumeRanap;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalResumeRanap extends Component
{
    public $kunjungan, $resume;
    protected $listeners = ['refreshPage' => '$refresh'];
    public $tgl_resume, $diagnosis_masuk, $anamnesis, $pemeriksaan_fisik, $alasan_dirawat, $pemeriksaan_penunjang, $diagnosis_primer, $diagnosis_sekunder, $tindakan_operasi, $pengobatan, $kondisi_pulang, $cara_pulang, $di_rujuk, $tgl_kontrol, $ttd_pasien, $ttd_dokter;
    public $dirujukke, $noSuratMeninggal, $riwayat_alergi;
    public function render()
    {
        return view('livewire.ranap.modal-resume-ranap');
    }
    public function mount(Kunjungan $kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->resume = $kunjungan->resume_ranap;
        $this->tgl_resume = $this->resume->tgl_resume ?? now()->format('Y-m-d');
        if ($this->resume) {
            $this->diagnosis_masuk = $this->resume->diagnosis_masuk;
            $this->anamnesis = $this->resume->anamnesis;
            $this->riwayat_alergi = $this->resume->riwayat_alergi;
            $this->pemeriksaan_fisik = $this->resume->pemeriksaan_fisik;
            $this->alasan_dirawat = $this->resume->alasan_dirawat;
            $this->pemeriksaan_penunjang = $this->resume->pemeriksaan_penunjang;
            $this->diagnosis_primer = $this->resume->diagnosis_primer;
            $this->diagnosis_sekunder = $this->resume->diagnosis_sekunder;
            $this->tindakan_operasi = $this->resume->tindakan_operasi;
            $this->pengobatan = $this->resume->pengobatan;
            $this->kondisi_pulang = $this->resume->kondisi_pulang;
            $this->cara_pulang = $this->resume->cara_pulang;
            $this->dirujukke = $this->resume->dirujukke;
            $this->noSuratMeninggal = $this->resume->noSuratMeninggal;
            $this->ttd_pasien = $this->resume->ttd_pasien;
            $this->ttd_dokter = $this->resume->ttd_dokter;
        }
    }
    public function simpan()
    {
        $this->validate([
            'tgl_resume' => 'required',
            'diagnosis_masuk' => 'required',
        ]);
        $resume =  ResumeRanap::updateOrCreate(
            [
                'kunjungan_id' => $this->kunjungan->id,
                'kodekunjungan' => $this->kunjungan->kode,
            ],
            [
                'norm' => $this->kunjungan->norm,
                'tgl_resume' => $this->tgl_resume,
                'diagnosis_masuk' => $this->diagnosis_masuk,
                'pemeriksaan_fisik' => $this->pemeriksaan_fisik,
                'alasan_dirawat' => $this->alasan_dirawat,
                'pemeriksaan_penunjang' => $this->pemeriksaan_penunjang,
                'diagnosis_primer' => $this->diagnosis_primer,
                'diagnosis_sekunder' => $this->diagnosis_sekunder,
                'tindakan_operasi' => $this->tindakan_operasi,
                'pengobatan' => $this->pengobatan,
                'kondisi_pulang' => $this->kondisi_pulang,
                'cara_pulang' => $this->cara_pulang,
                'dirujukke' => $this->dirujukke,
                'noSuratMeninggal' => $this->noSuratMeninggal,
                'tgl_kontrol' => $this->tgl_kontrol,
                'ttd_pasien' => $this->ttd_pasien,
                'ttd_dokter' => $this->ttd_dokter,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->dispatch('refreshPage');
        flash('Resume Rawat Inap Berhasil Disimpan', 'success');
    }
}
