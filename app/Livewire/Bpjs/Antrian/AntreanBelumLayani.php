<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Illuminate\Http\Request;
use Livewire\Component;

class AntreanBelumLayani extends Component
{
    public $antrians = [], $taskid = [], $antrian = [];
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
    public function mount()
    {
        $api = new AntrianController();
        $request = new Request();
        $res  = $api->antrian_belum_dilayani($request);
        if ($res->metadata->code == 200) {
            $this->antrians = $res->response;
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.antrean-belum-layani')->title('Antrean Belum Layani');
    }
}
