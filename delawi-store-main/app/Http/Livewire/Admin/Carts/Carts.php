<?php

namespace App\Http\Livewire\Admin\Carts;


use App\Models\Cart;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Carts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $price, $qty, $total, $user_id, $product_id, $header, $cart_id, $deleteId,$store_id;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }


    public function refreshModal()
    {
        $this->cart_id = "";
    }

    public function mount($id = null, $header = true,$store_id = null)
    {
        $this->store_id = $store_id;
        $this->user_id = $id;
        $this->header = $header;
    }


    public function delete()
    {
        $carts = Cart::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('carts delete')) {
            $this->emit('error', __('Cart does not have the right permissions.'));
            return false;
        }
        $carts->delete();
        $this->emit('success', __('carts successfully Deleted.'));

    }


    public function render()
    {
        $carts = Cart::query();

        if (auth()->user()->hasRole('Merchant')) {
            $carts = $carts->where('store_id', auth()->user()->stores()->pluck('id')->toArray());
        }

        if ($this->price) {
            $carts = $carts->where("price", 'LIKE', "%" . $this->price . "%");
        }

        if ($this->qty) {
            $carts = $carts->where("qty", 'LIKE', "%" . $this->qty . "%");
        }
        if ($this->total) {
            $carts = $carts->where("price", 'LIKE', "%" . $this->price . "%");
        }

        if ($this->user_id) {
            $carts = $carts->where("user_id", $this->user_id);
        }

        if ($this->store_id) {
            $carts = $carts->where("store_id", $this->store_id);
        }

        if (!auth()->user()->hasRole("Admin")) {
            $carts = $carts->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
        }

        $carts = $carts->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.carts.carts', compact('carts'))->layout('livewire.admin.app');
    }


}
