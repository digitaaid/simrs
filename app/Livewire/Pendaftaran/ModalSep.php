<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalSep extends Component
{
    public $diagAwal;
    public $antrian;
    public $polikliniks = [], $dokters = [], $diagnosas = [];
    public $nomorkartu, $tanggal, $seps = [], $form = false;
    public $asalRujukan, $rujukans = [], $suratkontrols = [];
    public function buatSEP()
    {
        dd($this->all());
        $this->validate([
            'asalRujukan' => 'required',
        ]);
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
        ]);
        if ($this->asalRujukan == 1) {
            $res = $api->rujukan_peserta($request);
        } else {
            $res = $api->rujukan_rs_peserta($request);
        }
        if ($res->metadata->code == 200) {
            $this->rujukans = [];
            foreach ($res->response->rujukan as $key => $value) {
                $this->rujukans[] = [
                    'no' => $key + 1,
                    'noKunjungan' => $value->noKunjungan,
                    'tglKunjungan' => $value->tglKunjungan,
                    'namaPoli' => $value->poliRujukan->nama,
                    'jenisPelayanan' => $value->pelayanan->nama,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariRujukan()
    {
        $this->validate([
            'asalRujukan' => 'required',
        ]);
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
        ]);
        if ($this->asalRujukan == 1) {
            $res = $api->rujukan_peserta($request);
        } else {
            $res = $api->rujukan_rs_peserta($request);
        }
        if ($res->metadata->code == 200) {
            $this->rujukans = [];
            foreach ($res->response->rujukan as $key => $value) {
                $this->rujukans[] = [
                    'no' => $key + 1,
                    'noKunjungan' => $value->noKunjungan,
                    'tglKunjungan' => $value->tglKunjungan,
                    'namaPoli' => $value->poliRujukan->nama,
                    'jenisPelayanan' => $value->pelayanan->nama,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariSuratKontrol()
    {
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
            "formatfilter" => 2,
            "bulan" => Carbon::parse($this->tanggalperiksa)->format('m'),
            "tahun" => Carbon::parse($this->tanggalperiksa)->format('Y'),
        ]);
        $res = $api->suratkontrol_peserta($request);
        if ($res->metadata->code == 200) {
            $this->suratkontrols = [];
            foreach ($res->response->list as $key => $value) {
                $this->suratkontrols[] = [
                    'no' => $key + 1,
                    'noSuratKontrol' => $value->noSuratKontrol,
                    'tglRencanaKontrol' => $value->tglRencanaKontrol,
                    'namaPoliTujuan' => $value->namaPoliTujuan,
                    'terbitSEP' => $value->terbitSEP,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariSEP()
    {
        $this->validate([
            'nomorkartu' => 'required',
        ]);
        $api = new VclaimController();
        $request = new Request([
            'nomorkartu' => $this->nomorkartu,
            'tanggalMulai' => now()->subDays(90)->format('Y-m-d'),
            'tanggalAkhir' => now()->format('Y-m-d'),
        ]);
        $res = $api->monitoring_pelayanan_peserta($request);
        if ($res->metadata->code == 200) {
            $this->seps = [];
            $this->seps = $res->response->histori;
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
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
    public function openForm()
    {
        $this->form = $this->form ?  false : true;
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->nomorkartu = $antrian->nomorkartu;
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kodejkn');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-sep');
    }
}
