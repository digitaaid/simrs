<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionTable extends Component
{
    public $id, $name;
    public $form = false;
    public function edit($id)
    {
        $this->form = true;
        $permission = Permission::find($id);
        $this->name = $permission->name;
        $this->id = $permission->id;
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $permission = Permission::updateOrCreate(
            ['id' => $this->id],
            ['name' => Str::slug($this->name)],
        );
        flash('Permission ' . $permission->name . ' saved successfully.', 'success');
        $this->closeForm();
    }
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        flash('Permission ' . $permission->name . ' deleted successfully.', 'success');
    }
    public function openForm()
    {
        $this->form = true;
        $this->name = '';
        $this->id = '';
    }
    public function closeForm()
    {
        $this->form = false;
        $this->name = '';
        $this->id = '';
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function render()
    {
        $permissions = Permission::get();
        return view('livewire.user.permission-table', compact('permissions'));
    }
}
