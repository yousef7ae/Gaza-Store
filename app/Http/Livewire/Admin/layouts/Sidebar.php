<?php

namespace App\Http\Livewire\Admin\layouts;

use Livewire\Component;

class Sidebar extends Component
{

//    protected $listeners = ['refreshModal'];
//
//
//    public function refreshModal()
//    {
//
//    }

    public function render()
    {
        return view('livewire.admin.sidebar')->layout('livewire.admin.app');
    }
}
