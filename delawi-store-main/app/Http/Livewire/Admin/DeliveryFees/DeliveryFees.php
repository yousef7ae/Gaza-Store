<?php

namespace App\Http\Livewire\Admin\DeliveryFees;

use App\Models\DeliveryFee;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveryFees extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $deleteId, $code, $delivery_fee_id,$store_id;

    function mount($store_id = null){
        $this->store_id = $store_id;
    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditDeliveryFee($id)
    {
        $this->delivery_fee_id = $id;
    }

    public function refreshModal()
    {
        $this->delivery_fee_id = "";
    }


    public function delete()
    {

        $delivery_fees = DeliveryFee::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('delivery_fees delete')) {
            $this->emit('error', __('DeliveryFee does not have the right permissions.'));
            return false;
        }

        $delivery_fees->delete();
        $this->emit('success', __('delivery_fees successfully Deleted.'));
    }


    public function render()
    {
        $delivery_fees = DeliveryFee::query();

        if ($this->code) {
            $delivery_fees = $delivery_fees->where("code", 'LIKE', "%" . $this->code . "%");
        }
        if ($this->store_id) {
            $delivery_fees = $delivery_fees->where("store_id", $this->store_id );
        }

        $delivery_fees = $delivery_fees->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.delivery-fees.delivery-fees', compact('delivery_fees'))->layout('livewire.admin.app');
    }

}
