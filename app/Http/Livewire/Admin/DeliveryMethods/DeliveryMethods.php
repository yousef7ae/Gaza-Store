<?php

namespace App\Http\Livewire\Admin\DeliveryMethods;

use App\Models\DeliveryMethod;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveryMethods extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $description, $deleteId, $delivery_method_id, $image, $imageTemp;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditDeliveryMethod($id)
    {
        $this->delivery_method_id = $id;
    }

    public function refreshModal()
    {
        $this->delivery_method_id = "";
    }

    public function delete()
    {
        $payment_gateways = DeliveryMethod::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('payment gateways delete')) {
            session()->flash('danger', __('PaymentGateway does not have the right permissions.'));
            return redirect()->route('admin.deliveryـmethods');
        }

        $payment_gateways->delete();
        session()->flash('success', __('PaymentGateway successfully Deleted.'));
        return redirect()->route('admin.deliveryـmethods');
    }

    public function render()
    {
        $payment_gateways = DeliveryMethod::query();


        if ($this->name) {
            $payment_gateways = $payment_gateways->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $payment_gateways = $payment_gateways->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.delivery-methods.delivery-methods', compact('payment_gateways'))->layout('livewire.admin.app');
    }
}
