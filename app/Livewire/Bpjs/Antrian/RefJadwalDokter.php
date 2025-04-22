<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Http\Controllers\AntrianController;
use Illuminate\Http\Request;
use Livewire\Component;

class RefJadwalDokter extends Component
{
    public $searchingPoliklinik = false;
    public $kodepoli, $tanggal;
    public $polikliniks = [];
    public $jadwals = [];
    public function cari()
    {
        $this->validate([
            'tanggal' => 'required',
            'kodepoli' => 'required',
        ]);
        $request = new Request([
            'kodepoli' => $this->kodepoli,
            'tanggal' => $this->tanggal,
        ]);
        $api = new AntrianController();
        $res  = $api->ref_jadwal_dokter($request);
        $this->jadwals = [];
        if ($res->metadata->code == 200) {
            $this->jadwals = $res->response;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function updatedKodepoli()
    {
        $this->validate([
            'kodepoli' => 'required|min:3',
        ]);
        $this->searchingPoliklinik = true; // Tandai bahwa pencarian poliklinik sedang berlangsung
        try {
            $api = new AntrianController();
            $res = $api->ref_poli();
            if ($res->metadata->code == 200 && !empty($res->response)) {
                $this->polikliniks = collect($res->response)
                    ->filter(function ($item) {
                        return stripos($item->nmsubspesialis, $this->kodepoli) !== false; // Pencarian case-insensitive
                    })
                    ->map(function ($item) {
                        return [
                            'kode' => $item->kdpoli,
                            'nama' => $item->nmsubspesialis,
                        ];
                    })
                    ->values()
                    ->toArray();
            } else {
                $this->polikliniks = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->polikliniks = []; // Kosongkan jika terjadi error
        }
    }
    public function selectPoliklinik($kodepoli)
    {
        $this->kodepoli = $kodepoli['kode'];
        $this->searchingPoliklinik = false; // Sembunyikan hasil pencarian
    }
    public function mount()
    {
        $api = new AntrianController();
        $res  = $api->ref_poli();
        if ($res->metadata->code) {
            $this->polikliniks = $res->response;
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.ref-jadwal-dokter')->title('Referensi Jadwal Dokter');
    }
}
