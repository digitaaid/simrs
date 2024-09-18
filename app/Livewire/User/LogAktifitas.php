<?php

namespace App\Livewire\User;

use App\Models\ActivityLog;
use Livewire\Component;

class LogAktifitas extends Component
{
    public $logs;
    public function mount()
    {
        $this->logs = ActivityLog::get();
    }
    public function render()
    {
        return view('livewire.user.log-aktifitas')->title('Log Aktifitas');
    }
}
