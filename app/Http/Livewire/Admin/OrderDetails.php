<?php

namespace App\Http\Livewire\Admin;

use App\Models\OrderDetail;
use Livewire\Component;

class OrderDetails extends Component
{
    public $search, $product_name, $qty, $price, $discount, $total, $order_id, $product_id, $user_id;

    public function delete($id)
    {

        $order_details = OrderDetail::findOrFail($id);

        if (!auth()->guard('admin')->user()->can('delete order_details')) {
            session()->flash('danger', __('OrderDetail does not have the right permissions.'));
            return redirect()->route('admin.order_details');
        }

        if ($order_details->id == 1) {
            session()->flash('danger', __('Can not delete OrderDetail.'));
            return redirect()->route('admin.order_details');
        }

        $order_details->delete();
        session()->flash('success', __('OrderDetail successfully Deleted.'));
        return redirect()->route('admin.order_details');

    }


    public function render()
    {
        $order_details = OrderDetail::query();

        if ($this->product_name) {
            $order_details = $order_details->where("product_name", 'LIKE', "%" . $this->product_name . "%");
        }

        if ($this->qty) {

            $order_details = $order_details->where("qty", 'LIKE', "%" . $this->qty . "%");
        }

        if ($this->price) {

            $order_details = $order_details->where("price", 'LIKE', "%" . $this->price . "%");
        }

        if ($this->discount) {

            $order_details = $order_details->where("discount", 'LIKE', "%" . $this->discount . "%");
        }

        if ($this->total) {

            $order_details = $order_details->where("total", 'LIKE', "%" . $this->total . "%");
        }


        $order_details = $order_details->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.order-details', compact('order_details'))->layout('livewire.admin.app');
    }

}
