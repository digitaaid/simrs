<?php

namespace App\Livewire\Integration;

use App\Models\ActivityLog;
use App\Models\Integration;
use Livewire\Component;
use Illuminate\Support\Str;


class IntegrationIndex extends Component
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
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Intergation',
            'description' => auth()->user()->name . ' Update/Create Intergation ' . $integrasi->name,
        ]);
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
    public function render()
    {
        return view('livewire.integration.integration-index')
            ->title('Aplikasi Integrasi');
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text')
            ->title('Aplikasi Integrasi');
    }
    public function mount()
    {
        $this->integrations = Integration::get();
    }
}
