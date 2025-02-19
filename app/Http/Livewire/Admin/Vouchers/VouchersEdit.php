<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;

class VouchersEdit extends Component
{
    public $voucher;

    function mount($id)
    {

        $voucher = Voucher::findOrFail($id);
        $voucher->expiration = date("Y-m-d\TH:s", strtotime($voucher->expiration));
        $this->voucher = $voucher->toArray();

    }

    public function update()
    {
        $this->validate([

            'voucher.code' => 'required',
            'voucher.value' => 'required|numeric',
            'voucher.count' => 'required|numeric',
            'voucher.type' => 'required|numeric',
            'voucher.used' => 'required|numeric',
//          'voucher.expiration' => 'date_format:Y-m-d H:i:s|required|unique:vouchers|required|after:yesterday',

        ]);


        $voucher = Voucher::findOrFail($this->voucher['id']);

        $voucher->update($this->voucher);
        $this->emit('success', __('Voucher successfully updated.'));

    }


    public function render()
    {


        return view('livewire.admin.vouchers.vouchers-edit')->layout('livewire.admin.app');
    }


}
