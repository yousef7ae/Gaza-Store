<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;


class ChangeDelivery extends Component
{
    use WithFileUploads;

    public  $order_id, $delivery_id, $order, $users;

    function mount($order_id)
    {
        $this->order_id = $order_id;
        $this->order = Order::findOrFail($order_id);
    }

    public function update()
    {
        $this->validate([
            'delivery_id' => 'required',
        ]);

        if (!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Merchant')) {
            $this->emit('error', __('You do not have permission to edit the order.'));
            return false;
        }

        if (!$this->order->store) {
            $this->emit('error', __('Store not exist.'));
            return false;
        }

        if (!auth()->user()->hasRole('Admin') and !in_array($this->order->store->id, auth()->user()->stores()->pluck('id')->toArray())) {
            $this->emit('error', __('You do not have permission to edit the order.'));
            return false;
        }

        $this->order->delivery_id = $this->delivery_id;
        $this->order->status = 1;
        $this->order->save();

        $this->emit('success', __('Delivery successfully updated.'));
        $this->emit('refreshOrderShow');
    }

    public function render()
    {
        $this->users = User::role('Delivery')->where('status',1)->where('is_available',1)->get();
        return view('livewire.admin.orders.change-delivery')->layout('livewire.admin.app');
    }
}
