<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class Coupons extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $store_id, $deleteId, $code, $products, $product_id, $users, $user_id, $coupon_id, $Status;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
    }

    public function search()
    {

    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function acceptable()
    {
        $status = '1';

        $coupon = Coupon::findOrFail($this->Status);
        $coupon->status = $status;

        $coupon->save();

        session()->flash('success', __('Coupon successfully Accepted'));
    }

    public function disabled()
    {
        $status = '0';

        $coupon = Coupon::findOrFail($this->Status);
        $coupon->status = $status;

        $coupon->save();

        session()->flash('success', __('Coupon successfully Disabled'));
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditCoupon($id)
    {
        $this->coupon_id = $id;
    }

    public function refreshModal()
    {
        $this->coupon_id = "";
    }

    public function delete()
    {
        $coupons = Coupon::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('coupons delete')) {
            $this->emit('error', __('Coupon does not have the right permissions.'));
            return false;
        }

        $coupons->delete();
        $this->emit('success', __('coupons successfully Deleted.'));
    }

    public function render()
    {
        $coupons = Coupon::query();

        if (!auth()->user()->hasRole('Admin')) {
            $coupons = $coupons->where('user_id', auth()->id());
        }

        if ($this->store_id) {
            $coupons = $coupons->whereHas("store", function ($q) {
                return $q->where('store_id', $this->store_id);
            });
        }

        if ($this->code) {
            $coupons = $coupons->where("code", 'LIKE', "%" . $this->code . "%");
        }

        $coupons = $coupons->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.coupons.coupons', compact('coupons'))->layout('livewire.admin.app');
    }
}
