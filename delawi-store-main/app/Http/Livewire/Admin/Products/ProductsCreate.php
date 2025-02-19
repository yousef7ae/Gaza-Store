<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsCreate extends Component
{
    use WithFileUploads;

    public $product, $categories, $category_id, $user_id, $users, $stores, $brands, $imageTemp, $image;

    function mount()
    {
        $this->product['user_id'] = auth()->id();
//        $this->product['store_id'] = 0;
    }

    public function store()
    {
//        if (auth()->user()->hasRole('Admin')) {
            $this->validate([
                'product.name' => 'required',
                'product.price' => 'required|numeric',
                'product.code' => '',
                'product.description' => '',
                'product.order_status' => 'boolean',
                'product.most_wanted' => 'boolean',
                'product.new_product' => 'boolean',
                'product.image' => '',
                //'imageTemp' => 'required',
//                'product.store_id' => 'required|exists:stores,id',
                'product.category_id' => 'required|exists:categories,id',
            ]);
//        } else {
//
//            $store = Store::where('user_id', auth()->id())->first();
//            if ($store) {
//                $this->product['store_id'] = $store->id;
//            }
//
//            $this->validate([
//                'product.name' => 'required',
//                'product.price' => 'required|numeric',
//                'product.code' => '',
//                'product.description' => '',
//                'product.order_status' => 'boolean',
//                'product.most_wanted' => 'boolean',
//                'product.new_product' => 'boolean',
//                'product.store_id' => 'required|exists:stores,id',
//                'product.category_id' => 'required|exists:categories,id',
//                'product.brand_id' => '',
//                'product.image' => '',
//                //'imageTemp' => '',
//            ]);
//        }

//        if ($this->imageTemp) {
//            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
//            $this->product['image'] = $this->imageTemp->store('products');
//        }

        $this->product['user_id'] = $this->product['user_id'] ? $this->product['user_id'] : auth()->user()->id;

        $product = Product::create($this->product);

        $this->emit('success', __('Product  successfully Added.'));
        $this->product = ['user_id' => auth()->id()/*, 'store_id' => ''*/];
    }

    public function render()
    {

        $this->users =  User::whereHas('roles', function($q) {
            $q->whereIn('name',['admin','merchant']);
        })->get();

        $stores = Store::query();
        if (!auth()->user()->hasRole('Admin')) {
            $stores = $stores->where('user_id', auth()->id());
        }

        $this->stores = $stores->get();

        $categories = Category::query();

        if (!auth()->user()->hasRole('Admin')) {
            $categories = $categories->whereHas('categories_stores', function ($q) {
                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
            });
        }

        $this->categories = $categories->get();

        $this->brands = Brand::query();
        if (!auth()->user()->hasRole('Admin')) {
            $this->brands = $this->brands->whereHas('brands_stores', function ($q) {
                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
            });
        }

        $this->brands = $this->brands->get();

        return view('livewire.admin.products.products-create')->layout('livewire.admin.app');
    }
}

