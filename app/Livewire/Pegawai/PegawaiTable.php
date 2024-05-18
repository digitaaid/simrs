<?php

namespace App\Livewire\Pegawai;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PegawaiTable extends Component
{
    use WithPagination;

    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }

    public function render()
    {
        return view('livewire.pegawai.pegawai-table')
            ->with([
                'users' => User::with('pegawai')->orderBy('created_at', 'desc')->paginate(13),
            ]);
    }
}
