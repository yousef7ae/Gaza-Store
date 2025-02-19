<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductDetailsCreate extends Component
{
    use WithFileUploads;
    public $search, $value, $unit, $price = 0, $user_id, $product_id, $array, $imageTemp, $image;

    function mount($array)
    {
        $this->array = $array;
        if (!empty($array['product_id'])) {
            $this->product_id = $array['product_id'];
        }
    }

    public function store()
    {
        $this->validate([

            'value' => 'required',
            //'price' => 'required',
            'unit' => 'required',
//            'imageTemp' => 'required',
        ]);
        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
        }


        $product_details = new ProductDetail();
        $product_details->value = $this->value;
        $product_details->unit = $this->unit;
        $product_details->price = $this->price ? $this->price: 0;
        $product_details->product_id = $this->product_id;
        $product_details->user_id = auth()->guard('web')->user()->id;
        if ($this->imageTemp) {
            $product_details->image = $this->imageTemp->store('ProductImages/' . $product_details->id);
            $product_details->path = $product_details->image;
        }

        $product_details->save();

        session()->flash('success', __('ProductDetail successfully Updated.'));

        if (!empty($this->array['redirect'])) {
            return redirect()->route($this->array['redirect'], $this->array['product_id']);
        }

        return redirect()->route('admin.products.show', $this->product_id);
    }


    public function render()
    {
        $products = Product::get();
        return view('livewire.admin.products.product-details-create', compact('products'))->layout('livewire.admin.app');
    }

}
