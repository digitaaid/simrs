<?php

namespace App\Livewire\Pegawai;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PegawaiTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }

    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.pegawai.pegawai-table', [
            'users' => User::where('name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->with('pegawai')->orderBy('created_at', 'desc')->paginate(),
        ]);
    }
}
