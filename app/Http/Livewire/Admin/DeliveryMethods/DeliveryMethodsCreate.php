<?php

namespace App\Http\Livewire\Admin\DeliveryMethods;

use App\Models\DeliveryMethod;
use Livewire\Component;
use Livewire\WithFileUploads;

class DeliveryMethodsCreate extends Component
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
            $this->payment_gateway['image'] = $this->imageTemp->store('delivery_methods');
        } else {
            unset($this->payment_gateway['image']);
        }

        $payment_gateway = DeliveryMethod::create($this->payment_gateway);


        $this->emit('success', __('PaymentGateway successfully Added.'));
        $this->payment_gateway = [];

    }


    public function render()
    {
        return view('livewire.admin.delivery-methods.delivery-methods-create')->layout('livewire.admin.app');
    }

}
