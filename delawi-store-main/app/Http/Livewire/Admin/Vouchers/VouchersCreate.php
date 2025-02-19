<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Illuminate\Support\Str;
use Livewire\Component;

class VouchersCreate extends Component
{
    public $voucher;


    function mount()
    {

        $this->voucher['code'] = Str::random();
    }

    public function store()
    {
        $this->validate([

            'voucher.code' => 'required',
            'voucher.value' => 'required|integer',
            'voucher.count' => 'required|numeric',
            'voucher.type' => 'required|integer',
            'voucher.used' => 'required|numeric',
//            'voucher.expiration' => 'date_format:Y-m-d H:i:s|required|unique:vouchers|required|after:yesterday',

        ]);

        $voucher = Voucher::create($this->voucher);

        $this->emit('success', __('Voucher successfully Added.'));
        $this->voucher = [];
    }


    public function render()
    {
        return view('livewire.admin.vouchers.vouchers-create')->layout('livewire.admin.app');
    }

}
