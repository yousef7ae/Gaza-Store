<?php

namespace App\Http\Livewire\Site;

use App\Models\Contact;
use App\Models\Page;
use Livewire\Component;

class Contacts extends Component
{

    public $contact, $page;

    public function mount()
    {
        $this->page = Page::where('slug', 'Contacts Us')->first();
    }

    public function store()
    {
        $this->validate([
            'contact.name' => 'required|string|max:255',
            'contact.email' => 'required|email|max:255',
            'contact.subject' => 'required|string|max:500',
            'contact.message' => 'required|min:3|max:2000',
        ]);

        $contact = Contact::create($this->contact);
        $this->emit('alertSuccess', __('success sent'));

        $this->contact = [];

    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.contacts')->layout('livewire.'.env('THEME').'.app');
    }

}
