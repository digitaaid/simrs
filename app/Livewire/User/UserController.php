<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserController extends Component
{
    use WithPagination;
    public $name, $email, $user_id;
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $isModalOpen = false;
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
        ]);
        try {
            $user = User::updateOrCreate(
                [
                    'id' => $this->user_id
                ],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                ]
            );
            flash($this->user_id ? 'User ' . $user->name . ' Updated Successfully.' : 'User ' . $user->name . ' Created Successfully.', 'success');
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'danger');
        }
        return redirect()->to('/user');
    }
    public function edit($id)
    {
        $this->resetInputFields();
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->openModal();
    }
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->pegawai) {
                $user->pegawai->delete();
            }
            $user->delete();
            flash('User ' . $user->name . ' Deleted Successfully.', 'success');
        } else {
            flash('User id ' . $id . ' not found.', 'danger');
        }
    }
    public function openModal()
    {
        $this->resetInputFields();
    }
    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->user_id = '';
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $users = User::where('name', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate();
        return view('livewire.user.user-controller', [
            'users' => $users
        ]);
    }
}
