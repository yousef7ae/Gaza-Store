<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class CouponsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = Coupon::where('user_id', auth()->id())->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.coupons.coupons-show')->layout('livewire.admin.app');
    }

}
