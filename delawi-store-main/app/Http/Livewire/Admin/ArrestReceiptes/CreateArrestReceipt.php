<?php

namespace App\Http\Livewire\Admin\ArrestReceiptes;

use App\Models\ArrestReceipt;
use App\Models\Store;
use App\Models\StoreAccount;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CreateArrestReceipt extends Component
{
     public $arrest_receipt = [] , $stores ;
    public function mount()
    {
        $this->stores = Store::where('status', 1)->get();
    }

    public function store()
    {
        $validate = $this->validate([
            'arrest_receipt.store_id' => 'required',
            'arrest_receipt.amount' => 'required',
            'arrest_receipt.date' => 'required',
        ]);
       $arrest_receipt =  ArrestReceipt::create($this->arrest_receipt);

        $store_account = StoreAccount::create([
            'store_id' => $this->arrest_receipt['store_id'],
            'amount' => -1 * $this->arrest_receipt['amount'],
            'arrest_receipt_id' => $arrest_receipt->id,
            'date' => Carbon::now()
        ]);

        $this->emit('success', __('Arrest Receipt successfully Created.'));

    }
    public function render()
    {
        return view('livewire.admin.arrest-receiptes.create-arrest-receipt');
    }
}
