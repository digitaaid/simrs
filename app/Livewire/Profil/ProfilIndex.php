<?php

namespace App\Livewire\Profil;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilIndex extends Component
{

    public $title;
    public $content;

    public function save()
    {
        dd('test');
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.profil.profil-index', compact([
            'user'
        ]));
    }
}
