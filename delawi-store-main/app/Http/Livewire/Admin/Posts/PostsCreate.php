<?php

namespace App\Http\Livewire\Admin\Posts;


use App\Models\Post;
use Livewire\Component;

class PostsCreate extends Component
{

    public $post;


    public function mount()
    {


    }

    public function store()
    {
        $this->validate([
            'post.description' => 'required',
        ]);

        $post = Post::create($this->post);
        $this->emit('success', __('Post  successfully Added.'));
        $this->post = [];

    }


    public function render()
    {
        return view('livewire.admin.posts.posts-create')->layout('livewire.admin.app');
    }

}
