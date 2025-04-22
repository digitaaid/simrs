<?php

namespace App\Livewire\User;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class LogAktifitas extends Component
{
    use WithPagination;
    // public $logs;
    public function mount() {}
    public function render()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(20);
        return view('livewire.user.log-aktifitas', compact('logs'))->title('Log Aktifitas');
    }
}
