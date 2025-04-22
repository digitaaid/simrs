<?php

namespace App\Livewire\Bpjs\Vclaim;

use App\Http\Controllers\VclaimController;
use Illuminate\Http\Request;
use Livewire\Component;

class Referensi extends Component
{
    public $searchingDiagnosa = false;
    public $searchingProcedure = false; // Menandai apakah pencarian procedure sedang berlangsung
    public $searchingFaskes = false; // Menandai apakah pencarian faskes sedang berlangsung
    public $searchingPoliklinik = false; // Menandai apakah pencarian poliklinik sedang berlangsung
    public $searchingDokter = false; // Menandai apakah pencarian dokter sedang berlangsung
    public $searchingProvinsi = false; // Menandai apakah pencarian provinsi sedang berlangsung
    public $searchingKabupaten = false; // Menandai apakah pencarian kabupaten sedang berlangsung
    public $searchingKecamatan = false; // Menandai apakah pencarian kecamatan sedang berlangsung

    public $diagnosa, $procedure, $poliklinik, $jenisfaskes, $faskes, $dokter, $tanggal, $jenispelayanan, $provinsi, $kabupaten, $kecamatan;
    public $diagnosas = [], $procedures = [], $polikliniks = [], $faskess = [], $dokters = [], $provinsis = [], $kabupatens = [], $kecamatans = [];
    public function updatedKecamatan()
    {
        $this->validate([
            'kabupaten' => 'required',
        ]);
        $this->searchingKecamatan = true; // Tandai bahwa pencarian kecamatan sedang berlangsung
        try {
            $api = new VclaimController();
            $request = new Request([
                'kodekabupaten' => $this->kabupaten,
            ]);
            $res = $api->ref_kecamatan($request);
            if ($res->metadata->code == 200) {
                $this->kecamatans = collect($res->response->list)
                    ->filter(function ($item) {
                        return stripos($item->nama, $this->kecamatan) !== false; // Pencarian case-insensitive
                    })
                    ->map(function ($item) {
                        return [
                            'kode' => $item->kode,
                            'nama' => $item->nama,
                        ];
                    })
                    ->values()
                    ->toArray();
            } else {
                $this->kecamatans = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->kecamatans = []; // Kosongkan jika tidak ada data
        }
    }
    public function updatedKabupaten()
    {
        $this->validate([
            'provinsi' => 'required',
        ]);
        $this->searchingKabupaten = true; // Tandai bahwa pencarian kabupaten sedang berlangsung
        try {
            $api = new VclaimController();
            $request = new Request([
                'kodeprovinsi' => $this->provinsi,
            ]);
            $res = $api->ref_kabupaten($request);
            if ($res->metadata->code == 200) {
                $this->kabupatens = collect($res->response->list)
                    ->filter(function ($item) {
                        return stripos($item->nama, $this->kabupaten) !== false; // Pencarian case-insensitive
                    })
                    ->map(function ($item) {
                        return [
                            'kode' => $item->kode,
                            'nama' => $item->nama,
                        ];
                    })
                    ->values()
                    ->toArray();
            } else {
                $this->kabupatens = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->kabupatens = []; // Kosongkan jika tidak ada data
        }
    }
    public function updatedProvinsi()
    {
        $this->searchingProvinsi = true; // Tandai bahwa pencarian provinsi sedang berlangsung
        try {
            $api = new VclaimController();
            $request = new Request([
                'provinsi' => $this->provinsi,
            ]);
            $res = $api->ref_provinsi($request);

            if ($res->metadata->code == 200 && !empty($res->response->list)) {
                // Filter hasil berdasarkan input pengguna
                $this->provinsis = collect($res->response->list)
                    ->filter(function ($item) {
                        return stripos($item->nama, $this->provinsi) !== false; // Pencarian case-insensitive
                    })
                    ->map(function ($item) {
                        return [
                            'kode' => $item->kode,
                            'nama' => $item->nama,
                        ];
                    })
                    ->values()
                    ->toArray();
            } else {
                $this->provinsis = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->provinsis = []; // Kosongkan jika terjadi error
        }
    }
    public function updatedDokter()
    {
        $this->validate([
            'dokter' => 'required|min:3',
            'poliklinik' => 'required|min:3',
            'jenispelayanan' => 'required',
            'tanggal' => 'required',
        ]);

        $this->searchingDokter = true; // Tandai bahwa pencarian dokter sedang berlangsung

        try {
            $api = new VclaimController();
            $request = new Request([
                'kodespesialis' => $this->poliklinik,
                'jenispelayanan' => $this->jenispelayanan,
                'tanggal' => $this->tanggal,
            ]);
            $res = $api->ref_dpjp($request);
            if ($res->metadata->code == 200 && !empty($res->response->list)) {
                $this->dokters = [];
                foreach ($res->response->list as $value) {
                    $this->dokters[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
            } else {
                $this->dokters = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->dokters = []; // Kosongkan jika terjadi error
        }
    }
    public function updatedFaskes()
    {
        $this->validate([
            'faskes' => 'required|min:3',
            'jenisfaskes' => 'required',
        ]);

        $this->searchingFaskes = true; // Tandai bahwa pencarian faskes sedang berlangsung

        try {
            $api = new VclaimController();
            $request = new Request([
                'nama' => $this->faskes,
                'jenisfaskes' => $this->jenisfaskes,
            ]);
            $res = $api->ref_faskes($request);
            if ($res->metadata->code == 200 && !empty($res->response->faskes)) {
                $this->faskess = [];
                foreach ($res->response->faskes as $value) {
                    $this->faskess[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
            } else {
                $this->faskess = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->faskess = []; // Kosongkan jika terjadi error
        }
    }
    public function updatedProcedure()
    {
        $this->validate([
            'procedure' => 'required|min:3',
        ]);

        $this->searchingProcedure = true; // Tandai bahwa pencarian procedure sedang berlangsung

        try {
            $api = new VclaimController();
            $request = new Request([
                'procedure' => $this->procedure,
            ]);
            $res = $api->ref_procedure($request);
            if ($res->metadata->code == 200 && !empty($res->response->procedure)) {
                $this->procedures = [];
                foreach ($res->response->procedure as $value) {
                    $this->procedures[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
            } else {
                $this->procedures = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->procedures = []; // Kosongkan jika terjadi error
        }
    }
    public function updatedDiagnosa()
    {
        $this->validate([
            'diagnosa' => 'required|min:3',
        ]);
        $this->searchingDiagnosa = true; // Tandai bahwa pencarian telah dilakukan
        try {
            $api = new VclaimController();
            $request = new Request([
                'diagnosa' => $this->diagnosa,
            ]);
            $res = $api->ref_diagnosa($request);
            if ($res->metadata->code == 200 && !empty($res->response->diagnosa)) {
                $this->diagnosas = [];
                foreach ($res->response->diagnosa as $value) {
                    $this->diagnosas[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
                return flash($res->metadata->message, 'success');
            } else {
                $this->diagnosas = []; // Kosongkan jika tidak ada data
                return flash('Data tidak ditemukan.', 'warning');
            }
        } catch (\Throwable $th) {
            $this->diagnosas = []; // Kosongkan jika terjadi error
            return flash($th->getMessage(), 'danger');
        }
    }
    public function updatedPoliklinik()
    {
        $this->validate([
            'poliklinik' => 'required|min:3',
        ]);

        $this->searchingPoliklinik = true; // Tandai bahwa pencarian poliklinik sedang berlangsung
        try {
            $api = new VclaimController();
            $request = new Request([
                'poliklinik' => $this->poliklinik,
            ]);
            $res = $api->ref_poliklinik($request);
            if ($res->metadata->code == 200 && !empty($res->response->poli)) {
                $this->polikliniks = [];
                foreach ($res->response->poli as $value) {
                    $this->polikliniks[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
            } else {
                $this->polikliniks = []; // Kosongkan jika tidak ada data
            }
        } catch (\Throwable $th) {
            $this->polikliniks = []; // Kosongkan jika terjadi error
        }
    }
    public function selectDiagnosa($item)
    {
        $this->diagnosa = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingDiagnosa = false; // Tandai bahwa pencarian telah dilakukan
        $this->diagnosas = []; // Kosongkan daftar setelah memilih
    }
    public function selectProcedure($item)
    {
        $this->procedure = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingProcedure = false; // Sembunyikan tabel setelah pemilihan
        $this->procedures = []; // Kosongkan daftar hasil pencarian
    }
    public function selectFaskes($item)
    {
        $this->faskes = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingFaskes = false; // Sembunyikan tabel setelah pemilihan
        $this->faskess = []; // Kosongkan daftar hasil pencarian
    }
    public function selectPoliklinik($item)
    {
        $this->poliklinik = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingPoliklinik = false; // Sembunyikan tabel setelah pemilihan
        $this->polikliniks = []; // Kosongkan daftar hasil pencarian
    }
    public function selectDokter($item)
    {
        $this->dokter = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingDokter = false; // Sembunyikan tabel setelah pemilihan
        $this->dokters = []; // Kosongkan daftar hasil pencarian
    }
    public function selectProvinsi($item)
    {
        $this->provinsi = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingProvinsi = false; // Sembunyikan tabel setelah pemilihan
        $this->provinsis = []; // Kosongkan daftar hasil pencarian
    }
    public function selectKabupaten($item)
    {
        $this->kabupaten = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingKabupaten = false; // Sembunyikan tabel setelah pemilihan
        $this->kabupatens = []; // Kosongkan daftar hasil pencarian
    }
    public function selectKecamatan($item)
    {
        $this->kecamatan = $item['kode']; // Atur format sesuai kebutuhan
        $this->searchingKecamatan = false; // Sembunyikan tabel setelah pemilihan
        $this->kecamatans = []; // Kosongkan daftar hasil pencarian
    }
    public function render()
    {
        return view('livewire.bpjs.vclaim.referensi');
    }
}
