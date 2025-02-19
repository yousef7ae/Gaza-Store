<?php

namespace App\Http\Livewire\Admin;

use App\Models\OrderDetail;
use Livewire\Component;

class OrderDetailsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = OrderDetail::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.order-details-show')->layout('livewire.admin.app');
    }

}
