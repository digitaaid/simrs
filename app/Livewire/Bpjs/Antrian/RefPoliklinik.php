<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Livewire\Component;

class RefPoliklinik extends Component
{
    public $polikliniks = [];
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text')->title('Referensi Poliklinik');
    }
    public function render()
    {
        $api = new AntrianController();
        $res  = $api->ref_poli();
        if ($res->metadata->code) {
            $this->polikliniks = $res->response;
        } else {
            flash($res->metadata->message, 'danger');
        }
        return view('livewire.bpjs.antrian.ref-poliklinik')->title('Referensi Poliklinik');
    }
}
