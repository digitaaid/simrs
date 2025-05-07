<?php

namespace App\Livewire\Rajal;

use App\Http\Controllers\AntrianController;
use App\Models\Antrian;
use App\Models\frekuensi;
use App\Models\FrekuensiObat;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\ResepFarmasi;
use App\Models\ResepFarmasiDetail;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\waktu;
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
            'nama' => '',
            'frekuensi' => '',
            'waktu' => '',
            'harga' => '',
            'jumlah' => '',
            'keterangan' => '',
        ]
    ];
    public $resepObat = [
        [
            'id' => '',
            'nama' => '',
            'frekuensi' => '',
            'waktu' => '',
            'harga' => '',
            'jumlah' => '',
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
        $resepObat->status = 3;
        $resepObat->update();

        $antrian = Antrian::where('kodebooking', $kode)->first();
        if ($antrian) {
            $now = now();
            $antrian->taskid = 7;
            $antrian->taskid7 = $now;
            $antrian->status = 1;
            $antrian->panggil = 0;
            $antrian->user4 = auth()->user()->id;
            $antrian->keterangan = "Pelayanan telah selesai";
            $antrian->update();
            $kunjungan = $antrian->kunjungan;
            $kunjungan->status = 2;
            $kunjungan->update();
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
        }
        return flash('Pelayanan farmasi atas nama pasien ' . $resepObat->nama . ' telah selesai.', 'success');
    }
    public function simpan()
    {
        $this->validate([
            'resepObat.*.nama' => 'required',
            'resepObat.*.jumlah' => 'required',
            'resepObat.*.harga' => 'required|numeric',
        ]);
        $kunjungan = $this->resepEdit->kunjungan;
        $resep = ResepFarmasi::updateOrCreate([
            'kode' => $kunjungan->kode,
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
                $obat = Obat::where('nama', $this->resepObat[$key]['nama'])->first();
                $obatdetails = ResepFarmasiDetail::updateOrCreate([
                    'id' => $this->resepObat[$key]['id'],
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                ], [
                    'kunjungan_id' => $kunjungan->id,
                    'antrian_id' => $kunjungan->id,
                    'nama' => $this->resepObat[$key]['nama'],
                    'jaminan' => $kunjungan->jaminan,
                    'jumlah' => $this->resepObat[$key]['jumlah'],
                    'frekuensi' => $this->resepObat[$key]['frekuensi'],
                    'waktu' => $this->resepObat[$key]['waktu'],
                    'keterangan' => $this->resepObat[$key]['keterangan'],
                    'obat_id' => $obat->id ?? 0,
                    'harga' =>  $this->resepObat[$key]['harga'],
                    'subtotal' => $this->resepObat[$key]['harga'] * $this->resepObat[$key]['jumlah'],
                    'klasifikasi' => $obat->jenisobat ?? 'Obat',
                ]);
                if ($this->resepObat[$key]['frekuensi']) {
                    FrekuensiObat::updateOrCreate([
                        'nama' => $this->resepObat[$key]['frekuensi'],
                    ]);
                }
                if ($this->resepObat[$key]['waktu']) {
                    WaktuObat::updateOrCreate([
                        'nama' => $this->resepObat[$key]['waktu'],
                    ]);
                }
            }
        } else {
            $resep->resepfarmasidetails()->delete();
        }
        flash('Resep obat atas nama pasien ' . $kunjungan->nama . ' saved successfully.', 'success');
        $this->openForm();
    }
    public function pilihWaktu($item)
    {
        $index = array_search(true, $this->searchingWaktu, true);
        $this->resepObat[$index]['waktu'] = $item['nama'];
        $this->searchingWaktu[$index] = false;
    }
    public function cariWaktu($index)
    {
        $this->searchingWaktu[$index] = true;
        $query = $this->resepObat[$index]['waktu'] ?? '';
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
        $this->resepObat[$index]['frekuensi'] = $item['nama'];
        $this->searchingFrekuensi[$index] = false;
    }
    public function cariFrekuensi($index)
    {
        $this->searchingFrekuensi[$index] = true;
        $query = $this->resepObat[$index]['frekuensi'] ?? '';
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
            $this->resepObat[$index]['nama'] = $obat->nama;
            $this->resepObat[$index]['harga'] = $obat->harga_jual;
        }
        $this->searchingObat[$index] = false;
        $this->obats = [];
    }
    public function cariObat($index)
    {
        $this->searchingObat[$index] = true;
        $query = $this->resepObat[$index]['nama'] ?? '';
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
    public function tambah()
    {
        $this->resepObat[] = [
            'id' => '',
            'nama' => '',
            'frekuensi' => '',
            'waktu' => '',
            'harga' => '',
            'jumlah' => '',
            'keterangan' => '',
        ];
    }
    public function hapus($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function openForm()
    {
        $this->formEdit = $this->formEdit ? false : true;
    }
    public function edit($kode)
    {
        $kunjungan = Kunjungan::where('kode', $kode)->first();
        $this->resepEdit = ResepObat::where('kode', $kode)->first();
        $this->formEdit = true;
        if (count($kunjungan->resepobatdetails)) {
            $this->resepObatDokter = [];
            foreach ($kunjungan->resepobatdetails as $key => $value) {
                $this->resepObatDokter[] = [
                    'id' => null,
                    'nama' => $value->nama,
                    'frekuensi' => $value->frekuensi,
                    'waktu' => $value->waktu,
                    'harga' =>  null,
                    'jumlah' => $value->jumlah,
                    'keterangan' =>  $value->keterangan,
                ];
            }
            $this->resepObat = [];
            foreach ($kunjungan->resepfarmasidetails as $key => $value) {
                $this->resepObat[] = [
                    'id' => $value->id,
                    'nama' => $value->nama,
                    'frekuensi' => $value->frekuensi,
                    'waktu' => $value->waktu,
                    'harga' =>  $value->harga,
                    'jumlah' => $value->jumlah,
                    'keterangan' =>  $value->keterangan,
                ];
            }
            if (count($this->resepObat) == 0) {
                $this->resepObat = $this->resepObatDokter;
            }
        }
    }
    public function terima($kode)
    {
        $resepObat = ResepObat::where('kode', $kode)->first();
        $resepObat->status = 2;
        $resepObat->update();

        $antrian = Antrian::where('kodebooking', $kode)->first();
        if ($antrian) {
            $now = now();
            $antrian->taskid = 6;
            $antrian->taskid6 = $now;
            $antrian->panggil = 0;
            $antrian->status = 1;
            $antrian->user4 = auth()->user()->id;
            $antrian->update();
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
        }
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
