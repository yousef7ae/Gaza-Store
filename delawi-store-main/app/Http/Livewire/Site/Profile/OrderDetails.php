<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Page;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order, $deleteId;

    protected $listeners = ['refreshOrderDetails' => '$refresh'];


    public function mount($order_id = null)
    {
        $this->order = Order::find($order_id);
        $this->refreshOrderDetails();
    }

    function refreshOrderDetails()
    {

    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.order-details')->layout('livewire.'.env('THEME').'.app');
    }
}
