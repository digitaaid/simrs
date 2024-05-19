<?php

namespace App\Livewire\Integration;

use App\Models\Integration;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Illuminate\Support\Str;

class IntegrationTable extends Component
{
    public $integrations, $id, $name, $slug, $description, $base_url, $auth_url, $user_id, $user_key, $secret_key;
    public $form = false;
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $integrasi = Integration::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->slug),
                'description' => $this->description,
                'base_url' => $this->base_url,
                'auth_url' => $this->auth_url,
                'user_id' => $this->user_id,
                'user_key' => $this->user_key,
                'secret_key' => $this->secret_key,
            ],
        );
        flash('Aplikasi Integrasi ' . $integrasi->name . ' saved successfully.', 'success');
        $this->closeForm();
    }
    public function edit($id)
    {
        $this->form = true;
        $permission = Integration::find($id);
        $this->id = $permission->id;
        $this->slug = $permission->slug;
        $this->name = $permission->name;
        $this->description = $permission->description;
        $this->base_url = $permission->base_url;
        $this->auth_url = $permission->auth_url;
        $this->user_id = $permission->user_id;
        $this->user_key = $permission->user_key;
        $this->secret_key = $permission->secret_key;
    }
    public function openForm()
    {
        $this->form = true;
        $this->name = '';
        $this->id = '';
        $this->slug = '';
        $this->description = '';
        $this->base_url = '';
        $this->auth_url = '';
        $this->user_id = '';
        $this->user_key = '';
        $this->secret_key = '';
    }
    public function closeForm()
    {
        $this->form = false;
        $this->name = '';
        $this->id = '';
        $this->slug = '';
        $this->description = '';
        $this->base_url = '';
        $this->auth_url = '';
        $this->user_id = '';
        $this->user_key = '';
        $this->secret_key = '';
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function render()
    {
        $this->integrations = Integration::get();
        return view('livewire.integration.integration-table');
    }
}
