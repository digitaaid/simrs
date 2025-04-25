<?php

namespace App\Livewire\Igd;

use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\WaktuObat;
use Livewire\Component;

class ModalResepDokterIgd extends Component
{

    public $searchingFrekuensi = [], $frekuensis = [];
    public $searchingObat = [], $obats = [];
    public $searchingWaktu = [], $waktus = [];
    public $kunjungan;
    public $resepobat;
    public $resepobatdetails = [];
    public function inputKeterangan($index)
    {
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        $query = $this->resepobatdetails[$index]['keterangan'] ?? '';
        $item->keterangan = $query;
        $item->save();
        $this->get_resepobat();
        return flash('Keterangan berhasil disimpan.', 'success');
    }
    public function inputJumlah($index)
    {
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        $query = $this->resepobatdetails[$index]['jumlah'] ?? '';
        $item->jumlah = $query;
        $item->save();
        $this->get_resepobat();
        return flash('Jumlah berhasil disimpan.', 'success');
    }
    public function pilihWaktu($select)
    {
        $index = array_search(true, $this->searchingWaktu, true);
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        if ($item) {
            $item->waktu = $select['nama'];
            $item->pic = auth()->user()->name;
            $item->user = auth()->user()->id;
            $item->save();
            flash('Waktu berhasil dipilih.', 'success');
        } else {
            flash('Waktu tidak ditemukan.', 'danger');
        }
        $this->searchingWaktu[$index] = false;
        $this->waktus = [];
        return $this->get_resepobat();
    }
    public function cariWaktu($index)
    {
        $this->searchingWaktu[$index] = true;
        $query = $this->resepobatdetails[$index]['waktu'] ?? '';
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
                $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
                $item->waktu = $query;
                $item->save();
                WaktuObat::updateOrCreate([
                    'nama' => $query,
                ]);
                $this->searchingWaktu[$index] = false;
                return flash('Waktu berhasil disimpan.', 'success');
            }
        } catch (\Throwable $th) {
            $this->waktus = [];
            $this->searchingWaktu[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function pilihFrekuensi($select)
    {
        $index = array_search(true, $this->searchingFrekuensi, true);
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        if ($item) {
            $item->frekuensi = $select['nama'];
            $item->pic = auth()->user()->name;
            $item->user = auth()->user()->id;
            $item->save();
            flash('Frekuensi berhasil dipilih.', 'success');
        } else {
            flash('Frekuensi tidak ditemukan.', 'danger');
        }
        $this->searchingFrekuensi[$index] = false;
        $this->frekuensis = [];
        return $this->get_resepobat();
    }
    public function cariFrekuensi($index)
    {
        $this->searchingFrekuensi[$index] = true;
        $query = $this->resepobatdetails[$index]['frekuensi'] ?? '';
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
                $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
                $item->frekuensi = $query;
                $item->save();
                FrekuensiObat::updateOrCreate([
                    'nama' => $query,
                ]);
                $this->searchingFrekuensi[$index] = false;
                return flash('Frekuensi berhasil disimpan.', 'success');
            }
        } catch (\Throwable $th) {
            $this->frekuensis = [];
            $this->searchingFrekuensi[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function pilihObat($select)
    {
        $obat = Obat::find($select['id']);
        $index = array_search(true, $this->searchingObat, true);
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        if ($item) {
            $item->nama = $obat->nama;
            $item->jumlah = 1;
            $item->harga = $obat->harga;
            $item->pic = auth()->user()->name;
            $item->user = auth()->user()->id;
            $item->save();
            flash('Obat berhasil dipilih.', 'success');
        } else {
            flash('Obat tidak ditemukan.', 'danger');
        }
        $this->searchingObat[$index] = false;
        $this->obats = [];
        return $this->get_resepobat();
    }
    public function cariObat($index)
    {
        $this->searchingObat[$index] = true;
        $query = $this->resepobatdetails[$index]['nama'] ?? '';
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
                    ];
                })
                ->toArray();
            if (empty($this->obats)) {
                $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
                $item->nama = $query;
                $item->klasifikasi = 'Obat';
                $item->save();
                $this->searchingObat[$index] = false;
                return flash('Obat berhasil disimpan.', 'success');
            }
        } catch (\Throwable $th) {
            $this->obats = [];
            $this->searchingObat[$index] = false;
            return flash($th->getMessage(), 'danger');
        }
    }
    public function hapus($index)
    {
        $item = ResepObatDetail::find($this->resepobatdetails[$index]['id']);
        if ($item) {
            $item->delete();
            $this->get_resepobat();
            return flash('Obat berhasil dihapus.', 'success');
        } else {
            return flash('Obat tidak ditemukan.', 'danger');
        }
    }
    public function tambah()
    {
        $resepobat = ResepObat::updateOrCreate(
            [
                'kunjungan_id' => $this->kunjungan->id,
                'kodekunjungan' => $this->kunjungan->kode,
                'kode' => $this->kunjungan->kode,
            ],
            [
                'antrian_id' => $this->kunjungan->id,
                'kodebooking' => $this->kunjungan->kode,
                'counter' => $this->kunjungan->counter,
                'norm' => $this->kunjungan->norm,
                'nama' => $this->kunjungan->pasien->nama,
                'tgl_lahir' => $this->kunjungan->pasien->tgl_lahir,
                'gender' => $this->kunjungan->pasien->gender,
                'waktu' => now(),
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        ResepObatDetail::create([
            'kunjungan_id' => $this->kunjungan->id,
            'antrian_id' => $this->kunjungan->id,
            'resep_id' => $resepobat->id,
            'koderesep' =>  $resepobat->kode,
            'jaminan' => $this->kunjungan->jaminan,
            'user' => auth()->user()->id,
            'pic' => auth()->user()->name,
        ]);
        $this->get_resepobat();
        return flash('Obat telah ditambahkan.', 'success');
    }
    public function get_resepobat()
    {
        if ($this->kunjungan->resepobatdetails) {
            $this->resepobatdetails = [];
            foreach ($this->kunjungan->resepobatdetails as $value) {
                $this->resepobatdetails[] = [
                    'id' => $value->id,
                    'nama' => $value->nama,
                    'frekuensi' => $value->frekuensi,
                    'jumlah' => $value->jumlah,
                    'waktu' => $value->waktu,
                    'keterangan' => $value->keterangan,
                    'pic' => $value->pic,
                    'updated_at' => $value->updated_at,
                ];
            }
        }
    }
    function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->get_resepobat();
    }
    public function render()
    {
        return view('livewire.igd.modal-resep-dokter-igd');
    }
}
