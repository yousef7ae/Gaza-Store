<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use App\Models\Product;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdsEdit extends Component
{
    use WithFileUploads;

    public $ad = [], $image, $imageTemp, $stores = [], $products = [];

    function mount($id)
    {
        $ad = Ad::findOrFail($id);
        $this->ad = $ad->toArray();

//        if (auth()->user()->hasRole('Admin')) {
//            $this->stores = Store::where('status', 1)->get();
//        } else {
//            $store = Store::where('user_id', auth()->id())->where('status', 1)->value('id');
//            $this->ad['store_id'] = $store;
//        }
    }

    public function update()
    {
        $this->validate([
            'ad.title' => 'required|string',
//            'ad.store_id' => 'required|exists:stores,id',
//            'ad.product_id' => 'required|exists:products,id',
            'ad.description' => '',
            'ad.date' => '',
            'ad.status' => '',
        ]);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpg,jpeg,png,jpg,gif|max:2048']);
            $this->imageTemp->store('ads');
            $this->ad['image'] = 'ads/' . $this->imageTemp->hashName();

//            $this->ad['image'] = 'ads/' . $this->imageTemp->hashName();
//            $this->imageTemp->store('ads');
        }

        $ad = Ad::findOrFail($this->ad['id']);
        $ad->update($this->ad);
        $this->emit('success', __('Ad successfully Updated.'));
    }

    public function render()
    {
//        if ($this->ad['store_id']) {
//            $this->products = Product::where('store_id', $this->ad['store_id'])->get();
//        } else {
//            $this->products = [];
//            $this->ad['product_id'] = null;
//        }

        return view('livewire.admin.ads.ads-edit')->layout('livewire.admin.app');
    }
}
