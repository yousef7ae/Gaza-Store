<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideosEdit extends Component
{
    use WithFileUploads;

    public $video, $image, $imageTemp;

    function mount($id)
    {
        $video = Video::findOrFail($id);
        $this->video = $video->toArray();

    }

    public function update()
    {
        $this->validate([
            'video.title' => 'required',
            'video.url' => 'active_url',
            'video.description' => 'required',
            'video.image' => '',
        ]);
        if ($this->video['image']) {
            $this->validate([
                'image' => ''
            ]);
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->video['image'] = $this->imageTemp->store('videos');
        } else {
            unset($this->video['image']);
        }
        $video = Video::findOrFail($this->video['id']);
        $video->update($this->video);
        $this->emit('success', __('Video successfully update.'));
    }

    public function render()
    {
        return view('livewire.admin.videos.videos-edit');
    }
}
