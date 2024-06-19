<?php

namespace App\Livewire\Rekammedis;

use App\Http\Controllers\AntrianController;
use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class RekamMedisRajal extends Component
{
    public $tanggalperiksa;
    public $antrians = [];
    public function syncantrian($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $api = new AntrianController();
        $request = new Request([
            "kodebooking" => $antrian->kodebooking,
            "taskid" =>  3,
            "waktu" => Carbon::parse($antrian->taskid3),
        ]);
        $res = $api->update_antrean($request);
        $request = new Request([
            "kodebooking" => $antrian->kodebooking,
            "taskid" =>  4,
            "waktu" => Carbon::parse($antrian->taskid4),
        ]);
        $res = $api->update_antrean($request);
        $request = new Request([
            "kodebooking" => $antrian->kodebooking,
            "taskid" =>  5,
            "waktu" => Carbon::parse($antrian->taskid5),
        ]);
        $res = $api->update_antrean($request);
        $request = new Request([
            "kodebooking" => $antrian->kodebooking,
            "taskid" =>  6,
            "waktu" => Carbon::parse($antrian->taskid6),
        ]);
        $res = $api->update_antrean($request);
        $request = new Request([
            "kodebooking" => $antrian->kodebooking,
            "taskid" =>  7,
            "waktu" => Carbon::parse($antrian->taskid7),
        ]);
        $res = $api->update_antrean($request);
        if ($res->metadata->code == 200) {
            $antrian->sync_antrian = 1;
            $antrian->user5 = auth()->user()->id;
            $antrian->save();
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function caritanggal()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
        ]);
        $this->tanggalperiksa = $this->tanggalperiksa;
    }
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa;
    }
    public function render()
    {
        if ($this->tanggalperiksa) {
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('taskid', '>=', 5)
                ->orderBy('taskid', 'asc')
                ->get();
        }
        return view('livewire.rekammedis.rekam-medis-rajal')->title('Rekam Medis Rajal');
    }
}
