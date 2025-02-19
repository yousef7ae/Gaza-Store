<?php

namespace App\Http\Livewire\Admin\Sliders;

use App\Models\Product;
use App\Models\Slider;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class SlidersEdit extends Component
{
    use WithFileUploads;

    public $slider, $image, $imageTemp, $stores, $products;

    function mount($id)
    {
        $slider = Slider::findOrFail($id);
        $this->slider = $slider->toArray();

        if (auth()->user()->hasRole('Admin')) {
            $this->stores = Store::where('status', 1)->get();
        } else {
            $store = Store::where('user_id', auth()->id())->where('status', 1)->value('user_id');
            $this->slider['store_id'] = $store;
        }
    }

    public function update()
    {
        $this->validate([
            'slider.name' => 'required|max:255|string',
            'slider.image' => '',
            'slider.status' => '',
            'slider.store_id' => 'required|exists:stores,id'
        ]);

        if ($this->image) {
            $this->validate(['image' => '']);
        }
        if ($this->slider['url']) {
            $this->validate(['slider.url' => 'active_url']);
        }

        $this->validate(['slider.store_id' => 'required|exists:stores,id']);
        $store = Store::where('id', $this->slider['store_id'])->where('status', 1)->value('user_id');
        $this->slider['user_id'] = $store;

        if ($this->slider['product_id']) {
            $this->validate(['slider.product_id' => 'required|exists:products,id']);
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->slider['image'] = $this->imageTemp->store('sliders');
        } else {
            unset($this->slider['image']);
        }

        if (!auth()->user()->hasRole('Admin')) {
            $this->slider['user_id'] = auth()->id();
        }

        $slider = Slider::findOrFail($this->slider['id']);

        $slider->update($this->slider);
        $this->emit('success', __('Slider successfully update.'));
    }

    public function render()
    {
        if ($this->slider['store_id']) {
            $this->products = Product::where('store_id', $this->slider['store_id'])->get();
        } else {
            $this->products = [];
            $this->slider['product_id'] = null;
        }

        return view('livewire.admin.sliders.sliders-edit')->layout('livewire.admin.app');
    }
}
