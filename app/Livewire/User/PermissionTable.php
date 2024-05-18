<?php

namespace App\Livewire\User;

use Livewire\Component;

class PermissionTable extends Component
{
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function render()
    {
        return view('livewire.user.permission-table');
    }
}
