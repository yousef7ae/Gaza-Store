<?php

namespace App\Http\Livewire\Admin\Orders;
use App\Models\Order;
use App\Models\OrderUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;


class DeliveryStatus extends Component
{

    use WithFileUploads;

    public  $order_id, $delivery_status, $order, $users;

    function mount($order_id)
    {
        $this->order_id=$order_id;
        $this->order = Order::findOrFail($order_id);

    }

    public function update()
    {
        $this->validate([
            'delivery_status' => 'required',
        ]);
        if(!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Merchant')){
            $this->emit('error', __('You do not have permission to edit the order.'));
            return false;
        }

        if(!$this->order->store){
            $this->emit('error', __('Store not exist.'));
            return false;
        }

        if(!auth()->user()->hasRole('Admin') and !in_array($this->order->store->id, auth()->user()->stores()->pluck('id')->toArray())){
            $this->emit('error', __('You do not have permission to edit the order.'));
            return false;
        }


        $this->order->delivery_status=$this->delivery_status;
        $this->order->save();

        $this->emit('success', __('Delivery successfully updated.'));
        $this->emit('refreshOrderShow');


    }


    public function render()
    {

        $this->users = User::role('Delivery')->get();
        return view('livewire.admin.orders.delivery-status')->layout('livewire.admin.app');
    }
}
