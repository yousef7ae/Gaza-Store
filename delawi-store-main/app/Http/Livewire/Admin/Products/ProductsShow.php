<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Component;

class ProductsShow extends Component
{
    protected $listeners = ['refreshModal'];

    public $item, $product_id, $create_product_detail, $deleteId;


    function mount($id)
    {

        $this->item = Product::findOrFail($id);

    }

    public function EditModal($id)
    {
        $this->product_id = $id;
    }

    public function CreateProductDetail()
    {
        $this->create_product_detail = rand(0, 10000);
    }

    public function delete()
    {

        $coupons = ProductDetail::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('coupons delete')) {
            $this->emit('error', __('Coupon does not have the right permissions.'));
            return false;
        }

        $coupons->delete();
        $this->emit('success', __('coupons successfully Deleted.'));
    }

    public function refreshModal()
    {
        $this->product_id = "";
        $this->create_product_detail = "";
    }

    public function render()
    {
        return view('livewire.admin.products.products-show')->layout('livewire.admin.app');
    }
}
