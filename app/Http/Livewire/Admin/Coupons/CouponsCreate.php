<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;

class CouponsCreate extends Component
{
    public $coupon = ['category_id' => 0 , 'store_id' =>0 , 'product_id' => null], $store_id, $products = [], $product_id, $users = [], $user_id, $categories = [], $stores = [], $brands = [], $category_id;

    function mount($store_id = null)
    {
        $this->store_id = $store_id;

        if (auth()->user()->hasRole('Admin')) {
            $this->products = Product::get();
            $this->stores = Store::where('status', 1)->get();
            $this->categories = Category::where('status', 1)->get();
            $this->users = User::get();

        } else {
            $this->products = Product::whereHas('store', function ($q) {
                return $q->whereIn('stores.id', auth()->user()->stores()->pluck('id')->toArray());
            })->get();
            $this->categories = Category::whereHas('store', function ($q) {
                return $q->whereIn('stores.id', auth()->user()->stores()->pluck('id')->toArray());
            })->get();
        }

        if ($this->store_id) {
            $this->products = Product::whereHas('store', function ($q) {
                return $q->where('id', $this->store_id);
            })->get();
        }
    }

    public function store()
    {
        $this->validate([
            'coupon.code' => 'required',
            'coupon.value' => 'required|numeric',
            // 'coupon.product_id' => 'nullable'/*|exists:products,id*/,
            'coupon.expiration' => 'required|date',
            // 'coupon.category_id' => 'nullable'/*|exists:categories,id*/,
            // 'coupon.store_id' => 'nullable'/*|exists:stores,id*/,
//            'coupon.brand_id' => 'nullable'/*|exists:brands,id*/,

        ]);

        if (!auth()->user()->hasRole('Admin')) {
            $this->coupon['user_id'] = auth()->id();
        }

        // $this->product = Product::where('id', $this->coupon['product_id'])->first();
        // $this->store_id = $this->product->store_id;

        $this->coupon['count'] = 0;

        Coupon::create($this->coupon);

        $this->emit('success', __('Coupon  successfully Added.'));
        $this->emit('refresh');
        $this->coupon = [];
    }

    public function setProduct()
    {
        if ($this->coupon['store_id']){
            $this->products = Product::where('store_id',$this->coupon['store_id'])->get();
        }
        if ($this->coupon['category_id']) {
            $this->products = Product::where('category_id', $this->coupon['category_id'])->get();
        }
    }

    public function render()
    {
//        $this->stores = Store::where('status', 1)->get();
//        $this->categories = Category::where('status', 1)->get();
////        $this->brands = Brand::get();


        return view('livewire.admin.coupons.coupons-create')->layout('livewire.admin.app');
    }
}
