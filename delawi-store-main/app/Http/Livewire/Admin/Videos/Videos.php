<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class Videos extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $title, $url, $deleteId, $video_id, $image, $imageTemp, $status, $Status, $create_video, $description;

    public function mount()
    {

    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $videos = Video::findOrFail($this->Status);
        $videos->status = $status;

        $videos->save();

        session()->flash('success', __('video successfully Active'));

    }

    public function inactive()
    {

        $status = '0';

        $videos = Video::findOrFail($this->Status);
        $videos->status = $status;

        $videos->save();

        session()->flash('success', __('video successfully Inactive'));

    }

    public function EditVideo($id)
    {
        $this->video_id = $id;
    }

    public function CreateVideo()
    {
        $this->create_video = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->video_id = "";
        $this->create_video = "";
    }


    public function delete()
    {

        $videos = Video::findOrFail($this->deleteId);

        if (!auth()->user()->can('videos delete')) {
            session()->flash('danger', __('Videos does not have the right permissions.'));
            return redirect()->route('admin.videos');
        }

        $videos->delete();
        session()->flash('success', __('Videos successfully Deleted.'));
        return redirect()->route('admin.videos');

    }

    public function render()
    {
        $videos = Video::query();


        if ($this->title) {
            $videos = $videos->where('title', 'LIKE', '%' . $this->title . '%');
        }

        if ($this->url) {
            $videos = $videos->where('description', 'LIKE', '%' . $this->description . '%');
        }

        $videos = $videos->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.videos.videos', compact('videos'))->layout('livewire.admin.app');
    }

}
