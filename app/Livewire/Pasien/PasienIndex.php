<?php

namespace App\Livewire\Pasien;

use App\Exports\PasienExport;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PasienIndex extends Component
{
    use WithPagination;
    public $search = '';


    public function export()
    {
        $time = now()->format('Y-m-d');
        return Excel::download(new PasienExport, 'pasien_backup_' . $time . '.xlsx');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->paginate();
        return view('livewire.pasien.pasien-index', compact('pasiens'))->title('Pasien');
    }
}
