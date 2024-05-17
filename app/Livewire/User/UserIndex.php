<?php

namespace App\Livewire\User;

use Livewire\Component;

class UserIndex extends Component
{
    public $title;
    public $content;

    public function save()
    {
        dd('test');
    }

    // public Invoice $invoice;

    public function download()
    {
        dd('test');

        // return response()->download(
        //     $this->invoice->file_path,
        //     'invoice.pdf'
        // );
    }

    public function render()
    {
        return view('livewire.user.user-index');
    }
}
