<?php

namespace App\Http\Livewire\Admin\DeliveryMethods;

use App\Models\DeliveryMethod;
use Livewire\Component;
use Livewire\WithFileUploads;

class DeliveryMethodsEdit extends Component
{
    use WithFileUploads;

    public $payment_gateway, $image, $imageTemp;

    function mount($id)
    {

        $payment_gateway = DeliveryMethod::findOrFail($id);
        $this->payment_gateway = $payment_gateway->toArray();
    }

    public function update()
    {
        $this->validate([
            'payment_gateway.name' => 'required|string',
            'payment_gateway.description' => '',
            'payment_gateway.image' => '',
        ]);
        if ($this->payment_gateway['image']) {
            $this->validate([
                'image' => ''
            ]);
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->payment_gateway['image'] = $this->imageTemp->store('delivery_methods');
        } else {
            unset($this->payment_gateway['image']);
        }

        $payment_gateway = DeliveryMethod::findOrFail($this->payment_gateway['id']);


        $payment_gateway->update($this->payment_gateway);
        $this->emit('success', __('PaymentGateway successfully updated.'));
    }


    public function render()
    {
        return view('livewire.admin.delivery-methods.delivery-methods-edit')->layout('livewire.admin.app');
    }

}
