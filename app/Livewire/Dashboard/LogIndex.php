<?php

namespace App\Livewire\Dashboard;

use App\Models\ActivityLog;
use Livewire\Component;

class LogIndex extends Component
{
    public $logs;
    public function mount()
    {
        $this->logs = ActivityLog::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(50)->get();
    }
    public function render()
    {
        return view('livewire.dashboard.log-index');
    }
}
