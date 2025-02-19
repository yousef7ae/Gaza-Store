<?php

namespace App\Http\Livewire\Admin\DeliveryFees;

use App\Models\DeliveryFee;
use Livewire\Component;

class DeliveryFeesEdit extends Component
{
    public $delivery_fee;

    function mount($id)
    {

        $delivery_fee = DeliveryFee::findOrFail($id);
        $delivery_fee->expiration = date("Y-m-d\TH:s", strtotime($delivery_fee->expiration));
        $this->delivery_fee = $delivery_fee->toArray();

    }

    public function update()
    {
        $this->validate([

            'delivery_fee.from' => 'required|numeric',
            'delivery_fee.to' => 'required|numeric',
            'delivery_fee.value' => 'required|numeric',
            'delivery_fee.store_id' => 'required|integer',

        ]);


        $delivery_fee = DeliveryFee::findOrFail($this->delivery_fee['id']);

        $delivery_fee->update($this->delivery_fee);
        $this->emit('success', __('DeliveryFee successfully updated.'));

    }


    public function render()
    {


        return view('livewire.admin.delivery-fees.delivery-fees-edit')->layout('livewire.admin.app');
    }


}
