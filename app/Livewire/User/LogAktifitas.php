<?php

namespace App\Livewire\User;

use App\Models\ActivityLog;
use Livewire\Component;

class LogAktifitas extends Component
{
    public $logs;
    public function render()
    {
        $this->logs = ActivityLog::orderBy('created_at', 'desc')->get();
        return view('livewire.user.log-aktifitas')->title('Log Aktifitas');
    }
}
