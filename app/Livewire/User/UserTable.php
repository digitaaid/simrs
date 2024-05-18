<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }


    public function render()
    {
        return view('livewire.user.user-table')
            ->with([
                'users' => User::orderBy('created_at', 'desc')->paginate(13),
            ]);
    }
}
