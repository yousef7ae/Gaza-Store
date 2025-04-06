<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Products extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $store_id, $deleteId, $name, $description, $price, $code, $product_id, $header, $user_id;

    public function mount($id = null, $header = true, $store_id = null)
    {
        $this->id = $id;
        $this->header = $header;
        $this->store_id = $store_id;
    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditProduct($id)
    {
        $this->product_id = $id;
    }

    public function refreshModal()
    {
        $this->product_id = "";
    }

    public function delete()
    {
        $products = Product::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('categories delete')) {
            $this->emit('success', __('Product does not have the right permissions.'));
            return false;
        }

        $products->delete();
        $this->emit('success', __('Product successfully deleted.'));
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $categories = Product::findOrFail($this->Status);
        $categories->status = $status;

        $categories->save();
        session()->flash('success', __('Product successfully Active'));
    }

    public function inactive()
    {
        $status = '0';

        $categories = Product::findOrFail($this->Status);
        $categories->status = $status;

        $categories->save();

        session()->flash('success', __('Product successfully Inactive'));
    }

    public function render()
    {
        $products = Product::query();


        if (!auth()->user()->hasRole('Admin')) {
            $products = $products->where('user_id', auth()->id());
        }

        if ($this->name) {
            $products = $products->where("name", 'LIKE', "%" . $this->name . "%");
        }
        if ($this->description) {
            $products = $products->where("description", 'LIKE', "%" . $this->description . "%");
        }
        if ($this->price) {
            $products = $products->where("price", 'LIKE', "%" . $this->price . "%");
        }
        if ($this->code) {
            $products = $products->where("code", 'LIKE', "%" . $this->code . "%");
        }
        if ($this->user_id) {
            $products = $products->where("user_id", $this->user_id);
        }
        if ($this->store_id) {
            $products = $products->where("store_id", $this->store_id);
        }

        $products = $products->orderBy('created_at', "DESC")->paginate(10);

        // dd($products);

        return view('livewire.admin.products.products', compact('products'))->layout('livewire.admin.app');
    }
}
