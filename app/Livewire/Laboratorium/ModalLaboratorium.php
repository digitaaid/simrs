<?php

namespace App\Livewire\Laboratorium;

use App\Models\Antrian;
use App\Models\HasilLaboratorium;
use App\Models\Kunjungan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ModalLaboratorium extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $pasien;
    public $id, $nik, $nama, $nomorkartu, $norm, $tanggal, $pemeriksaan, $hasil, $pic, $user, $file, $fileurl, $filename;
    public $form = false;
    public $lihat = false;
    public $idLihat = false;
    public function lihatFile($id)
    {
        $this->lihat = $this->lihat ? false : true;
        $this->idLihat = $id;
    }
    public function hapus($id)
    {
        $lab = HasilLaboratorium::find($id);
        $lab->delete();
        flash('Data Berhasil Dihapus', 'success');
    }
    public function edit($id)
    {
        $this->form = $this->form ? false : true;
        $lab = HasilLaboratorium::find($id);
        $this->id = $lab->id;
        $this->nik = $lab->nik;
        $this->nama = $lab->nama;
        $this->nomorkartu = $lab->nomorkartu;
        $this->norm = $lab->norm;
        $this->tanggal = $lab->tanggal;
        $this->pemeriksaan = $lab->pemeriksaan;
        $this->hasil = $lab->hasil;
        $this->pic = $lab->pic;
        $this->user = $lab->user;
        $this->file = $lab->file;
        $this->fileurl = $lab->fileurl;
    }

    public function store()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'pemeriksaan' => 'required',
            'hasil' => 'required',
        ]);
        try {
            if ($this->file) {
                $filename = $this->norm . '_' . $this->nama . '_LAB_' . $this->tanggal . now()->format('dmY_His') . '.' . $this->file->getClientOriginalExtension();
                $path =  $this->file->storeAs('public/laboratorium',  $filename);
                $fileurl = route('landingpage') .  '/storage/laboratorium/' . $filename;
                $this->fileurl = route('landingpage') .  '/storage/laboratorium/' . $filename;
                $this->filename =  $filename;
            }
            if (!$this->id) {
                $hasil = HasilLaboratorium::create([
                    'nama' => $this->nama,
                    'norm' => $this->norm,
                    'nik' => $this->nik,
                    'nomorkartu' => $this->nomorkartu,
                    'tanggal' => $this->tanggal,
                    'filename' => $this->filename,
                    'fileurl' => $this->fileurl,
                    'pemeriksaan' => $this->pemeriksaan,
                    'hasil' => $this->hasil,
                    'user' => auth()->user()->id,
                    'pic' => auth()->user()->name,
                ]);
            } else {
                $lab = HasilLaboratorium::find($this->id);
                $lab->update([
                    'nama' => $this->nama,
                    'norm' => $this->norm,
                    'nik' => $this->nik,
                    'nomorkartu' => $this->nomorkartu,
                    'tanggal' => $this->tanggal,
                    'filename' => $this->filename,
                    'fileurl' => $this->fileurl,
                    'pemeriksaan' => $this->pemeriksaan,
                    'hasil' => $this->hasil,
                    'user' => auth()->user()->id,
                    'pic' => auth()->user()->name,
                ]);
            }
            $this->form = $this->form ? false : true;
            flash('Data Berhasil Disimpan ' .   $this->fileurl, 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ! ' .   $th->getMessage(), 'danger');
        }
    }
    public function tambahLab()
    {
        $this->form = $this->form ? false : true;
    }
    public function mount(Antrian $antrian)
    {
        $this->pasien = $antrian->pasien;
        $this->norm = $antrian->pasien->norm;
        $this->nik = $antrian->pasien->nik;
        $this->nomorkartu = $antrian->pasien->nomorkartu;
        $this->nama = $antrian->pasien->nama;
    }
    public function render()
    {
        $lab = null;
        if ($this->pasien) {
            $labs = HasilLaboratorium::where('norm', $this->pasien->norm)
                ->paginate(10);
        }
        return view('livewire.laboratorium.modal-laboratorium', compact('labs'));
    }
}
