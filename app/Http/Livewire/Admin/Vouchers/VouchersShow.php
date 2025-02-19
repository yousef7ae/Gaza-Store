<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;

class VouchersShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = Voucher::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.vouchers.vouchers-show')->layout('livewire.admin.app');
    }

}
