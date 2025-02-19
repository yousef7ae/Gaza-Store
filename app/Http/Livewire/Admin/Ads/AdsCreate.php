<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use App\Models\Notification;
use App\Models\Product;
use App\Models\RecentUpdate;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdsCreate extends Component
{
    use WithFileUploads;

    public $ad = [], $store_id, $image, $imageTemp, $recent_update, $notification, $stores = [], $products = [];

    function mount($store_id = null)
    {

//        $this->ad['store_id'] = $store_id;
//
//        if (auth()->user()->hasRole('Admin')) {
//            $this->stores = Store::where('status', 1)->get();
//        } else {
//            $store = Store::where('user_id', auth()->id())->where('status', 1)->value('id');
//            $this->ad['store_id'] = $store;
//        }
    }

    public function store()
    {
        $this->validate([
            'ad.title' => 'required|string',
            'imageTemp' => 'image|mimes:jpg,jpeg,png,jpg,gif|max:2048',
//            'ad.store_id' => 'required|exists:stores,id',
//            'ad.product_id' => 'required|exists:products,id',
            'ad.description' => '',
            'ad.date' => '',
            'ad.status' => '',
        ]);

        $this->imageTemp->store('ads');
        $this->ad['image'] = 'ads/' . $this->imageTemp->hashName();

        if (!auth()->user()->hasRole('Admin')) {
            $this->ad['user_id'] = auth()->id();
        }

        $ad = Ad::create($this->ad);
        $this->emit('success', __('Ad successfully Added.'));
//        $this->ad = ['store_id' => 0, 'product_id' => 0];
    }

    public function render()
    {
//       if (!auth()->user()->hasRole("Admin")) {
//            $store = Store::where('user_id', auth()->id())->first();
//            if ($store) {
//                $this->ad['store_id'] = $store->id;
//            }
//        }
//
//        if ($this->ad['store_id']) {
//            $this->products = Product::where('store_id', $this->ad['store_id'])->get();
//        } else {
//            $this->products = [];
//            $this->ad['product_id'] = null;
//        }
        return view('livewire.admin.ads.ads-create')->layout('livewire.admin.app');
    }
}
