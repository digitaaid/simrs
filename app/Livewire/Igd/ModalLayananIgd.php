<?php

namespace App\Livewire\Igd;

use App\Models\Jaminan;
use App\Models\Kunjungan;
use App\Models\Layanan;
use App\Models\Tindakan;
use Livewire\Component;

class ModalLayananIgd extends Component
{
    public $searchingTindakan = [];
    public $tindakans = [];
    public $kunjungan;
    public $layanans = [];

    public function cariTindakan($index)
    {
        $this->searchingTindakan[$index] = true;
        $query = $this->layanans[$index]['nama'] ?? '';
        try {
            $this->tindakans = Tindakan::where('nama', 'like', '%' . $query . '%')
                ->limit(20)
                ->get()
                ->map(function ($tarif) {
                    return [
                        'id' => $tarif->id,
                        'nama' => $tarif->nama,
                        'klasifikasi' => $tarif->klasifikasi,
                        'jenispasien' => $tarif->jenispasien,
                        'harga' => $tarif->harga,
                    ];
                })
                ->toArray();
        } catch (\Throwable $th) {
            $this->tindakans = [];
        }
    }

    public function validateAndUpdate($index, $field, $rules, $messages)
    {
        $this->validate([$field => $rules], $messages);

        $layanan = Layanan::find($this->layanans[$index]['id']);
        $harga = str_replace('.', '', $this->layanans[$index]['harga']);
        $jumlah = str_replace('.', '', $this->layanans[$index]['jumlah']);
        $diskon = str_replace('.', '', $this->layanans[$index]['diskon']);

        $layanan->harga = $harga;
        $layanan->jumlah = $jumlah;
        $layanan->diskon = $diskon;
        $layanan->subtotal = ($harga - ($harga * $diskon / 100)) * $jumlah;
        $layanan->pic = auth()->user()->name;
        $layanan->user = auth()->user()->id;
        $layanan->tgl_input = now();
        $layanan->save();

        $this->get_layanans();
    }

    public function inputHarga($index)
    {
        $this->validateAndUpdate(
            $index,
            'layanans.' . $index . '.harga',
            'required|numeric|min:0',
            [
                'layanans.' . $index . '.harga.required' => 'Harga tidak boleh kosong.',
                'layanans.' . $index . '.harga.numeric' => 'Harga harus berupa angka.',
                'layanans.' . $index . '.harga.min' => 'Harga minimal 0.',
            ]
        );
        flash('Harga berhasil diubah.', 'success');
    }

    public function inputDiskon($index)
    {
        $this->validateAndUpdate(
            $index,
            'layanans.' . $index . '.diskon',
            'required|numeric|min:0|max:100',
            [
                'layanans.' . $index . '.diskon.required' => 'Diskon tidak boleh kosong.',
                'layanans.' . $index . '.diskon.numeric' => 'Diskon harus berupa angka.',
                'layanans.' . $index . '.diskon.min' => 'Diskon minimal 0.',
                'layanans.' . $index . '.diskon.max' => 'Diskon maksimal 100.',
            ]
        );
        flash('Diskon berhasil diubah.', 'success');
    }

    public function inputJumlah($index)
    {
        $this->validateAndUpdate(
            $index,
            'layanans.' . $index . '.jumlah',
            'required|numeric|min:1',
            [
                'layanans.' . $index . '.jumlah.required' => 'Jumlah tidak boleh kosong.',
                'layanans.' . $index . '.jumlah.numeric' => 'Jumlah harus berupa angka.',
                'layanans.' . $index . '.jumlah.min' => 'Jumlah minimal 1.',
            ]
        );
        flash('Jumlah berhasil diubah.', 'success');
    }

    public function pilihTindakan($item)
    {
        $tarif = Tindakan::find($item['id']);
        $index = array_search(true, $this->searchingTindakan, true);
        $layanan = Layanan::find($this->layanans[$index]['id']);
        if ($tarif) {
            $layanan->nama = $tarif->nama;
            $layanan->klasifikasi = $tarif->klasifikasi;
            $layanan->tarif_id = $tarif->id;
            $layanan->harga = $tarif->harga ?? 0;
            $layanan->jumlah = 1;
            $layanan->diskon = 0;
            $layanan->subtotal = $tarif->harga ?? 0;
            $layanan->pic = auth()->user()->name;
            $layanan->user = auth()->user()->id;
            $layanan->tgl_input = now();
            $layanan->save();
            flash('Tindakan atau layanan berhasil ditambahkan.', 'success');
        } else {
            flash('Tindakan atau layanan tidak ditemukan.', 'danger');
        }
        $this->searchingTindakan[$index] = false;
        $this->tindakans = [];
        $this->get_layanans();
    }

    public function hapus($index)
    {
        $layanan = Layanan::find($this->layanans[$index]['id']);
        if ($layanan) {
            $layanan->delete();
            flash('Tindakan atau layanan berhasil dihapus.', 'danger');
        } else {
            flash('Tindakan atau layanan tidak ditemukan.', 'danger');
        }
        $this->get_layanans();
    }

    public function tambah()
    {
        Layanan::create([
            'kodekunjungan' => $this->kunjungan->kode,
            'kunjungan_id' => $this->kunjungan->id,
            'kodebooking' => $this->kunjungan->kode,
            'antrian_id' => $this->kunjungan->id,
            'harga' => 0,
            'jumlah' => 1,
            'diskon' => 0,
            'subtotal' => 0,
            'klasifikasi' => 'IGD',
            'jaminan' => $this->kunjungan->jaminan,
            'pic' => auth()->user()->name,
            'user' => auth()->user()->id,
            'tgl_input' => now(),
        ]);
        $this->get_layanans();
    }

    public function get_layanans()
    {
        if ($this->kunjungan->layanans) {
            $this->layanans = [];
            foreach ($this->kunjungan->layanans as $value) {
                $this->layanans[] = [
                    'id' => $value->id,
                    'nama' => $value->nama,
                    'tarif_id' => $value->tarif_id,
                    'harga' => number_format($value->harga, 0, ',', '.'),
                    'jumlah' => $value->jumlah,
                    'diskon' => $value->diskon,
                    'subtotal' => number_format($value->subtotal, 0, ',', '.'),
                    'pic' => $value->pic,
                ];
            }
        }
    }

    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->get_layanans();
    }

    public function render()
    {
        return view('livewire.igd.modal-layanan-igd');
    }

    public function getGrandTotal()
    {
        $total = 0;

        foreach ($this->layanans as $layanan) {
            $subtotal = str_replace('.', '', $layanan['subtotal']); // Hapus format titik jika ada
            $total += (int) $subtotal;
        }

        return number_format($total, 0, ',', '.'); // Format dengan titik setiap ribuan
    }
}
