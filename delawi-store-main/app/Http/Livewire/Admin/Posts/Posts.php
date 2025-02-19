<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $title, $description, $deleteId, $post_id, $image, $imageTemp, $create_post;

    public function search()
    {

    }

    function mount()
    {

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditPost($id)
    {
        $this->post_id = $id;
    }

    public function CreatePost()
    {
        $this->create_post = rand(0, 10000);
    }


    public function refreshModal()
    {
        $this->post_id = "";
        $this->create_post = "";
    }


    public function delete()
    {

        $posts = Post::findOrFail($this->deleteId);

        if (!auth()->user()->can('posts delete')) {
            $this->emit('error', __('Post does not have the right permissions.'));
            return false;
        }

        $posts->delete();
        $this->emit('success', __('Post successfully Deleted.'));


    }

    public function render()
    {
        $posts = Post::query();

        if ($this->description) {
            $posts = $posts->where('description', 'LIKE', '%' . $this->description . '%');
        }

        $posts = $posts->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.posts.posts', compact('posts'))->layout('livewire.admin.app');
    }
}
