<?php

namespace App\Http\Livewire\Site\Auth;

use App\Models\Page;
use Livewire\Component;

class TermsAndConditions extends Component
{

    public $page;

    function mount()
    {
        $this->page = Page::where('slug', 'TERMS AND CONDITIONS')->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.auth.terms-and-conditions');
    }
}
