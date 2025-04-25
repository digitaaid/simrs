<?php

namespace App\Livewire\Igd;

use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\RiwayatObat;
use App\Models\RiwayatObatDetail;
use App\Models\WaktuObat;
use Livewire\Component;

class ModalRiwayatObat extends Component
{
    public $kunjungan;
    public $riwayatObat = [];
    public $searchingObat = [];
    public $obats = [];
    public function simpan()
    {
        $this->validate([
            'riwayatObat.*.namaobat' => 'required',
        ]);
        $resep = RiwayatObat::updateOrCreate(
            [
                'kode' => $this->kunjungan->kode,
            ],
            [
                'kunjungan_id' => $this->kunjungan->id,
                'kodekunjungan' => $this->kunjungan->kode,
                'antrian_id' => $this->kunjungan->id,
                'kodebooking' => $this->kunjungan->kode,
                'counter' => $this->kunjungan->counter,
                'norm' => $this->kunjungan->norm,
                'nama' => $this->kunjungan->nama,
                'tgl_lahir' => $this->kunjungan->tgl_lahir,
                'gender' => $this->kunjungan->gender,
                'waktu' => now(),
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        foreach ($this->riwayatObat as $key => $value) {
            $obatdetails = RiwayatObatDetail::updateOrCreate([
                'resep_id' => $resep->id,
                'koderesep' => $resep->kode,
                'nama' => $this->riwayatObat[$key]['namaobat'],
            ], [
                'kunjungan_id' => $this->kunjungan->id,
                'antrian_id' => $this->kunjungan->id,
                'jaminan' => $this->kunjungan->jaminan,
                'jumlah' => $this->riwayatObat[$key]['jumlahobat'],
                'frekuensi' => $this->riwayatObat[$key]['dosis'],
                'waktu' => $this->riwayatObat[$key]['waktu'],
                'keterangan' => $this->riwayatObat[$key]['keterangan'],
            ]);
            FrekuensiObat::updateOrCreate([
                'nama' => $this->riwayatObat[$key]['dosis'],
            ]);
            WaktuObat::updateOrCreate([
                'nama' => $this->riwayatObat[$key]['waktu'],
            ]);
        }
        return flash('Riwayat obat saved successfully.', 'success');
    }
    public function cariObat($index)
    {
        $this->searchingObat[$index] = true; // Aktifkan pencarian untuk baris tertentu
        $query = $this->riwayatObat[$index]['namaobat'] ?? '';
        try {
            $this->obats[$index] = Obat::where('nama', 'like', '%' . $query . '%')
                ->limit(20)
                ->get(['id', 'nama', 'satuan', 'merk']) // Ambil hanya kolom yang diperlukan
                ->map(function ($obat) {
                    return [
                        'id' => $obat->id,
                        'nama' => $obat->nama,
                        'satuan' => $obat->satuan,
                        'merk' => $obat->merk,
                    ];
                })
                ->toArray();
        } catch (\Throwable $th) {
            $this->obats[$index] = [];
        }
    }
    public function pilihObat($item)
    {
        $obat = Obat::find($item['id']);
        $index = array_search(true, $this->searchingObat, true);
        if ($obat) {
            $this->riwayatObat[$index]['namaobat'] = $obat->nama;
            $this->riwayatObat[$index]['dosis'] = $obat->dosis ?? '';
            $this->riwayatObat[$index]['jumlahobat'] = 1; // Default jumlah
        }
        $this->searchingObat[$index] = false; // Nonaktifkan pencarian untuk baris tertentu
        $this->obats[$index] = []; // Kosongkan hasil pencarian untuk baris tertentu
    }
    public function tambahObat()
    {
        $this->riwayatObat[] = ['namaobat' => '', 'dosis' => '', 'jumlahobat' => '', 'waktu' => '', 'keterangan' => ''];
    }
    public function hapusObat($index)
    {
        unset($this->riwayatObat[$index]);
        unset($this->searchingObat[$index]);
        unset($this->obats[$index]);
        $this->riwayatObat = array_values($this->riwayatObat); // Reindex array
        $this->searchingObat = array_values($this->searchingObat); // Reindex array
        $this->obats = array_values($this->obats); // Reindex array
    }
    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;

        if ($this->kunjungan->riwayatobatdetails) {
            $this->riwayatObat = [];
            foreach ($this->kunjungan->riwayatobatdetails as $key => $value) {
                $this->riwayatObat[] = ['namaobat' => $value->nama, 'jumlahobat' => $value->jumlah, 'dosis' => $value->frekuensi, 'waktu' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        } else {
            $this->riwayatObat = [
                ['namaobat' => '', 'dosis' => '', 'jumlahobat' => '', 'waktu' => '', 'keterangan' => '']
            ];
        }
    }
    public function render()
    {
        return view('livewire.igd.modal-riwayat-obat');
    }
}
