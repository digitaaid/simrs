<?php

namespace App\Livewire\Farmasi;

use App\Models\Antrian;
use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\WaktuObat;
use Illuminate\Http\Request;
use Livewire\Component;

class PengambilanResep extends Component
{
    public $tanggalperiksa;
    public $antrianresep;
    public $playAudio = false;
    public $antrians;
    public $antrianedit;
    public $formEdit = false;
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
    public function refreshComponent()
    {
        $this->antrianresep = Antrian::where('taskid', 5)->first();
        if ($this->antrianresep) {
            $this->playAudio = true;
            $this->dispatch('play-audio');
        } else {
            $this->playAudio = false;
        }
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function terimaResep(Antrian $antrian)
    {
        $antrian->taskid = 6;
        $antrian->taskid6 = now();
        $antrian->panggil = 0;
        $antrian->status = 1;
        $antrian->user4 = auth()->user()->id;
        $antrian->update();
    }
    public function edit(Antrian $antrianedit)
    {
        $this->antrianedit = $antrianedit;
        $this->formEdit = true;
        if (count($this->antrianedit->resepobatdetails)) {
            $this->resepObat = [];
            foreach ($this->antrianedit->resepobatdetails as $key => $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        }
        $this->obats = Obat::pluck('nama');
        $this->frekuensiObats = FrekuensiObat::pluck('nama');
        $this->waktuObats = WaktuObat::pluck('nama');
    }
    public function openformEdit()
    {
        $this->formEdit = $this->formEdit ? false : true;
    }
    public function simpanResep()
    {
        $this->validate([
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required',
        ]);
        $kunjungan = $this->antrianedit->kunjungan;
        if (count($this->resepObat)) {
            $resep = ResepObat::updateOrCreate([
                'kodebooking' => $this->antrianedit->kodebooking,
                'antrian_id' => $this->antrianedit->id,
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
            $resep->resepobatdetails()->each(function ($resepobatdetail) {
                $resepobatdetail->delete();
            });
            foreach ($this->resepObat as $key => $value) {
                $obat = Obat::where('nama', $this->resepObat[$key]['obat'])->first();
                if (!$obat) {
                    return flash('Obat ' . $this->resepObat[$key]['obat'] . ' tidak ditemukan.', 'danger');
                }
                $obatdetails = ResepObatDetail::updateOrCreate([
                    'kunjungan_id' => $kunjungan->id,
                    'antrian_id' =>  $this->antrianedit->id,
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
        }
        flash('Resep obat atas nama pasien ' . $kunjungan->nama . ' saved successfully.', 'success');
        $this->openformEdit();
    }
    public function selesai(Antrian $antrian)
    {
        $antrian->taskid = 7;
        $antrian->taskid7 = now();
        $antrian->status = 1;
        $antrian->user4 = auth()->user()->id;
        $antrian->update();
    }
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa;
    }
    public function caritanggal()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
        ]);
        $this->tanggalperiksa = $this->tanggalperiksa;
    }
    public function render()
    {
        if ($this->tanggalperiksa) {
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('taskid', '>=', 5)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_dokter', 'asc')
                ->select('antrians.*')
                ->get();
        }
        return view('livewire.farmasi.pengambilan-resep')->title('Pengambilan Resep Obat');
    }
}
