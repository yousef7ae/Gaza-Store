<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\ProductImage;
use Livewire\Component;

class ProductImages extends Component
{
    protected $listeners = ['refreshModal'];

    public $search, $deleteId, $name, $path, $size, $ext, $user_id, $product_id, $product_image_id, $array;

    function mount($array = [])
    {
        $this->array = $array;

        if (!empty($array['product_id'])) {
            $this->product_id = $array['product_id'];
        }
    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditModal($id)
    {
        $this->product_image_id = $id;
    }

    public function refreshModal()
    {
        $this->product_image_id = "";
    }

    public function delete()
    {

        $product_images = ProductImage::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('products images delete')) {
            $this->emit('error', __('Product Image does not have the right permissions.'));
            return false;
        }

        $product_images->delete();
        $this->emit('success', __('Product Image successfully Deleted.'));

    }


    public function render()
    {
        $product_images = ProductImage::query();

        if ($this->name) {

            $product_images = $product_images->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if ($this->user_id) {

            $product_images = $product_images->where("user_id", $this->user_id);
        }

        if ($this->path) {

            $product_images = $product_images->where("path", 'LIKE', "%" . $this->path . "%");
        }

        if ($this->size) {

            $product_images = $product_images->where("size", 'LIKE', "%" . $this->size . "%");
        }

        if ($this->ext) {
            $product_images = $product_images->where("ext", 'LIKE', "%" . $this->ext . "%");
        }


        if (!empty($this->array['user_id'])) {
            $product_images = $product_images->where("user_id", $this->array['user_id']);
        }

        if (!empty($this->array['product_id'])) {
            $product_images = $product_images->where("product_id", $this->array['product_id']);
        }

        $product_images = $product_images->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.products.product-images', compact('product_images'))->layout('livewire.admin.app');
    }

}
