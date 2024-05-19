<?php

namespace App\Livewire\Integration;

use App\Models\Integration;
use Livewire\Component;

class IntegrationForm extends Component
{
    public $id, $name, $slug;

    public function mount($slug = null)
    {
        $user = Integration::firstWhere('slug', $slug);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->slug = $user->slug;
    }
    public function render()
    {
        return view('livewire.integration.integration-form')
            ->title('Fomulir Aplikasi Integrasi');
    }
}
