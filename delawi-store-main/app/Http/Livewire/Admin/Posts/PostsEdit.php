<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;

class PostsEdit extends Component
{

    public $post;

    function mount($id)
    {
        $post = Post::findOrFail($id);
        $this->post = $post->toArray();

    }

    public function update()
    {
        $this->validate([
            'post.description' => 'required',
        ]);

        $post = Post::findOrFail($this->post['id']);
        $post->update($this->post);
        $this->emit('success', __('Post successfully update.'));
    }


    public function render()
    {

        return view('livewire.admin.posts.posts-edit')->layout('livewire.admin.app');
    }

}
