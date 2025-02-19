<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrdersShow extends Component
{
    public $order;

    protected $listeners = ['refreshOrderShow'];

    function mount($id)
    {
        $this->order = Order::findOrFail($id);
    }

    function refreshOrderShow()
    {
        $this->order = Order::findOrFail($this->order->id);
    }

    public function render()
    {
        return view('livewire.admin.orders.orders-show')->layout('livewire.admin.app');
    }
}
