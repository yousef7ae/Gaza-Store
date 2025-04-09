<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\User;
use App\Models\Point;
use App\Models\Setting;
use App\Models\OrderUser;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $store_id, $search, $note, $order_number, $total, $discount, $coupon, $user_id,$status, $Status,$buyer_id, $driver_id, $order_id, $deleteId;
    public $orderstotals ,$points, $points_customer, $points_delivery, $points_merchant;

    public function mount($store_id = null,$user_id = null)
    {
        $this->store_id = $store_id;
        $this->user_id = $user_id;
        $this->points_customer = ($setting = Setting::where('name', "points_customer")->first()) ? $setting->value : '';
        $this->points_delivery = ($setting = Setting::where('name', "points_delivery")->first()) ? $setting->value : '';
        $this->points_merchant = ($setting = Setting::where('name', "points_merchant")->first()) ? $setting->value : '';
        $user = User::findOrFail(auth()->id());
        $this->points=$user->points;
    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function refreshModal()
    {
        $this->order_id = "";
    }


    public function Status($id)
    {
        $this->Status = $id;
    }
    public function active()
    {
        $status = 1;
        $cities = Order::findOrFail($this->Status);
        $cities->status = $status;
        $cities->save();
        $this->emit('success', __('Order successfully Active'));
    }

    public function inactive()
    {

        $status = 0;
        $cities = Order::findOrFail($this->Status);
        $cities->status = $status;
        $cities->save();
        $this->emit('success', __('Order successfully Inactive'));

    }

    public function delete()
    {

        $orders = Order::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('orders delete')) {
            $this->emit('error', __('Order does not have the right permissions.'));
            return false;
        }

        $orders->delete();
        $this->emit('success', __('Order successfully Deleted.'));
    }

    public function render()
    {
        $orders = Order::query();
        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');

        if (auth()->user()->hasRole('Delivery') and request('delivery') and request('status') != "1") {
            $ordersIDS = OrderUser::where('user_id', auth()->id())->pluck('order_id')->toArray();
            $orders = $orders->whereNotIn('id', $ordersIDS)->whereNull('delivery_id');

        } elseif (auth()->user()->hasRole('Delivery')) {
            $orders = $orders->where('delivery_id', auth()->id());

        } else if (auth()->user()->hasRole('Merchant') /*and request('merchant')*/) {
            $orders = $orders->where('store_id', auth()->user()->stores()->pluck('id')->toArray());

        } else {
            if (auth()->user()->hasRole('Customer')) {
                $orders = $orders->where('user_id', auth()->id());
            }
        }

        if ($this->order_number) {
            $orders = $orders->where("order_number", 'LIKE', "%" . $this->order_number . "%");
        }

        if ($this->store_id) {
            $orders = $orders->where("store_id", $this->store_id);
        }

        if ($this->user_id) {
            $orders = $orders->where("user_id", $this->user_id);
        }

        if ($this->note) {
            $orders = $orders->where("note", 'LIKE', "%" . $this->note . "%");
        }

        if ($this->total) {
            $orders = $orders->where("total", 'LIKE', "%" . $this->total . "%");
        }

        if ($this->discount) {
            $orders = $orders->where("discount", 'LIKE', "%" . $this->discount . "%");
        }

        if ($this->coupon) {
            $orders = $orders->where("coupon", 'LIKE', "%" . $this->coupon . "%");
        }

        $orders = $orders->orderBy('created_at', "DESC")->paginate(10);

        if (auth()->user()->hasRole('Delivery')) {
            // foreach($orders->where('status',3) as $orderstotal){
            //     $this->orderstotals=$this->orderstotals + $orderstotal->total;
            //     if($orderstotal->total > 0 && $orderstotal->active_delivery == null){
            //         $point = new Point();
            //         $point->user_id = auth()->id();
            //         $point->order_id = $orderstotal->id;
            //         $point->status = "1";

            //         $order = Order::findOrFail($orderstotal->id);
            //         $order->active_delivery = "1";

            //         $user = User::findOrFail(auth()->id());
            //         $user->points = $this->orderstotals/$this->points_delivery;
            //         $user->update();

            //         $order->update();
            //         $point->save();
            //     }
            // }

        } else if (auth()->user()->hasRole('Merchant')) {
            // foreach($orders->where('status',3) as $orderstotal){
            //     $this->orderstotals=$this->orderstotals + $orderstotal->total;
            //     if($orderstotal->total > 0 && $orderstotal->active_merchant == null){
            //         $point = new Point();
            //         $point->user_id = auth()->id();
            //         $point->order_id = $orderstotal->id;
            //         $point->status = "1";

            //         $order = Order::findOrFail($orderstotal->id);
            //         $order->active_merchant = "1";
            //         $user = User::findOrFail(auth()->id());
            //         $user->points = $this->orderstotals/$this->points_merchant;
            //         $user->update();
            //         $order->update();
            //         $point->save();
            //     }
            // }

        } else {
            if (auth()->user()->hasRole('Customer')) {
                foreach($orders->where('status',3) as $orderstotal){
                    $this->orderstotals=$this->orderstotals + $orderstotal->total;
                    if($orderstotal->total > 0  && $orderstotal->active_customer == "0"){
                        $point = new Point();
                        $point->user_id = auth()->id();
                        $point->order_id = $orderstotal->id;
                        $point->status = "1";

                        $order = Order::findOrFail($orderstotal->id);
                        $order->active_customer = "1";
                        $user = User::findOrFail(auth()->id());
                        $user->points = $this->orderstotals/$this->points_customer;
                        $user->update();
                        $order->update();
                        $point->save();
                    }
                }
            }
        }

        return view('livewire.admin.orders.orders', compact('orders'))->layout('livewire.admin.app');
    }
}
