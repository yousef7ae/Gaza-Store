<?php

namespace App\Http\Livewire\Admin\Stores;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;
use Nnjeim\World\Models\Currency;

class StoresCurrency extends Component
{
    use WithFileUploads;

    public $store = [], $currencies = [],$currency_id , $currencyDefault;

    function mount($store_id)
    {
        $this->store = Store::findOrFail($store_id);
        $this->currencies = \App\Models\Currency::get();

        $this->currencyDefault = \App\Models\Currency::where('code' , 'LYD')->first();

        $this->currency_id = $this->store->currency_id;
    }

    public function update()
    {
        $store = Store::findOrFail($this->store->id);

//        $store->currency_id= $this->currencyDefault ? $this->currencyDefault->id : $this->currency_id;

        $store->currency_id = $this->currency_id;
        $store->save();
        $this->emit('success', __('Store successfully updated.'));
    }

    function render()
    {
        return view('livewire.admin.stores.stores-currency')->layout('livewire.admin.app');
    }
}
