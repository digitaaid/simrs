<?php

namespace App\Livewire\Perawat;

use App\Models\Antrian;
use App\Models\Jaminan;
use App\Models\Layanan;
use App\Models\Tindakan;
use Livewire\Component;

class ModalLayananTindakan extends Component
{
    public $antrian, $kodekunjungan, $kunjungan_id, $kodebooking, $antrian_id;
    public $tindakans = [], $jaminans = [];
    public $nama, $tarif_id, $harga, $jumlah, $diskon, $subtotal, $klasifikasi, $jaminan,  $keterangan, $tgl_input;
    public function hapusLayanan(Layanan $layanan)
    {
        $user =  auth()->user()->id;
        if ($layanan->user == $user) {
            $layanan->delete();
            $this->dispatch('refreshPage');
            flash('Layanan berhasil dihapus.', 'success');
        } else {
            flash('Anda tidak memiliki akses untuk menghapus layanan ini.', 'danger');
        }
    }
    public function editLayanan(Layanan $layanan)
    {
        $this->nama = $layanan->nama;
        $this->tarif_id = $layanan->tarif_id;
        $this->harga = $layanan->harga;
        $this->jumlah = $layanan->jumlah;
        $this->diskon = $layanan->diskon;
        $this->subtotal = $layanan->subtotal;
        $this->klasifikasi = $layanan->klasifikasi;
        $this->jaminan = $layanan->jaminan;
        $this->keterangan = $layanan->keterangan;
    }
    public function simpanLayanan()
    {
        $this->subtotal = $this->harga * $this->jumlah - ($this->harga * $this->jumlah * $this->diskon / 100);
        $this->validate([
            'nama' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'diskon' => 'required',
            'subtotal' => 'required',
            'jaminan' => 'required',
        ]);
        $layanan = Layanan::updateOrCreate([
            'kodekunjungan' => $this->kodekunjungan,
            'kunjungan_id' => $this->kunjungan_id,
            'kodebooking' => $this->kodebooking,
            'antrian_id' => $this->antrian_id,
            'nama' => $this->nama,
            'tarif_id' => $this->tarif_id,
        ], [
            'harga' => $this->harga,
            'jumlah' => $this->jumlah,
            'diskon' => $this->diskon,
            'subtotal' => $this->subtotal,
            'klasifikasi' => $this->klasifikasi,
            'jaminan' => $this->jaminan,
            'status' => '1',
            'pic' => auth()->user()->name,
            'user' => auth()->user()->id,
            'keterangan' => $this->keterangan,
            'tgl_input' => now(),
        ]);
        $this->dispatch('refreshPage');
        $this->reset(['nama', 'tarif_id', 'harga', 'jumlah', 'diskon', 'subtotal', 'klasifikasi',  'keterangan']);
        flash('Layanan berhasil disimpan.', 'success');
    }
    public function updateSubtotal()
    {
        $this->subtotal = $this->harga * $this->jumlah - ($this->harga * $this->jumlah * $this->diskon / 100);
    }
    public function pilihTindakan()
    {
        $tindakan  = Tindakan::where('nama', $this->nama)->first();
        if ($tindakan) {
            $this->tarif_id = $tindakan->id;
            $this->harga = $tindakan->harga;
            $this->jumlah = 1;
            $this->diskon = 0;
            $this->subtotal = $tindakan->harga * $this->jumlah - ($tindakan->harga * $this->jumlah * $this->diskon / 100);
            $this->klasifikasi = $tindakan->klasifikasi;
        } else {
            flash('Tindakan atau layanan tidak ditemukan. Silahkan pilih kembali.', 'danger');
        }
    }
    public function modalLayanan()
    {
        $this->dispatch('modalLayanan');
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->kodebooking = $antrian->kodebooking;
        $this->antrian_id = $antrian->id;
        $this->kodekunjungan = $antrian->kunjungan->kode;
        $this->kunjungan_id = $antrian->kunjungan->id;
        $this->jaminan = $antrian->kunjungan->jaminan;
        $this->tindakans = Tindakan::pluck('nama', 'harga');
        $this->jaminans = Jaminan::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.perawat.modal-layanan-tindakan');
    }
}
