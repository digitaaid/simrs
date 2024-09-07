<?php

namespace App\Livewire\User;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $formUser = 0;
    public $roles = [];
    public $user, $id, $name, $username, $phone, $email, $role, $password;
    public $formImport = 0;
    public $fileImport;
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }
    public function tambah()
    {
        $this->reset(['id', 'name', 'username', 'phone', 'email', 'role', 'password']);
        $this->formUser = 1;
    }
    public function batal()
    {
        $this->formUser = 0;
    }
    public function edit($id)
    {
        $this->user = User::find($id);
        $this->id = $this->user->id;
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
        $this->role = $this->user->roles?->first()?->name;
        $this->formUser = 1;
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'phone' => 'required|numeric|min:9',
            'email' => 'required|email',
        ]);
        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'pic' => auth()->user()->name,
        ];
        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }
        $user = User::updateOrCreate(
            ['id' => $this->id],
            $data
        );
        $user->syncRoles([]);
        $user->assignRole($this->role);
        Alert::success('Success', 'User ' . $user->name . ' saved successfully');
        return redirect()->route('user.index');
    }
    public function verifikasi($id)
    {
        $user = User::find($id);
        $user->email_verified_at = $user->email_verified_at ?  null : now();
        $user->pic = auth()->user()->name;
        $user->user_verify = auth()->user()->name;
        $user->save();
        Alert::success('Success', 'User ' . $user->name . ' verified successfully');
        return redirect()->route('user.index');
    }
    public function hapus($id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::success('Success', 'User ' . $user->name . ' deleted successfully');
        return redirect()->route('user.index');
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new UserExport, 'user_backup_' . $time . '.xlsx');
            flash('Export Pasien successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport = $this->formImport ?  0 : 1;
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new UserImport, $this->fileImport->getRealPath());
            Alert::success('Success', 'User imported successfully');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $users = User::with(['roles'])
            ->where('name', 'like', $search)
            ->orWhere('email', 'like', $search)
            // ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate();
        $this->roles = Role::pluck('name', 'id');
        return view('livewire.user.user-index', compact('users'))
            ->title('User');
    }
}
