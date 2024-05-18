<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserForm extends Component
{
    public $id, $name, $role, $email;
    public $roles = [];
    public $isEditMode = false;

    public function mount($id = null)
    {
        if ($id) {
            $this->isEditMode = true;
            $user = User::findOrFail($id);
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles?->first()?->name;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ]);

        if ($this->isEditMode) {
            $user = User::findOrFail($this->id);
        } else {
            $user = new User;
        }
        $user->name = $this->name;
        $user->email = $this->email;
        $user->updated_at = now();
        $user->save();
        $user->syncRoles([]);
        $user->assignRole($this->role);
        flash('User ' . $user->name . '  saved successfully.', 'success');
        return redirect()->to('/user');
    }

    public function render()
    {
        $this->roles = Role::pluck('name', 'id');
        return view('livewire.user.user-form');
    }
}
