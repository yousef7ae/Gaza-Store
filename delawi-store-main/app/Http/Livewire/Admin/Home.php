<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ad;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Models\Address;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Home extends Component
{

    public $models;

    public function mount()
    {

        if (auth()->user()->hasRole('Admin')) {
            $this->models = [
                'Roles' => Role::count(),
                'Users' => User::count(),
                'Stores' => Store::count(),
                'Category' => Category::count(),
                'Products' => Product::count(),
                'Coupons' => Coupon::count(),
                'Vouchers' => Voucher::count(),
                'Carts' => Cart::count(),
                'Orders' => Order::count(),
                'Transactions' => Transaction::count(),
                'Brands' => Brand::count(),
                'Ads' => Ad::count(),
            ];
        } elseif (auth()->user()->hasRole('Merchant')) {
            $this->models = [
                'Stores' => Store::where('user_id', auth()->id())->count(),
                'Category' => Category::where('user_id', auth()->id())->count(),
                'Products' => Product::where('user_id', auth()->id())->count(),
                'Coupons' => Coupon::where('user_id', auth()->id())->count(),
                'Carts' => Cart::where('user_id', auth()->id())->count(),
                'Orders' => Order::where('user_id', auth()->id())->count(),
                'Transactions' => Transaction::where('user_id', auth()->id())->count(),
                'Brands' => Brand::where('user_id', auth()->id())->count(),
            ];
        } elseif (auth()->user()->hasRole('Delivery')) {
            $this->models = [
                'Address' => Address::where('user_id', auth()->id())->count(),
                'Orders' => Order::where('user_id', auth()->id())->count(),
                'Transactions' => Transaction::where('user_id', auth()->id())->count(),
            ];
        } elseif (auth()->user()->hasRole('Customer')) {
            $this->models = [
                'Orders' => Order::where('user_id', auth()->id())->count(),
                'Transactions' => Transaction::where('user_id', auth()->id())->count(),
            ];
        } else {
            $this->models = [];
        }

    }

    public function render()
    {
        return view('livewire.admin.home')->layout('livewire.admin.app');
    }
}
