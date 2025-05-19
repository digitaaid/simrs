<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Illuminate\Http\Request;
use Livewire\Component;

class DashboardTanggal extends Component
{

    public $tanggal, $waktu,  $antrians = [];
    public function cari()
    {
        $this->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
        ]);
        $request = new Request([
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
        ]);
        $this->antrians = [];
        $api = new AntrianController();
        $res  = $api->dashboard_tanggal($request);
        if ($res->metadata->code == 200) {
            $this->antrians = $res->response->list;
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.dashboard-tanggal')->title(
            'Dashboard Tanggal Antrian'
        );
    }
}
