<?php

namespace App\Livewire\Penunjang;

use App\Models\Antrian;
use App\Models\HasilPenunjang;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class ModalPenunjang extends Component
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
        $rad = HasilPenunjang::find($id);
        $rad->delete();
        flash('Data Berhasil Dihapus', 'success');
    }
    public function edit($id)
    {
        $this->form = $this->form ? false : true;
        $rad = HasilPenunjang::find($id);
        $this->id = $rad->id;
        $this->nik = $rad->nik;
        $this->nama = $rad->nama;
        $this->nomorkartu = $rad->nomorkartu;
        $this->norm = $rad->norm;
        $this->tanggal = $rad->tanggal;
        $this->pemeriksaan = $rad->pemeriksaan;
        $this->hasil = $rad->hasil;
        $this->pic = $rad->pic;
        $this->user = $rad->user;
        $this->file = $rad->file;
        $this->fileurl = $rad->fileurl;
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
                $filename = $this->norm . '_' . $this->nama . '_FILE_' . $this->tanggal . now()->format('dmY_His') . '.' . $this->file->getClientOriginalExtension();
                $path =  $this->file->storeAs('public/penunjang',  $filename);
                $fileurl = route('landingpage') .  '/storage/penunjang/' . $filename;
                $this->fileurl = route('landingpage') .  '/storage/penunjang/' . $filename;
                $this->filename =  $filename;
            }
            if (!$this->id) {
                $hasil = HasilPenunjang::create([
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
                $rad = HasilPenunjang::find($this->id);
                $rad->update([
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
        $rad = null;
        if ($this->pasien) {
            $rads = HasilPenunjang::where('norm', $this->pasien->norm)
                ->paginate(10);
        }
        return view('livewire.penunjang.modal-penunjang', compact('rads'));
    }
}
