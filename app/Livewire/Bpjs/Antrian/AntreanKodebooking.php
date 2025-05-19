<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Livewire\Component;
use Illuminate\Http\Request;

class AntreanKodebooking extends Component
{
    public $antrian;
    public function mount($kodebooking)
    {
        $request = new Request([
            'kodebooking' => $kodebooking,
        ]);
        $this->antrian = [];
        $api = new AntrianController();
        $res  = $api->antrian_kodebooking($request);
        if ($res->metadata->code == 200) {
            $this->antrian = $res->response[0];
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.antrean-kodebooking')->title('Antrian Per Kodebooking');
    }
}
