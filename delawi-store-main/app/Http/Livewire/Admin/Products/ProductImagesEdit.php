<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImagesEdit extends Component
{
    use WithFileUploads;

    public $search, $id_, $name, $image, $imageTemp, $path, $size, $ext, $user_id, $product_id, $array;

    function mount($id)
    {

        $this->id_ = $id;
        $product_images = ProductImage::findOrFail($this->id_);
        $this->name = $product_images->name;
        $this->product_id = $product_images->product_id;
        $this->image = $product_images->image;
        $this->user_id = auth()->user()->id;


    }

    public function update()
    {
        $this->validate([
            'name' => 'required',

        ]);

        if ($this->imageTemp) {
            $this->validate([
//                'image' => 'file|image',
                'image' => '',
            ]);

        }

        $product_images = ProductImage::findOrFail($this->id_);
        $product_images->name = $this->name;
        if ($product_images->size = null) {
            $product_images->size = $this->imageTemp->getSize();
        }

        if ($product_images->ext = null) {
            $product_images->ext = $this->imageTemp->getClientOriginalExtension();
        }

        $product_images->product_id = $this->product_id;
        $product_images->user_id = auth()->guard('web')->user()->id;

        if ($this->imageTemp) {
            $product_images->image = $this->imageTemp->store('ProductImages/' . $product_images->id);
            $product_images->path = $product_images->image;
        }

        $product_images->save();

        session()->flash('message', __('Product Image successfully Added.'));

        if (!empty($this->array['redirect'])) {
            return redirect()->route($this->array['redirect'], $this->array['product_id']);
        }

        return redirect()->route('admin.products.show', $this->product_id);

    }


    function render()
    {
        $products = Product::get();

        return view('livewire.admin.products.product-images-edit', compact('products'))->layout('livewire.admin.app');
    }


}
