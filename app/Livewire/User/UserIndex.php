<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public function render()
    {
        return view('livewire.user.user-index')
            ->with([
                'users' => User::get(),
            ])
            ->title('User');
    }
}
