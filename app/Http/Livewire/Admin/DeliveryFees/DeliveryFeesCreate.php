<?php

namespace App\Http\Livewire\Admin\DeliveryFees;

use App\Models\DeliveryFee;
use Illuminate\Support\Str;
use Livewire\Component;

class DeliveryFeesCreate extends Component
{
    public $delivery_fee,$store_id;


    function mount($store_id = null)
    {
        $this->delivery_fee['store_id'] = $store_id;
    }

    public function store()
    {
        $this->validate([
            'delivery_fee.from' => 'required|numeric',
            'delivery_fee.to' => 'required|numeric',
            'delivery_fee.value' => 'required|numeric',
            'delivery_fee.store_id' => 'required|integer',
        ]);

        $delivery_fee = DeliveryFee::create($this->delivery_fee);

        $this->emit('success', __('DeliveryFee successfully Added.'));
        $this->delivery_fee = [];
    }


    public function render()
    {
        return view('livewire.admin.delivery-fees.delivery-fees-create')->layout('livewire.admin.app');
    }

}
