<?php

namespace App\Livewire\Igd;

use App\Http\Controllers\VclaimController;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalPemulanganIgd extends Component
{
    public $kunjungan;
    public $status_pulang = "", $kode, $counter, $noSep, $tgl_masuk, $tgl_pulang, $noLPManual, $tgl_meninggal, $noSuratMeninggal;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function render()
    {
        return view('livewire.igd.modal-pemulangan-igd');
    }
    public function mount(Kunjungan $kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->kode = $kunjungan->kode;
        $this->counter = $kunjungan->counter;
        $this->noSep = $kunjungan->sep;
        $this->tgl_masuk = $kunjungan->tgl_masuk;
        $this->tgl_pulang = $kunjungan->tgl_pulang;
    }
    public function editKunjungan()
    {
        $now =  now();
        $this->validate([
            'tgl_pulang' => 'required',
            'status_pulang' => 'required',
        ]);
        if ($this->noSep) {
            $api = new VclaimController();
            $request = new Request([
                'noSep' => $this->noSep,
                'statusPulang' => $this->status_pulang,
                'tglPulang' => Carbon::parse($this->tgl_pulang)->format('Y-m-d'),
                'user' => auth()->user()->name,
                // jika meninggal dan kecelakaan
                'tglMeninggal' => $this->tgl_meninggal,
                'noSuratMeninggal' => $this->noSuratMeninggal,
                'noLPManual' => $this->noLPManual,
            ]);
            $res = $api->sep_update_tanggal_pulang($request);
            if ($res->metadata->code != 200) {
                return flash($res->metadata->message, 'success');
            }
        }
        $this->kunjungan->update([
            'tgl_pulang' => $this->tgl_pulang,
            'tgl_pulang' => $this->tgl_pulang,
            'status_pulang' => $this->status_pulang,
            'tgl_meninggal' => $this->tgl_meninggal,
            'noSuratMeninggal' => $this->noSuratMeninggal,
            'noLPManual' => $this->noLPManual,
            'user2' => auth()->user()->id,
            'status' => 2,
            'keterangan' => "Pasien sudah dipulangkan pada " . $now,
        ]);
        // $this->dispatch('refreshPage');
        Alert::success('Success', 'Kunjungan berhasil disimpan');
        $url = route('pendaftaran.igd.proses') . "?kode=" . $this->kunjungan->kode;
        redirect()->to($url);
        return flash("Berhasil Pemulangan Pasien", 'success');
    }
}
