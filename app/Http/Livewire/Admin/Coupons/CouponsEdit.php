<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;

class CouponsEdit extends Component
{
    public $coupon = ['category_id' => 0 , 'store_id' =>0 , 'product_id' => null], $store_id, $products = [], $users = []  , $user_id, $categories = [], $stores = [], $brands = [], $category_id;

    function mount($id)
    {
        $coupon = Coupon::findOrFail($id);

//        if (!$coupon) {
//            abort('404');
//        }

        if ($this->coupon['store_id']) {
            $this->stores = Store::get();
            $this->products = Product::where('store_id', $this->coupon['store_id'])->get();
        }

        if ($this->coupon['category_id']) {
            $this->categories = Category::get();
            $this->products = Product::where('category_id', $this->coupon['category_id'])->get();
        }

//        if ($this->coupon['brand_id']) {
//            $this->brands = Brand::get();
//            $this->products = Product::where('brand_id', $this->coupon['brand_id'])->get();
//        }

        $this->coupon = $coupon->toArray();
    }

    public function update()
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
        $coupon = Coupon::findOrFail($this->coupon['id']);

        unset($this->coupon['type']);

        $coupon->update($this->coupon);
        $this->emit('success', __('Coupon successfully updated.'));
    }

    public function setProduct()
    {
        if ($this->coupon['store_id']){

            $this->products = Product::where('store_id',$this->coupon['store_id'])->get();

        }
        if ($this->coupon['category_id']) {

            $this->products = Product::where('status', 1)->where('category_id', $this->coupon['category_id'])->get();
        }

    }
    public function render()
    {
        return view('livewire.admin.coupons.coupons-edit')->layout('livewire.admin.app');
    }
}
