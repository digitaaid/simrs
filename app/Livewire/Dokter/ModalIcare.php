<?php

namespace App\Livewire\Dokter;

use App\Http\Controllers\IcareController;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ModalIcare extends Component
{
    public $nomorkartu, $kodedokter;
    public $icare = false;
    public function mount()
    {
        if (env('ICARE_JKN')) {
            $this->icare = true;
            $this->nomorkartu = '0001007012981';
            $this->kodedokter = '431997';
            $api = new IcareController();
            $request = new Request([
                'nomorkartu' => '0001007012981',
                'kodedokter' => '431997',
            ]);
            $res = $api->icare($request);
            if ($res->metadata->code == 200) {
                // flash($res->metadata->message, 'success');
            } else {
                flash($res->metadata->message, 'danger');
            }
        } else {
            $this->icare = false;
        }
    }
    public function render()
    {


        return view('livewire.dokter.modal-icare');
    }
}
