<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\ProductDetail;
use Livewire\Component;

class ProductDetails extends Component
{
    protected $listeners = ['refreshModal'];

    public $search, $deleteID, $name, $value, $unit, $price, $user_id, $product_detail_id, $product_id, $array, $create_product_detail;


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
        $this->deleteID = $id;
    }

    public function CreateProductDetail()
    {
        $this->create_product_detail = rand(0, 10000);
    }

    public function EditModalProductDetail($id)
    {
        $this->product_detail_id = $id;
    }

    public function refreshModal()
    {
        $this->product_detail_id = "";
        $this->create_product_detail = "";
    }


    public function deleteDetail()
    {

        $ProductDetail = ProductDetail::findOrFail($this->deleteID);

        $product_id = $ProductDetail->product->id;

        $ProductDetail->delete();
        session()->flash('success', __('product-details successfully Deleted.'));
        return redirect()->route('admin.products.show', $product_id);

    }


    public function render()
    {
        $product_details = ProductDetail::query();


        if ($this->value) {

            $product_details = $product_details->where("value", 'LIKE', "%" . $this->value . "%");
        }

        if ($this->unit) {

            $product_details = $product_details->where("unit", 'LIKE', "%" . $this->unit . "%");
        }

        if ($this->price) {
            $product_details = $product_details->where("price", 'LIKE', "%" . $this->price . "%");
        }

        if (!empty($this->array['user_id'])) {
            $product_details = $product_details->where("user_id", $this->array['user_id']);
        }

        if (!empty($this->array['product_id'])) {
            $product_details = $product_details->where("product_id", $this->array['product_id']);
        }

        $product_details = $product_details->orderBy('created_at', "DESC")->paginate(30);

        return view('livewire.admin.products.product-details', compact('product_details'))->layout('livewire.admin.app');
    }

}
