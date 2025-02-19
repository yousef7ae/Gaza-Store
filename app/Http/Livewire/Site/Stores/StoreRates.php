<?php

namespace App\Http\Livewire\Site\Stores;

use App\Models\StoreRate;
use Livewire\Component;

class StoreRates extends Component
{

    protected $listeners = ['refreshModal'];

    public $store_rate, $store_rate_id, $store, $array;


    public function refreshModal()
    {

    }

    function mount($array = [])
    {
        if (!empty($array['store_rate_id'])) {
            $this->store_rate['store_id'] = $array['store_rate_id'];
        }
    }


    public function store()
    {
        $this->validate([
            'store_rate.rate' => 'required|in:0,1,2,3,4,5',
            'store_rate.comment' => 'required|string|min:1|max:2000',
        ]);

        $this->store_rate['user_id'] = auth()->user()->id;

        $store_rate = StoreRate::create($this->store_rate);
        $this->emit('success', 'Store Rate Successfully ');

    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.stores.store-rates')->layout('livewire.'.env('THEME').'.app');
    }

}
