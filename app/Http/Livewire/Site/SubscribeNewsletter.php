<?php

namespace App\Http\Livewire\Site;

use App\Models\Page;
use App\Models\Subscribe;
use App\Models\SubscribeNews;
use Livewire\Component;

class SubscribeNewsletter extends Component
{

    public $user, $page;

    public function mount()
    {
        $this->page = Page::where('slug', 'Subscribe')->first();
    }

    public function store()
    {
        $this->validate([
            'user.email' => 'required|email|max:255|unique:subscribe_news,email',
        ]);

        $user = SubscribeNews::create($this->user);
        $this->emit('alertSuccess',  __('Subscribed successfully'));
        $this->user = [];
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.subscribe-newsletter')->layout('livewire.'.env('THEME').'.app');
    }
}
