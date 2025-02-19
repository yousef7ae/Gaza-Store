<?php

namespace App\Http\Livewire\Admin\Stores;

use App\Models\Ad;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class StoresShow extends Component
{
    public $store, $models;

    function mount($id)
    {
        $this->store = Store::findOrFail($id);
    }

    public function render()
    {
        $products = Product::query();
        if (auth()->check()) {
            if (!auth()->user()->hasRole('Admin')) {
                $products = $products->where('user_id', auth()->id())->paginate(10);
            } else {
                $products = $products->paginate(10);
            }
        }

        $categories = Category::query();
        if (auth()->check()) {
            if (!auth()->user()->hasRole('Admin')) {
                $categories = $categories->where('user_id', auth()->id())->paginate(10);
            } else {
                $categories = $categories->paginate(10);
            }
        }

        $this->models = [
            'Users' => User::whereIn('id', $this->store->orders()->pluck('user_id')->toArray())->count(),
            'Category' => Category::whereHas('store', function ($q) {
                return $q->where('id', $this->store->id);
            })->count(),
            'Products' => Product::where('store_id', $this->store->id)->count(),
            'Coupons' => Coupon::where('store_id', $this->store->id)->count(),
            'Carts' => Cart::where('store_id', $this->store->id)->count(),
            'Orders' => Order::where('store_id', $this->store->id)->count(),
            'Brands' => Brand::where('store_id', $this->store->id)->count(),
            'Ads' => Ad::where('store_id', $this->store->id)->count(),
        ];
        return view('livewire.admin.stores.stores-show', compact('products', 'categories'))->layout('livewire.admin.app');
    }
}
