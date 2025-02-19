<?php

namespace App\Http\Livewire\Admin\Sliders;

use App\Models\Product;
use App\Models\Slider;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class SlidersCreate extends Component
{
    use WithFileUploads;

    public $slider = ['product_id' => 0, 'store_id' => 0], $image, $imageTemp, $stores, $products;

    public function mount()
    {
//        $this->slider['store_id'] = $this->store_id;

        if (auth()->user()->hasRole('Admin')) {
            $this->stores = Store::where('status', 1)->get();
        } else {
            $store = Store::where('user_id', auth()->id())->where('status', 1)->value('id');
            $this->slider['store_id'] = $store;
        }
    }

    public function store()
    {
        $this->validate([
            'slider.name' => 'required|string|max:255',
            'slider.image' => '',
            'slider.status' => '',
            'slider.store_id' => 'required|exists:stores,id'
        ]);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->slider['image'] = $this->imageTemp->store('sliders');
        } else {
            unset($this->slider['image']);
        }

        $store_id = $this->slider['store_id'];

        $user_id = Store::where('id', $store_id)->where('status', 1)->value('user_id');
        $this->slider['user_id'] = $user_id;

        if ($this->slider['product_id']) {
            $this->validate(['slider.product_id' => 'required|exists:products,id']);
        }

        if (!auth()->user()->hasRole('Admin')) {
            $this->slider['user_id'] = auth()->id();

            $store = Store::where('user_id', auth()->id())->first();
            if ($store) {
                $this->slider['store_id'] = $store->id;
            } else {
                $this->emit('error', __("There is no store at the moment"));
                return false;
            }
        }

//        $this->slider['store_id'] = $this->store_id;

        $slider = Slider::create($this->slider);
        $this->emit('success', __('Slider successfully Added.'));
        $this->slider = ['product_id' => 0, 'store_id' => 0];

    }


    public function render()
    {

        if ($this->slider['store_id']) {
            $this->products = Product::where('store_id', $this->slider['store_id'])->get();
        } else {
            $this->products = [];
            $this->slider['product_id'] = null;
        }
        return view('livewire.admin.sliders.sliders-create')->layout('livewire.admin.app');
    }

}
