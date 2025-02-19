<?php

namespace App\Http\Livewire\Admin\PaymentGateways;

use App\Models\PaymentGateway;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentGatewaysCreate extends Component
{
    use WithFileUploads;

    public $payment_gateway, $image, $imageTemp;


    public function store()
    {
        $this->validate([
            'payment_gateway.name' => 'required|string',
            'payment_gateway.description' => '',
            'payment_gateway.image' => '',
        ]);
        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->payment_gateway['image'] = $this->imageTemp->store('payment_gateways');
        } else {
            unset($this->payment_gateway['image']);
        }

        $payment_gateway = PaymentGateway::create($this->payment_gateway);


        $this->emit('success', __('PaymentGateway successfully Added.'));
        $this->payment_gateway = [];

    }


    public function render()
    {
        return view('livewire.admin.payment-gateways.payment-gateways-create')->layout('livewire.admin.app');
    }

}
