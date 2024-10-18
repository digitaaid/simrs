<?php

namespace App\Livewire\Igd;

use App\Models\DataDiagnosa;
use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\WaktuObat;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalResepDokterIgd extends Component
{
    public $kunjungan;
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
    public function addObat()
    {
        $this->resepObat[] = ['obat' => '', 'jumlahobat' => '', 'frekuensiobat' => '', 'waktuobat' => '', 'keterangan' => ''];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function simpanResep()
    {
        $this->validate([
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required|numeric',
        ]);
        $kunjungan = $this->kunjungan;
        // resep obat
        if (count($this->resepObat)) {
            $resep = ResepObat::updateOrCreate([
                'kodebooking' => $kunjungan->kode,
                'antrian_id' => $kunjungan->id,
                'kodekunjungan' => $kunjungan->kode,
                'kunjungan_id' => $kunjungan->id,
                'kode' => $kunjungan->kode,
            ], [
                'counter' => $kunjungan->counter,
                'norm' => $kunjungan->norm,
                'nama' => $kunjungan->nama,
                'tgl_lahir' => $kunjungan->tgl_lahir,
                'gender' => $kunjungan->gender,
                // detail
                'waktu' => now(),
                'dokter' => $kunjungan->dokter,
                'namadokter' => $kunjungan->dokters->nama,
                'unit' => $kunjungan->unit,
                'namaunit' => $kunjungan->units->nama,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
                'status' => '1',
            ]);
            $resep->resepobatdetails()->each(function ($resepobatdetail) {
                $resepobatdetail->delete();
            });
            foreach ($this->resepObat as $key => $value) {
                $obatdetails = ResepObatDetail::updateOrCreate([
                    'kunjungan_id' => $kunjungan->id,
                    'antrian_id' => $kunjungan->id,
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                    'nama' => $this->resepObat[$key]['obat'],
                ], [
                    'jaminan' => $kunjungan->jaminan,
                    'jumlah' => $this->resepObat[$key]['jumlahobat'],
                    'frekuensi' => $this->resepObat[$key]['frekuensiobat'],
                    'waktu' => $this->resepObat[$key]['waktuobat'],
                    'keterangan' => $this->resepObat[$key]['keterangan'],
                ]);
                FrekuensiObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['frekuensiobat'],
                ]);
                WaktuObat::updateOrCreate([
                    'nama' => $this->resepObat[$key]['waktuobat'],
                ]);
            }
        }
        Alert::success('Success', 'Resep obat IGD berhasil disimpan');
        // flash('Kunjungan berhasil disimpan', 'success');
        $url = route('pendaftaran.igd.proses') . "?kode=" . $kunjungan->kode;
        redirect()->to($url);
    }
    public function mount($kunjungan)
    {
        $this->obats = Obat::pluck('nama');
        $this->frekuensiObats = FrekuensiObat::pluck('nama');
        $this->waktuObats = WaktuObat::pluck('nama');
        $this->kunjungan = $kunjungan;
        $this->kunjungan = $kunjungan;
        if ($this->kunjungan->resepobatdetails) {
            $this->resepObat = [];
            foreach ($this->kunjungan->resepobatdetails as $key => $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        }
    }
    public function render()
    {
        return view('livewire.igd.modal-resep-dokter-igd');
    }
}
