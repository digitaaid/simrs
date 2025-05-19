<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Livewire\Component;
use Illuminate\Http\Request;

class AntreanTanggal extends Component
{
    public $tanggal,  $antrians = [], $taskid = [], $antrian = [];
    public $formAntrian = false;
    public function lihat($kodebooking)
    {
        $request = new Request([
            'kodebooking' => $kodebooking,
        ]);
        $this->formAntrian = true;
        $api = new AntrianController();
        $res  = $api->antrian_kodebooking($request);
        if ($res->metadata->code == 200) {
            $this->antrian = $res->response[0];
        } else {
            return flash($res->metadata->message, 'danger');
        }
        $res  = $api->taskid_antrean($request);
        if ($res->metadata->code == 200) {
            $this->taskid = $res->response;
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function form()
    {
        $this->formAntrian = $this->formAntrian ? false : true;
    }
    public function cari()
    {
        $this->validate([
            'tanggal' => 'required',
        ]);
        $request = new Request([
            'tanggal' => $this->tanggal,
        ]);
        $this->antrians = [];
        $api = new AntrianController();
        $res  = $api->antrian_tanggal($request);
        if ($res->metadata->code == 200) {
            $this->antrians = $res->response;
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        if ($this->tanggal) {
            $request = new Request([
                'tanggal' => $this->tanggal,
            ]);
            $this->antrians = [];
            $api = new AntrianController();
            $res  = $api->antrian_tanggal($request);
            if ($res->metadata->code == 200) {
                $this->antrians = $res->response;
            } else {
                flash($res->metadata->message, 'danger');
            }
        }
        return view('livewire.bpjs.antrian.antrean-tanggal')->title(
            'Antrian Per Tanggal'
        );
    }
}
