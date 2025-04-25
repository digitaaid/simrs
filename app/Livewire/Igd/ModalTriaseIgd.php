<?php

namespace App\Livewire\Igd;

use App\Http\Controllers\VclaimController;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Pasien;
use App\Models\Unit;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalTriaseIgd extends Component
{
    public $kunjungan;
    public $asesmenigd;
    public $tgl_masuk, $transportasi, $rujukan_igd, $kondisi_datang, $nama_pengantar, $nohp_pengantar;
    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->tgl_masuk = $this->kunjungan->tgl_masuk;
        $this->asesmenigd =   $this->kunjungan->asesmenigd;
        if ($this->asesmenigd) {
            $this->transportasi = $this->asesmenigd->transportasi;
            $this->rujukan_igd = $this->asesmenigd->rujukan_igd;
            $this->kondisi_datang = $this->asesmenigd->kondisi_datang;
            $this->nama_pengantar = $this->asesmenigd->nama_pengantar;
            $this->nohp_pengantar = $this->asesmenigd->nohp_pengantar;
        }
    }
    public function render()
    {
        return view('livewire.igd.modal-triase-igd');
    }
    public function simpanTriase()
    {
        $this->validate([
            'tgl_masuk' => 'required',
            'transportasi' => 'required',
            'kondisi_datang' => 'required',
            'nama_pengantar' => 'required',
            'nohp_pengantar' => 'required',
        ]);
        if ($this->asesmenigd) {
            $this->asesmenigd->update([
                'tgl_masuk' => $this->tgl_masuk,
                'transportasi' => $this->transportasi,
                'rujukan_igd' => $this->rujukan_igd,
                'kondisi_datang' => $this->kondisi_datang,
                'nama_pengantar' => $this->nama_pengantar,
                'nohp_pengantar' => $this->nohp_pengantar,
                'triaseigd' => 1,
                'user_triaseigd' => auth()->user()->id,
                'time_triaseigd' => now(),
            ]);
        } else {
            $this->kunjungan->asesmenigd()->create([
                'kunjungan_id' => $this->kunjungan->id,
                'kodekunjungan' => $this->kunjungan->kode,
                'tgl_masuk' => $this->tgl_masuk,
                'transportasi' => $this->transportasi,
                'rujukan_igd' => $this->rujukan_igd,
                'kondisi_datang' => $this->kondisi_datang,
                'nama_pengantar' => $this->nama_pengantar,
                'nohp_pengantar' => $this->nohp_pengantar,
                'triaseigd' => 1,
                'user_triaseigd' => auth()->user()->id,
                'time_triaseigd' => now(),
            ]);
        }
        return flash("Data triase berhasil disimpan", 'success');
    }
}
