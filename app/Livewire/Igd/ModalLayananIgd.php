<?php

namespace App\Livewire\Igd;

use App\Models\Jaminan;
use App\Models\Kunjungan;
use App\Models\Layanan;
use App\Models\Tindakan;
use Livewire\Component;

class ModalLayananIgd extends Component
{
    public $tindakans = [], $jaminans = [];
    public $kunjungan, $kodekunjungan, $kunjungan_id, $kodebooking, $antrian_id;
    public $nama, $tarif_id, $harga, $jumlah, $diskon, $subtotal, $klasifikasi, $jaminan,  $keterangan, $tgl_input;
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
    public function hapusLayanan(Layanan $layanan)
    {
        $user =  auth()->user()->id;
        if ($layanan->user == $user || auth()->user()->hasPermissionTo('rekam-medis')) {
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
    public function mount(Kunjungan $kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->kodebooking = $kunjungan->kodebooking;
        $this->antrian_id = $kunjungan->id;
        $this->kodekunjungan = $kunjungan->kode;
        $this->kunjungan_id = $kunjungan->id;
        $this->jaminan = $kunjungan->jaminan;
        $this->tindakans = Tindakan::pluck('harga', 'nama');
        $this->jaminans = Jaminan::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.igd.modal-layanan-igd');
    }
}
