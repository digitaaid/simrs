<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class RefPesertaFingerprint extends Component
{
    public $identitas, $noidentitas;
    public $nik, $nomorkartu, $tgllahir, $daftarfp;
    public function cari()
    {
        $api = new AntrianController();
        $request = new Request([
            'identitas' => $this->identitas,
            'noidentitas' => $this->noidentitas,
        ]);
        $this->reset(['nik', 'nomorkartu', 'tgllahir', 'daftarfp']);
        $res = $api->ref_pasien_fingerprint($request);
        // dd($res);
        if ($res->metadata->code == 200) {
            $this->nik = $res->response->nik ?? '-';
            $this->nomorkartu = $res->response->nomorkartu ?? '-';
            $this->tgllahir = Carbon::createFromTimestampMsUTC($res->response->tgllahir)
                ->setTimezone('Asia/Jakarta')
                ->format('Y-m-d') ?? '-';
            $this->daftarfp = $res->response->daftarfp ?? '-';
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.ref-peserta-fingerprint')->title('Peserta Fingerprint');
    }
}
