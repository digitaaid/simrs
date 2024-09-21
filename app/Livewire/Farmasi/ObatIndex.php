<?php

namespace App\Livewire\Farmasi;

use App\Exports\ObatExport;
use App\Imports\ObatImport;
use App\Models\Obat;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ObatIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $obat, $stokminus, $obataktif, $stokterbatas, $filter, $paginate = 1;
    public $id, $nama, $kemasan, $konversi_satuan, $satuan, $stok_minimum, $jenisobat, $tipeobat, $harga_beli, $diskon_beli, $harga_jual, $harga_klinik, $harga_bpjs, $merk, $distributor, $bpom, $barcode;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileObatImport;
    public function store()
    {
        if ($this->obat) {
            $obat = $this->obat;
        } else {
            $obat = new Obat();
        }
        $obat->nama = $this->nama;
        $obat->kemasan = $this->kemasan;
        $obat->konversi_satuan = $this->konversi_satuan;
        $obat->satuan = $this->satuan;
        $obat->stok_minimum = $this->stok_minimum;
        $obat->jenisobat = $this->jenisobat;
        $obat->tipeobat = $this->tipeobat;
        $obat->harga_beli = $this->harga_beli;
        $obat->diskon_beli = $this->diskon_beli ?? 0;
        $obat->harga_jual = $this->harga_jual;
        $obat->harga_klinik = $this->harga_klinik ?? $this->harga_jual;
        $obat->harga_bpjs = $this->harga_bpjs;
        $obat->merk = $this->merk;
        $obat->distributor = $this->distributor;
        $obat->bpom = $this->bpom;
        $obat->barcode = $this->barcode;
        $obat->status =  1;
        $obat->user = auth()->user()->id;
        $obat->pic = auth()->user()->name;
        $obat->save();
        $this->reset(['nama', 'kemasan', 'konversi_satuan', 'satuan', 'stok_minimum', 'jenisobat', 'tipeobat', 'harga_beli', 'diskon_beli', 'harga_jual', 'harga_klinik', 'harga_bpjs', 'merk', 'distributor', 'bpom', 'barcode']);
        $this->openForm();
        flash('Obat ' . $obat->nama . ' saved successfully', 'success');
    }
    public function nonaktif(Obat $obat)
    {
        $obat->status = $obat->status ? 0 : 1;
        $obat->update();
        flash('Obat ' . $obat->nama . ' dinonaktifkan successfully', 'success');
        $this->reset(['nama', 'kemasan', 'konversi_satuan', 'satuan', 'stok_minimum', 'jenisobat', 'tipeobat', 'harga_beli', 'diskon_beli', 'harga_jual', 'harga_klinik', 'harga_bpjs', 'merk', 'distributor', 'bpom', 'barcode']);
        $this->openForm();
    }
    public function edit(Obat $obat)
    {
        $this->obat = $obat;
        $this->nama = $obat->nama;
        $this->kemasan = $obat->kemasan;
        $this->konversi_satuan = $obat->konversi_satuan;
        $this->satuan = $obat->satuan;
        $this->stok_minimum = $obat->stok_minimum;
        $this->jenisobat = $obat->jenisobat;
        $this->tipeobat = $obat->tipeobat;
        $this->harga_beli = $obat->harga_beli;
        $this->diskon_beli = $obat->diskon_beli;
        $this->harga_jual = $obat->harga_jual;
        $this->harga_klinik = $obat->harga_klinik;
        $this->harga_bpjs = $obat->harga_bpjs;
        $this->merk = $obat->merk;
        $this->distributor = $obat->distributor;
        $this->bpom = $obat->bpom;
        $this->barcode = $obat->barcode;
        $this->openForm();
    }
    public function import()
    {
        try {
            $this->validate([
                'fileObatImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new ObatImport, $this->fileObatImport->getRealPath());
            flash('Import Obat successfully', 'success');
            $this->formImport = false;
            $this->fileObatImport = null;
            return redirect()->route('obat.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new ObatExport, 'obat_backup_' . $time . '.xlsx');
            flash('Export Obat successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport =  $this->formImport ? false : true;
    }
    public function openForm()
    {
        $this->form = $this->form ? false : true;
    }
    public function mount(Request $request)
    {
        $this->filter = $request->filter;
        $this->stokminus = Obat::all()->filter(function ($obat) {
            return $obat->real_stok < 0;
        })->count();
        $this->stokterbatas = Obat::all()->filter(function ($obat) {
            $stokmin = $obat->stok_minimum ?? 0;
            return $obat->real_stok < $stokmin;
        })->count();
        $this->obataktif = Obat::where('status', 1)->count();
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        if ($this->filter) {
            $this->paginate = 0;
            if ($this->filter == "minus") {
                $obats = Obat::where('nama', 'like', $search)
                    ->orderBy('status', 'desc')
                    ->orderBy('nama', 'asc')
                    ->get()->filter(function ($obat) {
                        return $obat->real_stok < 0;
                    });
            }
            if ($this->filter == "minimum") {
                $obats = Obat::where('nama', 'like', $search)
                    ->orderBy('status', 'desc')
                    ->orderBy('nama', 'asc')
                    ->get()->filter(function ($obat) {
                        $stokmin = $obat->stok_minimum ?? 0;
                        return $obat->real_stok < $stokmin;
                    });
            }
        } else {
            $obats = Obat::where('nama', 'like', $search)
                ->orderBy('status', 'desc')
                ->orderBy('nama', 'asc')
                ->paginate();
        }
        return view('livewire.farmasi.obat-index', compact('obats'))->title('Obat');
    }
}
