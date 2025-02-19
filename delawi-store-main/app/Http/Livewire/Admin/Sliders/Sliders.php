<?php

namespace App\Http\Livewire\Admin\Sliders;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $url, $deleteId, $slider_id, $image, $imageTemp, $status, $Status, $create_slider,$store_id;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;

        if (array_key_exists(request('status'), Slider::statusList(false))) {
            $this->status = request('status');
        }
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

        $sliders = Slider::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();

        session()->flash('success', __('slider successfully Active'));

    }

    public function inactive()
    {

        $status = '0';

        $sliders = Slider::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();

        session()->flash('success', __('slider successfully Inactive'));
    }

    public function end()
    {

        $status = '2';

        $sliders = Slider::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();

        session()->flash('success', __('slider successfully Awaiting review'));
    }

    public function EditSlider($id)
    {
        $this->slider_id = $id;
    }

    public function CreateSlider()
    {
        $this->create_slider = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->slider_id = "";
        $this->create_slider = "";
    }

    public function delete()
    {
        $sliders = Slider::findOrFail($this->deleteId);

        if (!auth()->user()->can('sliders delete')) {
            session()->flash('danger', __('Sliders does not have the right permissions.'));
            return redirect()->route('admin.sliders');
        }

        $sliders->delete();
        session()->flash('success', __('Sliders successfully Deleted.'));
        return redirect()->route('admin.sliders');
    }

    public function render()
    {
        $sliders = Slider::query();

        if ($this->store_id) {
            $sliders = $sliders->whereHas('store', function ($q) {
                return $q->where('id', $this->store_id);
            });
        }

        if ($this->name) {
            $sliders = $sliders->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->url) {
            $sliders = $sliders->where('url', 'LIKE', '%' . $this->url . '%');
        }

        if (array_key_exists($this->status, Slider::statusList(false))) {
            $sliders = $sliders->where('status', $this->status);
        }

        $sliders = $sliders->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.sliders.sliders', compact('sliders'))->layout('livewire.admin.app');
    }
}
