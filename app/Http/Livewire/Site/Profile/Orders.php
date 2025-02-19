<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    public $deleteId;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $orders = Order::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('orders delete')) {
            $this->emit('error', __('Order does not have the right permissions.'));
            return false;
        }

        $orders->status= 5;
        $orders->save();
        $this->emit('success', __('Order successfully Cancel.'));

    }

    public function render()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('livewire.'.env('THEME').'.profile.orders', compact('orders'))->layout('livewire.'.env('THEME').'.app');
    }
}
