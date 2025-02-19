<?php

namespace App\Http\Livewire\Admin\ArrestReceiptes;

use App\Models\ArrestReceipt;
use App\Models\Store;
use Hamcrest\Thingy;
use Livewire\Component;

class EditArrestReceipt extends Component
{
    public $arrest_receipt , $arrest_receipt_id , $stores ;
    public function mount($id)
    {
        $this->arrest_receipt_id = $id;
        $arrest_receipt = ArrestReceipt::findOrFail($this->arrest_receipt_id);
        $this->arrest_receipt = $arrest_receipt->toArray();
        $this->stores = Store::where('status', 1)->get();
    }

    public function update()
    {
        $validate = $this->validate([
            'arrest_receipt.store_id' => 'required',
            'arrest_receipt.amount' => 'required',
            'arrest_receipt.date' => 'required',

        ]);
        $arrest_receipt = ArrestReceipt::findOrFail($this->arrest_receipt_id);
        $arrest_receipt->update($this->arrest_receipt);
        $this->emit('success', __('Arrest Receipt successfully Updated.'));
    }
    public function render()
    {
        return view('livewire.admin.arrest-receiptes.edit-arrest-receipt');
    }
}
