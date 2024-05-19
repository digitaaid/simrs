<?php

namespace App\Livewire\Integration;

use Livewire\Component;

class IntegrationIndex extends Component
{
    public function render()
    {
        return view('livewire.integration.integration-index')
            ->title('Aplikasi Integrasi');
    }
}
