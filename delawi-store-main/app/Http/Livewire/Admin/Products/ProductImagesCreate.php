<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImagesCreate extends Component
{
    use WithFileUploads;

    public $search, $name, $image, $imageTemp, $path, $size, $ext, $user_id, $product_id, $array;

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
            'name' => 'required',
            'imageTemp' => 'required',

        ]);

        if ($this->imageTemp) {
            $this->validate([
//                'image' => 'file|image',
                'imageTemp' => 'required',
            ]);

        }

        $product_images = new ProductImage();
        $product_images->name = $this->name;

        if ($product_images->ext = null) {
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

        session()->flash('success', __('Product Image successfully Updated.'));

        if (!empty($this->array['redirect'])) {
            return redirect()->route($this->array['redirect'], $this->array['product_id']);
        }

        return redirect()->route('admin.products.show', $this->product_id);
    }


    public function render()
    {
        $products = Product::get();

        return view('livewire.admin.products.product-images-create', compact('products'))->layout('livewire.admin.app');
    }

}
