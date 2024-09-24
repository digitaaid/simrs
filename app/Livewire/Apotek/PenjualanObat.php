<?php

namespace App\Livewire\Apotek;

use App\Http\Controllers\VclaimController;
use App\Models\FrekuensiObat;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\ResepFarmasi;
use App\Models\ResepFarmasiDetail;
use App\Models\WaktuObat;
use Illuminate\Http\Request;
use Livewire\Component;

class PenjualanObat extends Component
{
    public $tanggal, $reseps, $resepantri;
    public $resep;
    public $playAudio = true;
    public $form = 0;
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
    public function caritanggal() {}
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
    }
    public function cariNomorKartu()
    {
        $request = new Request([
            'nomorkartu' => $this->nomorkartu,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nomorkartu($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public $norm, $nohp, $nomorkartu, $nik, $tgl_lahir, $fktp, $hakkelas, $gender, $nama, $jenispeserta;
    public function cariNIK()
    {
        $request = new Request([
            'nik' => $this->nik,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nik($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function cariNoRM()
    {
        $pasien = Pasien::where('norm', $this->norm)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
            $this->gender = $pasien->gender;
            $this->tgl_lahir = $pasien->tgl_lahir;
        }
    }
    public $kode, $counter;
    public function simpanResep()
    {
        $this->validate([
            'resepObat.*.obat' => 'required',
            'resepObat.*.jumlahobat' => 'required',
        ]);
        if (!$this->kode) {
            $this->kode = strtoupper(uniqid());
        }
        $kunjungansebelumnya = Kunjungan::where('norm', $this->norm)->orderBy('created_at', 'desc')->first();
        if ($kunjungansebelumnya) {
            $this->counter = $kunjungansebelumnya->counter + 1;
        } else {
            $this->counter = 1;
        }
        $resep = ResepFarmasi::updateOrCreate([
            'kodebooking' => $this->kode,
            'kodekunjungan' => $this->kode,
            'kode' => $this->kode,
        ], [
            'antrian_id' => 1,
            'kunjungan_id' => 1,
            'counter' => $this->counter,
            'norm' => $this->norm  ?? '000000',
            'nama' => $this->nama ?? 'PASIEN FARMASI',
            'gender' => $this->gender ?? 'L',
            'waktu' =>  now(),
            'tgl_lahir' => $this->tgl_lahir ?? now()->format('Y-m-d'),
            'unit' => 'FAR',
            'namaunit' => 'FARMASI',
            'namadokter' => auth()->user()->name,
            'user' => auth()->user()->id,
            'pic' => auth()->user()->name,
            'status' => '1',
        ]);
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
                    'kunjungan_id' => $resep->id,
                    'antrian_id' =>  $resep->id,
                    'resep_id' => $resep->id,
                    'koderesep' => $resep->kode,
                    'nama' => $this->resepObat[$key]['obat'],
                ], [
                    'jaminan' => '00001',
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
        flash('Resep obat atas nama pasien ' . $resep->nama . ' saved successfully.', 'success');
        $this->form = 0;
    }
    public function terimaResep($id)
    {
        $resep = ResepFarmasi::where('id', $id)->first();
        $resep->status = 2;
        $resep->user = auth()->user()->id;
        $resep->pic = auth()->user()->name;
        $resep->update();
        flash('Resep obat atas nama pasien ' . $resep->nama . ' telah diterima farmasi.', 'success');
    }
    public function edit(ResepFarmasi $resep)
    {
        $this->form = 1;
        $this->resep = $resep;
        $this->kode = $resep->kode;
        $this->norm = $resep->norm;
        $this->nama = $resep->nama;
        $pasien = Pasien::firstWhere('norm', $this->norm);
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->nohp = $pasien->nohp;
            $this->gender = $pasien->gender;
            $this->tgl_lahir = $pasien->tgl_lahir;
        }
        $this->resepObat = [];
        if (count($resep->resepfarmasidetails)) {
            foreach ($resep->resepfarmasidetails as $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        }
    }
    public function selesai(ResepFarmasi $resep)
    {
        $resep->status = 3;
        $resep->user = auth()->user()->id;
        $resep->pic = auth()->user()->name;
        $resep->update();
        $this->form = 0;
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
            $this->reseps = ResepFarmasi::with(['resepfarmasidetails'])
                ->whereDate('waktu', $this->tanggal)
                ->where('unit', 'FAR')
                ->orderBy('status', 'asc')->get();
        }
        return view('livewire.apotek.penjualan-obat')->title('Penjualan Obat');
    }
}
