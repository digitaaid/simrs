<?php

namespace App\Livewire\User;

use App\Exports\RoleExport;
use App\Imports\RoleImport;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    use WithFileUploads;
    public $id, $name, $roles;
    public $permissions = [];
    public $selectedPermissions = [];
    public $form = false;
    public $search = '';
    public $formImport = 0;
    public $fileImport;
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $role = Role::updateOrCreate(
            ['id' => $this->id],
            ['name' => $this->name],
        );
        $role->syncPermissions();
        $role->syncPermissions($this->selectedPermissions);
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Role',
            'description' => auth()->user()->name . ' menyimpan data role ' . $role->name,
        ]);
        flash('Role ' . $role->name . ' saved successfully.', 'success');
        $this->closeForm();
    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Delete Role',
            'description' => auth()->user()->name . ' megnhapus data role ' . $role->name,
        ]);
        flash('Role ' . $role->name . ' deleted successfully.', 'success');
    }
    public function edit($id)
    {
        $this->form = true;
        $role = Role::find($id);
        $this->name = $role->name;
        $this->id = $role->id;
        $this->permissions = Permission::pluck('name', 'id');
        $this->selectedPermissions = $role->permissions()->pluck('name');
    }
    public function openForm()
    {
        $this->form = true;
        $this->name = '';
        $this->id = '';
        $this->permissions = Permission::pluck('name', 'id');
    }
    public function closeForm()
    {
        $this->form = false;
        $this->name = '';
        $this->id = '';
        $this->selectedPermissions = [];
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            flash('Export successfully', 'success');
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Export Role',
                'description' => auth()->user()->name . ' export data role',
            ]);
            return Excel::download(new RoleExport, 'role_backup_' . $time . '.xlsx');
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
            Excel::import(new RoleImport, $this->fileImport->getRealPath());
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Import Role',
                'description' => auth()->user()->name . ' import data role',
            ]);
            Alert::success('Success', 'Imported successfully');
            return redirect()->route('role-permission');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function cari() {}
    public function mount() {}
    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->roles = Role::orderBy('name', 'asc')->with(['permissions'])
            ->where('name', 'like', $search)
            ->get();
        $this->permissions = Permission::pluck('name', 'id');
        return view('livewire.user.role-index');
    }
}
