<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalSep extends Component
{
    public $diagAwal;
    public $antrian;
    public $polikliniks = [], $dokters = [], $diagnosas = [];
    public function cariDiagnosa()
    {
        try {
            $this->validate([
                'diagAwal' => 'required',
            ]);
            if (strlen($this->diagAwal) >= 2) {
                $api = new VclaimController();
                $request = new Request([
                    'diagnosa' => $this->diagAwal,
                ]);
                $res = $api->ref_diagnosa($request);
                if ($res->metadata->code == 200) {
                    $this->diagnosas = [];
                    foreach ($res->response->diagnosa as $key => $value) {
                        $this->diagnosas[] = [
                            'no' => $key + 1,
                            'kode' => $value->kode,
                            'nama' => $value->nama,
                        ];
                    }
                    return flash($res->metadata->message, 'success');
                } else {
                    return flash($res->metadata->message, 'danger');
                }
            } else {
                return flash('Kode diagnosa minimal 3 karakter', 'danger');
            }
        } catch (\Throwable $th) {
            return flash($th->getMessage(), 'danger');
        }
    }
    public function modalSEP()
    {
        $this->dispatch('modalSEP');
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kodejkn');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-sep');
    }
}
