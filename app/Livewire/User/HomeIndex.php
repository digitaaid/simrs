<?php

namespace App\Livewire\User;

use Livewire\Component;

class HomeIndex extends Component
{
    public function render()
    {
        return view('livewire.user.home-index')->title('Menu Utama');
    }
}
