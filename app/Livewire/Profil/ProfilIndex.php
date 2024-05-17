<?php

namespace App\Livewire\Profil;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ProfilIndex extends Component
{
    // public $user;
    public $id;
    public $name;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $user = User::findOrFail($this->id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        flash('User updated successfully!', 'success');
    }

    public function render()
    {
        return view('livewire.profil.profil-index')
            ->with([
                'user' => Auth::user(),
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ])
            ->title('Profil');
    }
}
