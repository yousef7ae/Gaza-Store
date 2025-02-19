<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideosCreate extends Component
{
    use WithFileUploads;

    public $video, $image, $imageTemp;


    public function mount()
    {


    }

    public function store()
    {
        $this->validate([
            'video.title' => 'required',
            'video.url' => 'active_url',
            'video.description' => 'required',
            'video.image' => '',
        ]);

        if ($this->imageTemp) {
            $this->video['image'] = $this->imageTemp->store('videos');
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
        } else {
            unset($this->video['image']);
        }

        $video = Video::create($this->video);
        $this->emit('success', __('Video successfully Added.'));
        $this->video = [];

    }

    public function render()
    {
        return view('livewire.admin.videos.videos-create');
    }
}
