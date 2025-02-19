<?php

namespace App\Http\Livewire\Admin\PaymentGateways;

use App\Models\PaymentGateway;
use Livewire\Component;

class PaymentGatewaysShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = PaymentGateway::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.payment-gateways.payment-gateways-show')->layout('livewire.admin.app');
    }

}
