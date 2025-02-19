<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductDetailsEdit extends Component
{
    use WithFileUploads;

    public $search, $id_, $value, $unit, $price, $user_id, $product_id, $array, $image, $imageTemp;

    function mount($id)
    {

        $this->id_ = $id;
        $product_details = ProductDetail::findOrFail($this->id_);
        $this->value = $product_details->value;
        $this->price = $product_details->price;
        $this->unit = $product_details->unit;
        $this->product_id = $product_details->product_id;
        $this->user_id = auth()->user()->id;


    }

    public function update()
    {
        $this->validate([
            'price' => 'required',
            'unit' => 'required',
        ]);
        if ($this->imageTemp) {
            $this->validate([
                'image' => '',
            ]);
        }

        $product_details = ProductDetail::findOrFail($this->id_);

        $product_details->value = $this->value;
        $product_details->price = $this->price ? $this->price : 0;
        $product_details->unit = $this->unit;
        $product_details->value = $this->value;
        $product_details->product_id = $this->product_id;
        $product_details->user_id = auth()->guard('web')->user()->id;
        if ($this->imageTemp) {
            $product_details->image = $this->imageTemp->store('ProductImages/' . $product_details->id);
            $product_details->path = $product_details->image;
        }

        $product_details->save();

        session()->flash('message', __('ProductDetail successfully Added.'));

        if (!empty($this->array['redirect'])) {
            return redirect()->route($this->array['redirect'], $this->array['product_id']);
        }

        return redirect()->route('admin.products.show', $this->product_id);
    }


    public function render()
    {
        $products = Product::get();

        return view('livewire.admin.products.product-details-edit', compact('products'))->layout('livewire.admin.app');
    }

}
