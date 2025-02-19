<?php

namespace App\Http\Livewire\Admin\DeliveryFees;

use App\Models\DeliveryFee;
use Livewire\Component;

class DeliveryFeesShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = DeliveryFee::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.delivery-fees.delivery-fees-show')->layout('livewire.admin.app');
    }

}
