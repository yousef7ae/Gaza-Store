<?php

namespace App\Http\Livewire\Admin\PaymentGateways;

use App\Models\PaymentGateway;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentGateways extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $description, $deleteId, $payment_gateway_id, $image, $imageTemp;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditPaymentGateway($id)
    {
        $this->payment_gateway_id = $id;
    }

    public function refreshModal()
    {
        $this->payment_gateway_id = "";
    }


    public function delete()
    {

        $payment_gateways = PaymentGateway::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('payment gateways delete')) {
            session()->flash('danger', __('PaymentGateway does not have the right permissions.'));
            return redirect()->route('admin.payment-gateways');
        }

        $payment_gateways->delete();
        session()->flash('success', __('PaymentGateway successfully Deleted.'));
        return redirect()->route('admin.payment-gateways');

    }

    public function render()
    {
        $payment_gateways = PaymentGateway::query();


        if ($this->name) {
            $payment_gateways = $payment_gateways->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $payment_gateways = $payment_gateways->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.payment-gateways.payment-gateways', compact('payment_gateways'))->layout('livewire.admin.app');
    }

}
