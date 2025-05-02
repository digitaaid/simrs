<?php

namespace App\Livewire\Rajal;

use App\Http\Controllers\AntrianController;
use App\Models\Antrian;
use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\ResepFarmasi;
use App\Models\ResepFarmasiDetail;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\WaktuObat;
use Illuminate\Http\Request;
use Livewire\Component;


class FarmasiRajal extends Component
{
    public $tanggalperiksa;
    public $antrianresep;
    public $playAudio = false;
    public $antrians, $resepobats = [];
    public $resepEdit;
    public $formEdit = false;
    public $search = '';
    public $searchingObat = [], $obats = [];
    public $searchingFrekuensi = [], $frekuensis = [];
    public $searchingWaktu = [], $waktus = [];
    public $resepObatDokter = [
        [
            'id' => '',
            'obat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'harga' => '',
            'jumlahobat' => '',
            'keterangan' => '',
        ]
    ];
    public $resepObat = [
        [
            'id' => '',
            'obat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'harga' => '',
            'jumlahobat' => '',
            'keterangan' => '',
        ]
    ];
    public function panggilfarmasi($kode)
    {
        $antrian = Antrian::where('kodebooking', $kode)->first();
        if ($antrian) {
            $antrian->taskid = 7;
            $antrian->panggil = 0;
            $antrian->update();
            return flash('Panggilan farmasi atas nama pasien ' . $antrian->nama . ' saved successfully.', 'success');
        } else {
            return flash('Antrian tidak ditemukan', 'danger');
        }
    }
    public function selesai($kode)
    {
        $resepObat = ResepObat::where('kode', $kode)->first();
        $antrian = Antrian::where('kodebooking', $kode)->first();
        if ($antrian) {
            $now = now();
            $antrian->taskid = 7;
            $antrian->taskid7 = $now;
            $antrian->status = 1;
            $antrian->panggil = 0;
            $antrian->user4 = auth()->user()->id;
            $antrian->keterangan = "Pelayanan telah selesai";
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $antrian->kodebooking,
                    'waktu' => $now,
                    'taskid' => 7,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);

                if ($res->metadata->code != 200 && $res->metadata->message != "TaskId=7 sudah ada") {
                    return flash($res->metadata->message, 'danger');
                }
            }
            $antrian->update();
            $kunjungan = $antrian->kunjungan;
            $kunjungan->status = 2;
            $kunjungan->update();
        }
        $resepObat->status = 3;
        $resepObat->update();
        return flash('Pelayanan farmasi atas nama pasien ' . $resepObat->nama . ' telah selesai.', 'success');
    }
    public function simpanResep()
    {
        $this->validate([
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required',
            'resepObat.*.harga' => 'required|numeric',
        ]);
        $kunjungan = $this->resepEdit->kunjungan;
        $resep = ResepFarmasi::updateOrCreate([
            'kode' => $this->resepEdit->kode,
        ], [
            'antrian_id' => $kunjungan->id,
            'kunjungan_id' => $kunjungan->id,
            'kodebooking' => $kunjungan->kode,
            'kodekunjungan' => $kunjungan->kode,
            'counter' => $kunjungan->counter,
            'norm' => $kunjungan->norm,
            'nama' => $kunjungan->nama,
            'gender' => $kunjungan->gender,
            'tgl_lahir' => $kunjungan->tgl_lahir,
            'waktu' => now(),
            'user' => auth()->user()->id,
            'pic' => auth()->user()->name,
            'status' => '1',
        ]);
        $resepObatIds = collect($this->resepObat)->pluck('id')->filter()->toArray();
        $resep->resepfarmasidetails()->whereNotIn('id', $resepObatIds)->delete();
        if (count($this->resepObat)) {
            foreach ($this->resepObat as $key => $value) {
                $obat = Obat::where('nama', $this->resepObat[$key]['obat'])->first();
                $obatdetails = ResepFarmasiDetail::updateOrCreate([
                    'id' => $this->resepObat[$key]['id'],
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                ], [
                    'kunjungan_id' => $kunjungan->id,
                    'antrian_id' => $kunjungan->id,
                    'nama' => $this->resepObat[$key]['obat'],
                    'jaminan' => $kunjungan->jaminan,
                    'jumlah' => $this->resepObat[$key]['jumlahobat'],
                    'frekuensi' => $this->resepObat[$key]['frekuensiobat'],
                    'waktu' => $this->resepObat[$key]['waktuobat'],
                    'keterangan' => $this->resepObat[$key]['keterangan'],
                    'obat_id' => $obat->id ?? 0,
                    'harga' => $this->resepObat[$key]['harga'],
                    'subtotal' => $this->resepObat[$key]['harga'] * $this->resepObat[$key]['jumlahobat'],
                    'klasifikasi' => $obat->jenisobat ?? 'Obat',
                ]);
                FrekuensiObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['frekuensiobat'],
                ]);
                WaktuObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['waktuobat'],
                ]);
            }
        } else {
            $resep->resepfarmasidetails()->delete();
        }
        flash('Resep obat atas nama pasien ' . $kunjungan->nama . ' saved successfully.', 'success');
        $this->openformEdit();
    }
    public function pilihWaktu($item)
    {
        $index = array_search(true, $this->searchingWaktu, true);
        $this->resepObat[$index]['waktuobat'] = $item['nama'];
        $this->searchingWaktu[$index] = false;
    }
    public function cariWaktu($index)
    {
        $this->searchingWaktu[$index] = true;
        $query = $this->resepObat[$index]['waktuobat'] ?? '';
        try {
            $this->waktus = WaktuObat::where('nama', 'like', '%' . $query . '%')
                ->limit(20)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama,
                    ];
                })
                ->toArray();
            if (empty($this->waktus)) {
                $this->searchingWaktu[$index] = false;
            }
        } catch (\Throwable $th) {
            $this->waktus = [];
            $this->searchingWaktu[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function pilihFrekuensi($item)
    {
        $index = array_search(true, $this->searchingFrekuensi, true);
        $this->resepObat[$index]['frekuensiobat'] = $item['nama'];
        $this->searchingFrekuensi[$index] = false;
    }
    public function cariFrekuensi($index)
    {
        $this->searchingFrekuensi[$index] = true;
        $query = $this->resepObat[$index]['frekuensiobat'] ?? '';
        try {
            $this->frekuensis = FrekuensiObat::where('nama', 'like', '%' . $query . '%')
                ->limit(20)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama,
                    ];
                })
                ->toArray();
            if (empty($this->frekuensis)) {
                $this->searchingFrekuensi[$index] = false;
            }
        } catch (\Throwable $th) {
            $this->frekuensis = [];
            $this->searchingFrekuensi[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function pilihObat($item)
    {
        $obat = Obat::find($item['id']);
        $index = array_search(true, $this->searchingObat, true);
        if ($obat) {
            $this->resepObat[$index]['obat'] = $obat->nama;
            $this->resepObat[$index]['harga'] = $obat->harga_jual;
        }
        $this->searchingObat[$index] = false;
        $this->obats = [];
    }
    public function cariObat($index)
    {
        $this->searchingObat[$index] = true;
        $query = $this->resepObat[$index]['obat'] ?? '';
        try {
            $this->obats = Obat::where('nama', 'like', '%' . $query . '%')
                ->limit(20)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'satuan' => $item->satuan,
                        'merk' => $item->merk,
                        'harga' => $item->harga_jual,
                    ];
                })
                ->toArray();
            if (empty($this->obats)) {
                $this->searchingObat[$index] = false;
            }
        } catch (\Throwable $th) {
            $this->obats = [];
            $this->searchingObat[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function addObat()
    {
        $this->resepObat[] = [
            'id' => '',
            'obat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'harga' => '',
            'jumlahobat' => '',
            'keterangan' => '',
        ];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function openformEdit()
    {
        $this->formEdit = $this->formEdit ? false : true;
    }
    public function edit($kode)
    {
        $this->resepEdit = ResepObat::where('kode', $kode)->first();
        $this->formEdit = true;
        if (count($this->resepEdit->resepobatdetails)) {
            $this->resepObatDokter = [];
            foreach ($this->resepEdit->resepobatdetails as $key => $value) {
                $this->resepObatDokter[] = [
                    'id' => null,
                    'obat' => $value->nama,
                    'frekuensiobat' => $value->frekuensi,
                    'waktuobat' => $value->waktu,
                    'harga' =>  null,
                    'jumlahobat' => $value->jumlah,
                    'keterangan' =>  $value->keterangan,
                ];
            }
            $this->resepObat = [];
            foreach ($this->resepEdit->resepfarmasidetails as $key => $value) {
                $this->resepObat[] = [
                    'id' => $value->id,
                    'obat' => $value->nama,
                    'frekuensiobat' => $value->frekuensi,
                    'waktuobat' => $value->waktu,
                    'harga' =>  $value->harga,
                    'jumlahobat' => $value->jumlah,
                    'keterangan' =>  $value->keterangan,
                ];
            }
            if (count($this->resepObat) == 0) {
                $this->resepObat = $this->resepObatDokter;
            }
        }
    }
    public function terimaResep($kode)
    {
        $resepObat = ResepObat::where('kode', $kode)->first();
        $antrian = Antrian::where('kodebooking', $kode)->first();
        if ($antrian) {
            $now = now();
            $antrian->taskid = 6;
            $antrian->taskid6 = $now;
            $antrian->panggil = 0;
            $antrian->status = 1;
            $antrian->user4 = auth()->user()->id;
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $antrian->kodebooking,
                    'waktu' => $now,
                    'taskid' => 6,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);

                if ($res->metadata->code != 200 && $res->metadata->message != "TaskId=6 sudah ada") {
                    return flash($res->metadata->message, 'danger');
                }
            }
            $antrian->update();
        }
        $resepObat->status = 2;
        $resepObat->update();
        return flash('Resep obat atas nama pasien ' . $resepObat->nama . ' telah diterima farmasi.', 'success');
    }
    public function refreshComponent()
    {
        $this->antrianresep = ResepObat::where('status', 1)->first();
        if ($this->antrianresep) {
            $this->playAudio = true;
            $this->dispatch('play-audio');
        } else {
            $this->playAudio = false;
        }
    }
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa ?? now()->format('Y-m-d');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        if ($this->tanggalperiksa) {
            $this->resepobats = ResepObat::whereDate('waktu', $this->tanggalperiksa)
                ->with('kunjungan', 'kunjungan.jaminans')
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('norm', 'like', "%{$search}%");
                })
                ->orderBy('status')
                ->get();
        }
        return view('livewire.rajal.farmasi-rajal')->title('Farmasi Resep Obat');
    }
}
