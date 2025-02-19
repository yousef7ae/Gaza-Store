<?php

namespace App\Http\Livewire\Site;

use App\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $page, $posts;

    public function mount($slug)
    {
        $this->posts = Post::limit(12)->orderBy('created_at', "ASC")->get();
        $this->page = \App\Models\Page::where('slug', $slug)->orWhere('id', $slug)->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.page')->layout('livewire.'.env('THEME').'.app');
    }
}
