<?php

namespace App\Livewire\Dokter;

use App\Models\Antrian;
use App\Models\AsesmenRajal;
use App\Models\Kunjungan;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use Livewire\Component;

class ModalDokterRajal extends Component
{
    public $antrian, $kodebooking, $antrian_id, $kodekunjungan, $kunjungan_id;
    public $sumber_data, $keluhan_utama, $riwayat_pengobatan, $riwayat_penyakit, $riwayat_alergi, $pernah_berobat, $denyut_jantung, $pernapasan, $sistole, $distole, $suhu, $berat_badan, $tinggi_badan, $bsa, $pemeriksaan_fisik_perawat, $pemeriksaan_fisik_dokter, $pemeriksaan_lab, $pemeriksaan_rad, $pemeriksaan_penunjang, $diagnosa, $icd1, $icd2, $diagnosa_dokter, $diagnosa_keperawatan, $rencana_medis, $rencana_keperawatan, $tindakan_medis, $instruksi_medis;
    public $resepObat = [
        [
            'obat' => '',
            'jumlahobat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'keterangan' => '',
        ]
    ];
    public function addObat()
    {
        $this->resepObat[] = ['obat' => '', 'jumlahobat' => '', 'frekuensiobat' => '', 'waktuobat' => '', 'keterangan' => ''];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
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
            'pemeriksaan_fisik_perawat' => 'required',
            'pemeriksaan_fisik_dokter' => 'required',
            'pemeriksaan_lab' => 'required',
            'pemeriksaan_rad' => 'required',
            'pemeriksaan_penunjang' => 'required',
            'diagnosa' => 'required',
            'icd1' => 'required',
            'icd2' => 'required',
            'diagnosa_dokter' => 'required',
            'diagnosa_keperawatan' => 'required',
            'rencana_medis' => 'required',
            'rencana_keperawatan' => 'required',
            'tindakan_medis' => 'required',
            'instruksi_medis' => 'required',
            // resep obat
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required|numeric',
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
            'pemeriksaan_fisik_perawat' => $this->pemeriksaan_fisik_perawat,
            'pemeriksaan_fisik_dokter' => $this->pemeriksaan_fisik_dokter,
            'pemeriksaan_lab' => $this->pemeriksaan_lab,
            'pemeriksaan_rad' => $this->pemeriksaan_rad,
            'pemeriksaan_penunjang' => $this->pemeriksaan_penunjang,
            'diagnosa' => $this->diagnosa,
            'icd1' => $this->icd1,
            'icd2' => $this->icd2,
            'diagnosa_dokter' => $this->diagnosa_dokter,
            'diagnosa_keperawatan' => $this->diagnosa_keperawatan,
            'rencana_medis' => $this->rencana_medis,
            'rencana_keperawatan' => $this->rencana_keperawatan,
            'tindakan_medis' => $this->tindakan_medis,
            'instruksi_medis' => $this->instruksi_medis,
            // data asesmen
            'counter' => $kunjungan->counter,
            'norm' => $kunjungan->norm,
            'nama' => $kunjungan->nama,
            'tgl_lahir' => $kunjungan->tgl_lahir,
            'gender' => $kunjungan->gender,
            // asesmen dokter
            'waktu_asesmen_dokter' => now(),
            'status_asesmen_dokter' => '1',
            'user_dokter' => auth()->user()->id,
            'pic_dokter' => auth()->user()->name,
        ]);
        if (count($this->resepObat)) {
            $resep = ResepObat::updateOrCreate([
                'kodebooking' => $this->kodebooking,
                'antrian_id' => $this->antrian_id,
                'kodekunjungan' => $this->kodekunjungan,
                'kunjungan_id' => $this->kunjungan_id,
                'kode' => $kunjungan->kode,
            ], [
                'counter' => $kunjungan->counter,
                'norm' => $kunjungan->norm,
                'nama' => $kunjungan->nama,
                'tgl_lahir' => $kunjungan->tgl_lahir,
                'gender' => $kunjungan->gender,
                'berat_badan' => $this->berat_badan,
                'tinggi_badan' => $this->tinggi_badan,
                'bsa' => $this->bsa,
                // detail
                'waktu' => now(),
                'dokter' => $kunjungan->dokter,
                'namadokter' => $kunjungan->dokters->nama,
                'unit' => $kunjungan->unit,
                'namaunit' => $kunjungan->units->nama,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
                'status' => '1',
            ]);
            $resep->resepobatdetails()->each(function ($resepobatdetail) {
                $resepobatdetail->delete();
            });
            foreach ($this->resepObat as $key => $value) {
                $obatdetails = ResepObatDetail::updateOrCreate([
                    'kunjungan_id' => $this->kunjungan_id,
                    'antrian_id' => $this->antrian_id,
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                    'nama' => $this->resepObat[$key]['obat'],
                ], [
                    'jaminan' => $kunjungan->jaminan,
                    'jumlah' => $this->resepObat[$key]['jumlahobat'],
                    'frekuensi' => $this->resepObat[$key]['frekuensiobat'],
                    'waktu' => $this->resepObat[$key]['waktuobat'],
                    'keterangan' => $this->resepObat[$key]['keterangan'],
                ]);
            }
        }
        flash('Asesmen dokter saved successfully.', 'success');
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
        $this->pemeriksaan_fisik_perawat = $antrian->asesmenrajal?->pemeriksaan_fisik_perawat ?? $antrianlast?->asesmenrajal?->pemeriksaan_fisik_perawat;
        $this->pemeriksaan_fisik_dokter = $antrian->asesmenrajal?->pemeriksaan_fisik_dokter ?? $antrianlast?->asesmenrajal?->pemeriksaan_fisik_dokter;
        $this->pemeriksaan_lab = $antrian->asesmenrajal?->pemeriksaan_lab ?? $antrianlast?->asesmenrajal?->pemeriksaan_lab;
        $this->pemeriksaan_rad = $antrian->asesmenrajal?->pemeriksaan_rad ?? $antrianlast?->asesmenrajal?->pemeriksaan_rad;
        $this->pemeriksaan_penunjang = $antrian->asesmenrajal?->pemeriksaan_penunjang ?? $antrianlast?->asesmenrajal?->pemeriksaan_penunjang;
        $this->diagnosa = $antrian->asesmenrajal?->diagnosa ?? $antrianlast?->asesmenrajal?->diagnosa;
        $this->icd1 = $antrian->asesmenrajal?->icd1 ?? $antrianlast?->asesmenrajal?->icd1;
        $this->icd2 = $antrian->asesmenrajal?->icd2 ?? $antrianlast?->asesmenrajal?->icd2;
        $this->diagnosa_dokter = $antrian->asesmenrajal?->diagnosa_dokter ?? $antrianlast?->asesmenrajal?->diagnosa_dokter;
        $this->diagnosa_keperawatan = $antrian->asesmenrajal?->diagnosa_keperawatan ?? $antrianlast?->asesmenrajal?->diagnosa_keperawatan;
        $this->rencana_medis = $antrian->asesmenrajal?->rencana_medis ?? $antrianlast?->asesmenrajal?->rencana_medis;
        $this->rencana_keperawatan = $antrian->asesmenrajal?->rencana_keperawatan ?? $antrianlast?->asesmenrajal?->rencana_keperawatan;
        $this->tindakan_medis = $antrian->asesmenrajal?->tindakan_medis ?? $antrianlast?->asesmenrajal?->tindakan_medis;
        $this->instruksi_medis = $antrian->asesmenrajal?->instruksi_medis ?? $antrianlast?->asesmenrajal?->instruksi_medis;
        if (count($this->antrian->resepobatdetails)) {
            $this->resepObat = [];
            foreach ($this->antrian->resepobatdetails as $key => $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        } else if ($antrianlast) {
            $this->resepObat = [];
            foreach ($antrianlast->resepobatdetails as $key => $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        }
    }
    public function modalPemeriksaanDokter()
    {
        $this->dispatch('modalPemeriksaanDokter');
    }
    public function render()
    {
        return view('livewire.dokter.modal-dokter-rajal');
    }
}
