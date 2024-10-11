<?php

namespace App\Livewire\Farmasi;

use Livewire\Component;
use App\Models\PemesananObat;
use App\Models\PemesananObatDetail;
use App\Models\Obat;
use App\Models\SupplierObat;

class PemesananObatIndex extends Component
{
    public $tgl_pemesanan, $pemesanans;
    public $suppliers;
    public $form = 0, $formimport = 0;
    public $obats = [], $frekuensiObats = [], $waktuObats = [];
    public $nomor, $penanggungjawab, $keterangan, $jabatan, $sipa, $supplier, $alamat_supplier, $nohp_supplier, $nama_sarana, $alamat_sarana, $no_izin_sarana, $apoteker;
    public function render()
    {
        $this->pemesanans = PemesananObat::get();
        $this->suppliers = SupplierObat::pluck('nama');
        $this->obats = Obat::get(['nama', 'harga_beli', 'kemasan', 'satuan',]);
        return view('livewire.farmasi.pemesanan-obat-index')->title('Pemesanan Obat');
    }
    public function mount()
    {
        $this->tgl_pemesanan = now()->format('Y-m-d');
        $this->penanggungjawab = "Apt. Nunung Nurhayati, S.Si";
        $this->jabatan = "Apoteker Penanggung Jawab";
        $this->sipa = "449/SIPA-242/SDK/DINKES/XI/2023";
        $this->nama_sarana = "Klinik Utama Kita Sehat";
        $this->alamat_sarana = "Jl. Merdeka Utara, Ciledug Kulon, Ciledug, Cirebon";
        $this->no_izin_sarana = "16082100122660007";
        $this->apoteker = auth()->user()->name;
    }
    public function tambah()
    {
        $this->form = $this->form  ? 0 : 1;
    }
    public function updatedSupplier()
    {
        $supplier = SupplierObat::where('nama', $this->supplier)->first();
        if ($supplier) {
            $this->alamat_supplier = $supplier->alamat;
            $this->nohp_supplier = $supplier->nohp;
        }
    }
    public $resepObat = [
        [
            'obat' => '',
            'zat_aktif' => '',
            'kekuatan' => '',
            'satuan' => '',
            'harga_beli' => '',
            'jumlah' => '',
            'kemasan' => '',
        ]
    ];
    public function addObat()
    {
        $this->resepObat[] = [
            'obat' => '',
            'zat_aktif' => '',
            'satuan' => '',
            'kekuatan' => '',
            'jumlah' => '',
            'kemasan' => '',
        ];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function updatedResepObat($value, $name)
    {
        $index = explode('.', $name)[0];  // Mendapatkan index dari nama yang diubah
        $this->prosesObat($value, $index);  // Memanggil fungsi yang diinginkan
    }
    public function prosesObat($namaObat, $index)
    {
        $obat = Obat::where('nama', $namaObat)->first();
        if ($obat) {
            $this->resepObat[$index]['harga_beli'] = $obat->harga_beli;
            $this->resepObat[$index]['kemasan'] = $obat->kemasan;
            $this->resepObat[$index]['satuan'] = $obat->satuan;
            $this->resepObat[$index]['zat_aktif'] = $obat->zat_aktif;
            $this->resepObat[$index]['kekuatan'] = $obat->kekuatan;
        }
    }
    public function simpan()
    {
        $supplier = SupplierObat::where('nama', $this->supplier)->first();
        if (!$supplier) {
            return flash('Supplier tidak terdaftar', 'danger');
        }
        if (!$this->nomor) {
            $jumlah = PemesananObat::count() + 1;
            $this->nomor = $jumlah . '/SP-KUKS/' . now()->format('m/Y');
        }
        $pemesanan = PemesananObat::updateOrCreate(
            [
                'nomor' => $this->nomor,
            ],
            [
                'kode' => strtoupper(uniqid()),
                'tgl_pemesanan' => $this->tgl_pemesanan,
                'penanggungjawab' => $this->penanggungjawab,
                'jabatan' => $this->jabatan,
                'sipa' => $this->sipa,
                'keterangan' => $this->keterangan,
                'supplier_id' => $supplier->id,
                'nama_supplier' => $supplier->nama,
                'alamat_supplier' => $this->alamat_supplier,
                'nohp_supplier' => $this->nohp_supplier,
                'nama_sarana' => $this->nama_sarana,
                'alamat_sarana' => $this->alamat_sarana,
                'no_izin_sarana' => $this->no_izin_sarana,
                'apoteker' => $this->apoteker,
                'pic' => auth()->user()->name,
                'user' => auth()->user()->id,
            ]
        );
        if ($pemesanan->pemesananobatdetails) {
            foreach ($pemesanan->pemesananobatdetails as $key => $pesananlama) {
                $pesananlama->delete();
            }
        }
        foreach ($this->resepObat as $key => $obat) {
            $obatx = Obat::where('nama', $obat['obat'])->first();
            if ($obatx) {
                $obatx->zat_aktif = $obat['zat_aktif'];
                $obatx->satuan = $obat['satuan'];
                $obatx->kekuatan = $obat['kekuatan'];
                $obatx->kemasan = $obat['kemasan'];
                $obatx->update();
            }
            $pemesanandetail = PemesananObatDetail::create([
                'pemesanan_obat_id' => $pemesanan->id,
                'obat_id' => $obatx->id,
                'nama' => $obatx->nama,
                'kekuatan' => $obatx->kekuatan,
                'zat_aktif' => $obatx->zat_aktif,
                'satuan' => $obatx->satuan,
                'kemasan' => $obatx->kemasan,
                'harga' => $obatx->harga_beli,
                'jumlah' => $obat['jumlah'],
                'total' => $obatx->harga_beli * $obat['jumlah'],
                'status' => 1,
                'pic' => auth()->user()->name,
                'user' => auth()->user()->id,
            ]);
        }
        $this->form = 0;
    }
    public function edit($id)
    {
        $pemesanan = PemesananObat::findOrFail($id);
        $this->form = 1;
        $this->nomor = $pemesanan->nomor;
        $this->tgl_pemesanan = $pemesanan->tgl_pemesanan;
        $this->penanggungjawab = $pemesanan->penanggungjawab;
        $this->jabatan = $pemesanan->jabatan;
        $this->sipa = $pemesanan->sipa;
        $this->supplier = $pemesanan->nama_supplier;
        $this->alamat_supplier = $pemesanan->alamat_supplier;
        $this->nohp_supplier = $pemesanan->nohp_supplier;
        $this->apoteker = $pemesanan->apoteker;
        $this->nama_sarana = $pemesanan->nama_sarana;
        $this->alamat_sarana = $pemesanan->alamat_sarana;
        $this->no_izin_sarana = $pemesanan->no_izin_sarana;
        $this->resepObat = [];
        foreach ($pemesanan->pemesananobatdetails as $key => $obat) {
            $this->resepObat[] = [
                'obat' => $obat->nama,
                'kekuatan' => $obat->kekuatan,
                'zat_aktif' => $obat->zat_aktif,
                'satuan' => $obat->satuan,
                'kemasan' =>  $obat->kemasan,
                'jumlah' =>  $obat->jumlah,
                'harga_beli' =>  $obat->harga,
            ];
        }
    }
    public function hapus($id)
    {
        $pemesanans =  PemesananObat::findOrFail($id);
        foreach ($pemesanans->pemesananobatdetails as $key => $pemesanan) {
            $pemesanan->delete();
        }
        $pemesanans->delete();
        session()->flash('message', 'Pemesanan obat berhasil dihapus.');
    }
}
