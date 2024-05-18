<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $id = null;
    public $form = false;
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

    public function formShow($id = null, $form = null)
    {
        $this->form = $form ? true : ($this->form ? false : true);
        $this->id =  $id;
    }

    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.user.user-table', [
            'users' => User::where('name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(),
        ]);
    }
}
