<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public $id;
    public $name;
    public $email;
    public $isEditMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->isEditMode = true;
            $user = User::findOrFail($id);
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->isEditMode) {
            $user = User::findOrFail($this->id);
        } else {
            $user = new User;
        }
        $user->name = $this->name;
        $user->email = $this->email;
        $user->updated_at = now();
        $user->save();
        $message = $this->isEditMode ? 'User updated successfully.' : 'User created successfully.';
        flash($message, 'success');
        return redirect()->route('user.index');
    }

    public function render()
    {
        $title =  $this->name ? 'Edit User ' . $this->name : 'Tambah User';
        return view('livewire.user.user-form')
            ->title($title);
    }
}
