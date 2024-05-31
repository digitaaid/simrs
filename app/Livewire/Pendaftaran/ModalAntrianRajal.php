<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalAntrianRajal extends Component
{
    public $antrian, $polikliniks, $dokters;
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien, $keterangan, $perujuk, $jeniskunjungan, $jeniskunjunjgan;
    public $pasienbaru = 0, $estimasidilayani, $sisakuotajkn, $kuotajkn, $sisakuotanonjkn, $kuotanonjkn;
    public $asalRujukan, $nomorreferensi, $noRujukan, $noSurat;
    public $rujukans = [], $suratkontrols = [];
    public function cariRujukan()
    {
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
        ]);
        if ($this->asalRujukan == 1) {
            $res = $api->rujukan_peserta($request);
        } else {
            $res = $api->rujukan_rs_peserta($request);
        }
        if ($res->metadata->code == 200) {
            $this->rujukans = [];
            foreach ($res->response->rujukan as $key => $value) {
                $this->rujukans[] = [
                    'no' => $key + 1,
                    'noKunjungan' => $value->noKunjungan,
                    'tglKunjungan' => $value->tglKunjungan,
                    'namaPoli' => $value->poliRujukan->nama,
                    'jenisPelayanan' => $value->pelayanan->nama,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariSuratKontrol()
    {
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
            "formatfilter" => 2,
            "bulan" => Carbon::parse($this->tanggalperiksa)->format('m'),
            "tahun" => Carbon::parse($this->tanggalperiksa)->format('Y'),
        ]);
        $res = $api->suratkontrol_peserta($request);
        if ($res->metadata->code == 200) {
            $this->suratkontrols = [];
            foreach ($res->response->list as $key => $value) {
                $this->suratkontrols[] = [
                    'no' => $key + 1,
                    'noSuratKontrol' => $value->noSuratKontrol,
                    'tglRencanaKontrol' => $value->tglRencanaKontrol,
                    'namaPoliTujuan' => $value->namaPoliTujuan,
                    'terbitSEP' => $value->terbitSEP,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function editAntrian()
    {
        $this->validate([
            'kodebooking' => 'required',
            'nomorkartu' => 'required',
            'nik' => 'required|digits:16',
            'norm' => 'required|digits:9',
            'nama' => 'required',
            'nohp' => 'required|numeric',
            'tanggalperiksa' => 'required|date',
            'jenispasien' => 'required',
            'kodepoli' => 'required',
            'kodedokter' => 'required',
        ]);
        // proses data antrian
        if ($this->jenispasien == "JKN") {
            $this->validate([
                'noRujukan' => 'required_if:noSurat,null',
                'noSurat' => 'required_if:noRujukan,null',
            ]);
            $vclaim = new VclaimController();
            $request = new Request();
            if ($this->noSurat) {
                $this->jeniskunjungan = 3;
                $request['nomorsuratkontrol'] = $this->noSurat;
                $request['noSuratKontrol'] = $this->noSurat;
                $res =  $vclaim->suratkontrol_nomor($request);
                if ($res->metadata->code == 200) {
                    $this->perujuk = $res->response->sep->provPerujuk->nmProviderPerujuk;
                }
                $this->nomorreferensi = $this->noSurat;
            } else {
                $request['nomorrujukan'] = $this->noRujukan;
                if ($request->asalRujukan == 2) {
                    $this->jeniskunjungan = 4;
                    $res =  $vclaim->rujukan_rs_nomor($request);
                } else {
                    $this->jeniskunjungan = 1;
                    $res =  $vclaim->rujukan_nomor($request);
                }
                if ($res->metadata->code == 200) {
                    $this->perujuk = $res->response->rujukan->provPerujuk->nama;
                }
                $this->nomorreferensi = $this->noRujukan;
            }
        } else {
            $this->jeniskunjungan = 2;
        }

        $this->keterangan = "Antrian proses di pendaftaran";
        // simpan antrean
        $antrian = Antrian::find($this->antrianId);
        $antrian->update([
            'nomorkartu' => $this->nomorkartu,
            'nik' => $this->nik,
            'norm' => $this->norm,
            'nama' => $this->nama,
            'nohp' => $this->nohp,
            'tanggalperiksa' => $this->tanggalperiksa,
            'kodepoli' => $this->kodepoli,
            'kodedokter' => $this->kodedokter,
            'jenispasien' => $this->jenispasien,
            'jeniskunjungan' => $this->jeniskunjungan,
            'perujuk' => $this->perujuk,
            'nomorreferensi' => $this->nomorreferensi,
            'nomorrujukan' => $this->noRujukan,
            'nomorsuratkontrol' => $this->noSurat,
            'keterangan' => $this->keterangan,
            'user1' => auth()->user()->id,
        ]);
        // status antrean
        $api = new AntrianController();
        $request = new Request([
            "kodepoli" => $antrian->kodepoli,
            "kodedokter" => $this->kodedokter,
            "tanggalperiksa" => $this->tanggalperiksa,
            "jampraktek" => $antrian->jampraktek,
        ]);
        $res = $api->status_antrian($request);
        if ($res->metadata->code == 200) {
            $this->estimasidilayani = Carbon::parse($this->tanggalperiksa . ' ' . explode('-', $antrian->jampraktek)[0])->addSeconds(300 + $res->response->totalantrean * 300);
            $this->sisakuotajkn = $res->response->sisakuotajkn;
            $this->kuotajkn = $res->response->kuotajkn;
            $this->sisakuotanonjkn = $res->response->sisakuotanonjkn;
            $this->kuotanonjkn = $res->response->kuotanonjkn;
        } else {
            return flash($res->metadata->message, 'danger');
        }
        // tambah antrean
        $request = new Request([
            "kodebooking" => $this->kodebooking,
            "jenispasien" =>  $this->jenispasien,
            "nomorkartu" => $this->nomorkartu,
            "nik" =>  $this->nik,
            "nohp" => $this->nohp,
            "kodepoli" => $this->kodepoli,
            "namapoli" => $antrian->namapoli,
            "pasienbaru" => $this->pasienbaru,
            "norm" => $this->norm,
            "tanggalperiksa" =>  $this->tanggalperiksa,
            "kodedokter" => $this->kodedokter,
            "namadokter" => $antrian->namadokter,
            "jampraktek" => $antrian->jampraktek,
            "jeniskunjungan" => $this->jeniskunjungan,
            "nomorreferensi" => $this->nomorreferensi,
            "nomorantrean" => $antrian->nomorantrean,
            "angkaantrean" => $antrian->angkaantrean,
            "estimasidilayani" => $this->estimasidilayani,
            "sisakuotajkn" => $this->sisakuotajkn,
            "kuotajkn" => $this->kuotajkn,
            "sisakuotanonjkn" => $this->sisakuotanonjkn,
            "kuotanonjkn" => $this->kuotanonjkn,
            "keterangan" =>    $this->keterangan,
            "nama" => $this->nama,
        ]);
        $res =  $api->tambah_antrean($request);
        if ($res->metadata->code == 200) {
            $antrian->status = 1;
            $antrian->update();
            flash('Antrian atas nama pasien ' . $antrian->nama .  ' saved successfully.', 'success');
            $this->dispatch('formAntrian');
        } else {
            flash($res->metadata->message, 'danger');
        }
        $this->dispatch('refreshPage');
    }
    public function cariNomorKartu()
    {
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->nik = $pasien->nik;
            $this->nomorkartu = $pasien->nomorkartu;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
        }
    }
    public function cariNIK()
    {
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
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
        }
    }
    public function formAntrian()
    {
        $this->dispatch('formAntrian');
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->antrianId = $antrian->id;
        $this->kodebooking = $antrian->kodebooking;
        $this->nomorkartu = $antrian->nomorkartu;
        $this->nik = $antrian->nik;
        $this->norm = $antrian->norm;
        $this->nama = $antrian->nama;
        $this->nohp = $antrian->nohp;
        $this->tanggalperiksa = $antrian->tanggalperiksa;
        $this->kodepoli = $antrian->kodepoli;
        $this->kodedokter = $antrian->kodedokter;
        $this->jenispasien = $antrian->jenispasien;
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-antrian-rajal');
    }
}
