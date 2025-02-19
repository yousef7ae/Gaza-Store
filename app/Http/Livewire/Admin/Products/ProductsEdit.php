<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsEdit extends Component
{
    use WithFileUploads;

    public $product, $categories, $category_id, $user_id, $product_id, $users, $stores, $brands, $imageTemp, $image;

    function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->product = $product->toArray();
    }

    public function update()
    {
        $this->validate([
            'product.name' => 'required',
            'product.price' => 'required|numeric',
            'product.code' => '',
            'product.order_status' => '',
            'product.new_product' => '',
            'product.most_wanted' => '',
            'product.image' => '',
            'product.old_price' => '',
            'product.description' => '',
            'product.category_id' => 'nullable|exists:categories,id',
//            'product.brand_id' => 'nullable|exists:brands,id',
        ]);

        $this->product['user_id'] = $this->product['user_id'] ? $this->product['user_id'] : auth()->user()->id;

        $product = Product::findOrFail($this->product['id']);
        $product->update($this->product);
        $this->emit('success', __('Product successfully updated.'));
    }

    public function render()
    {

//        $this->users =  User::whereHas('roles', function($q) {
//            $q->whereIn('name',['admin','merchant']);
//        })->get();

//        $stores = Store::query();
//        if (!auth()->user()->hasRole('Admin')) {
//            $stores = $stores->where('user_id', auth()->id());
//        }
//        $this->stores = $stores->get();

        $categories = Category::query();
//
//        if (!auth()->user()->hasRole('Admin')) {
//            $categories = $categories->whereHas('categories_stores', function ($q) {
//                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
//            });
//        }

        $this->categories = $categories->get();

//        $this->brands = Brand::query();
//        if (!auth()->user()->hasRole('Admin')) {
//            $this->brands = $this->brands->whereHas('brands_stores', function ($q) {
//                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
//            });
//        }

//        $this->brands = $this->brands->get();

        return view('livewire.admin.products.products-edit')->layout('livewire.admin.app');
    }
}
