<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\ProductDetail;
use Livewire\Component;

class ProductDetailsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = ProductDetail::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.products.product-details-show')->layout('livewire.admin.app');
    }

}
