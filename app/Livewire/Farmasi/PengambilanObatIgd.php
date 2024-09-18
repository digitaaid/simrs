<?php

namespace App\Livewire\Farmasi;

use App\Models\FrekuensiObat;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\ResepFarmasi;
use App\Models\ResepFarmasiDetail;
use App\Models\ResepObat;
use App\Models\WaktuObat;
use Livewire\Component;

class PengambilanObatIgd extends Component
{

    public $tanggal, $reseps, $resepantri;
    public $resep;
    public $playAudio = true;
    public $formedit = 0;
    public $obats = [], $frekuensiObats = [], $waktuObats = [];
    public $resepObat = [
        [
            'obat' => '',
            'jumlahobat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'keterangan' => '',
        ]
    ];
    public $resepObatDokter = [
        [
            'obat' => '',
            'jumlahobat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'keterangan' => '',
        ]
    ];
    public function addObat()
    {
        $this->resepObat[] = ['obat' => '', 'jumlahobat' => '', 'frekuensiobat' => '', 'waktuobat' => '', 'keterangan' => ''];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }

    public function refreshComponent()
    {
        $this->resepantri =  $this->resepantri = ResepObat::where('status', 1)->first();
        if ($this->resepantri) {
            $this->playAudio = true;
            $this->dispatch('play-audio');
        } else {
            $this->playAudio = false;
        }
    }
    public function terimaResep($id)
    {
        $resep = ResepObat::where('id', $id)->first();
        $resep->status = 2;
        $resep->user = auth()->user()->id;
        $resep->pic = auth()->user()->name;
        $resep->update();
        flash('Resep obat atas nama pasien ' . $resep->nama . ' telah diterima farmasi.', 'success');
    }
    public function edit(ResepObat $resep)
    {
        $this->formedit = 1;
        $kunjungan = $resep->kunjungan;
        $this->resep = $resep;
        if (count($this->resep->resepobatdetails)) {
            $this->resepObatDokter = [];
            foreach ($this->resep->resepobatdetails as $key => $value) {
                $this->resepObatDokter[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
            $this->resepObat = [];
            foreach ($kunjungan->resepfarmasidetails as $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
            if (count($this->resepObat) == 0) {
                $this->resepObat = $this->resepObatDokter;
            }
        }
    }
    public function simpanResep()
    {
        $this->validate([
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required',
        ]);
        $kunjungan = $this->resep->kunjungan;
        $resep = ResepFarmasi::updateOrCreate([
            'kodebooking' => $kunjungan->kode,
            'antrian_id' => $kunjungan->id,
            'kodekunjungan' => $kunjungan->kode,
            'kunjungan_id' => $kunjungan->id,
            'kode' => $kunjungan->kode,
        ], [
            'counter' => $kunjungan->counter,
            'norm' => $kunjungan->norm,
            'nama' => $kunjungan->nama,
            'gender' => $kunjungan->gender,
            'waktu' =>  now(),
            'tgl_lahir' => $kunjungan->tgl_lahir,
            'user' => auth()->user()->id,
            'pic' => auth()->user()->name,
            'status' => '1',
        ]);
        // dd($kunjungan);
        if (count($this->resepObat)) {
            $resep->resepfarmasidetails()->each(function ($resepfarmasidetails) {
                $resepfarmasidetails->delete();
            });
            foreach ($this->resepObat as $key => $value) {
                $obat = Obat::where('nama', $this->resepObat[$key]['obat'])->first();
                if (!$obat) {
                    return flash('Obat ' . $this->resepObat[$key]['obat'] . ' tidak ditemukan.', 'danger');
                }
                $obatdetails = ResepFarmasiDetail::updateOrCreate([
                    'kunjungan_id' => $kunjungan->id,
                    'antrian_id' =>  $kunjungan->id,
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                    'nama' => $this->resepObat[$key]['obat'],
                ], [
                    'jaminan' => $kunjungan->jaminan,
                    'jumlah' => $this->resepObat[$key]['jumlahobat'],
                    'frekuensi' => $this->resepObat[$key]['frekuensiobat'],
                    'waktu' => $this->resepObat[$key]['waktuobat'],
                    'keterangan' => $this->resepObat[$key]['keterangan'],
                    // harga
                    'obat_id' => $obat->id,
                    'harga' => $obat->harga_jual,
                    'subtotal' => $obat->harga_jual * $this->resepObat[$key]['jumlahobat'],
                    'klasifikasi' => $obat->jenisobat,
                ]);
                FrekuensiObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['frekuensiobat'],
                ]);
                WaktuObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['waktuobat'],
                ]);
            }
        } else {
            $resep->resepfarmasidetails()->each(function ($resepfarmasidetails) {
                $resepfarmasidetails->delete();
            });
        }
        flash('Resep obat atas nama pasien ' . $kunjungan->nama . ' saved successfully.', 'success');
        $this->formedit = 0;
    }
    public function selesai(ResepObat $resep){
        $resep->status = 3;
        $resep->user = auth()->user()->id;
        $resep->pic = auth()->user()->name;
        $resep->update();
        flash('Pelayanan farmasi atas nama pasien ' . $resep->nama . ' telah selesai.', 'success');
    }
    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
        $this->obats = Obat::pluck('harga_jual', 'nama');
        $this->frekuensiObats = FrekuensiObat::pluck('nama');
        $this->waktuObats = WaktuObat::pluck('nama');
    }
    public function render()
    {
        if ($this->tanggal) {
            $this->reseps = ResepObat::orderBy('status', 'asc')->get();
        }
        return view('livewire.farmasi.pengambilan-obat-igd')->title('Pengambilan Obat IGD');
    }
}
