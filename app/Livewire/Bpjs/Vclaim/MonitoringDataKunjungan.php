<?php

namespace App\Livewire\Bpjs\Vclaim;

use App\Http\Controllers\VclaimController;
use Illuminate\Http\Request;
use Livewire\Component;

class MonitoringDataKunjungan extends Component
{
    public $tanggal, $jenispelayanan;
    public $kunjungans = [];
    public function cari()
    {
        $this->validate([
            'tanggal' => 'required',
            'jenispelayanan' => 'required',
        ]);
        $request = new Request([
            'jenispelayanan' => $this->jenispelayanan,
            'tanggal' => $this->tanggal,
        ]);
        $this->kunjungans = [];
        $api = new VclaimController();
        $res  = $api->monitoring_data_kunjungan($request);
        if ($res->metadata->code == 200) {
            $this->kunjungans = $res->response->sep;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.vclaim.monitoring-data-kunjungan')->title(
            'Monitroing Kunjungan'
        );
    }
}
