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
    public $resepObat = [
        [
            'id' => '',
            'nama' => '',
            'frekuensi' => '',
            'waktu' => '',
            'harga' => '',
            'jumlah' => '',
            'keterangan' => '',
            'pic' => '',
            'updated_at' => '',
        ]
    ];
    public function simpan()
    {
        $this->validate([
            'resepObat.*.nama' => 'required',
            'resepObat.*.jumlah' => 'required',
        ]);
        $kunjungan = $this->kunjungan;
        $resep = ResepObat::updateOrCreate([
            'kode' =>  $kunjungan->kode,
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
        $resep->resepobatdetails()->whereNotIn('id', $resepObatIds)->delete();
        if (count($this->resepObat)) {
            foreach ($this->resepObat as $key => $value) {
                $obat = Obat::where('nama', $this->resepObat[$key]['nama'])->first();
                $harga = $obat->harga_jual ?? $this->resepObat[$key]['harga'] ?? 0;
                $obatdetails = ResepObatDetail::updateOrCreate([
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
                    'harga' =>  $harga,
                    'subtotal' => $harga * $this->resepObat[$key]['jumlah'],
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
        return flash('Resep obat atas nama pasien ' . $kunjungan->nama . ' saved successfully.', 'success');
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
    public function hapus($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
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
            'pic' => auth()->user()->name,
            'updated_at' => now(),
        ];
        // $resepobat = ResepObat::updateOrCreate(
        //     [
        //         'kunjungan_id' => $this->kunjungan->id,
        //         'kodekunjungan' => $this->kunjungan->kode,
        //         'kode' => $this->kunjungan->kode,
        //     ],
        //     [
        //         'antrian_id' => $this->kunjungan->id,
        //         'kodebooking' => $this->kunjungan->kode,
        //         'counter' => $this->kunjungan->counter,
        //         'norm' => $this->kunjungan->norm,
        //         'nama' => $this->kunjungan->pasien->nama,
        //         'tgl_lahir' => $this->kunjungan->pasien->tgl_lahir,
        //         'gender' => $this->kunjungan->pasien->gender,
        //         'waktu' => now(),
        //         'user' => auth()->user()->id,
        //         'pic' => auth()->user()->name,
        //     ]
        // );
        // ResepObatDetail::create([
        //     'kunjungan_id' => $this->kunjungan->id,
        //     'antrian_id' => $this->kunjungan->id,
        //     'resep_id' => $resepobat->id,
        //     'koderesep' =>  $resepobat->kode,
        //     'jaminan' => $this->kunjungan->jaminan,
        //     'user' => auth()->user()->id,
        //     'pic' => auth()->user()->name,
        // ]);
        // $this->get_resepobat();
        // return flash('Obat telah ditambahkan.', 'success');
    }
    public function get_resepobat()
    {
        if ($this->kunjungan->resepobatdetails) {
            $this->resepObat = [];
            foreach ($this->kunjungan->resepobatdetails as $value) {
                $this->resepObat[] = [
                    'id' => $value->id,
                    'nama' => $value->nama,
                    'frekuensi' => $value->frekuensi,
                    'waktu' => $value->waktu,
                    'harga' => $value->harga,
                    'jumlah' => $value->jumlah,
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
