<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class Vouchers extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $deleteId, $code, $voucher_id;


    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditVoucher($id)
    {
        $this->voucher_id = $id;
    }

    public function refreshModal()
    {
        $this->voucher_id = "";
    }


    public function delete()
    {

        $vouchers = Voucher::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('vouchers delete')) {
            $this->emit('error', __('Voucher does not have the right permissions.'));
            return false;
        }

        $vouchers->delete();
        $this->emit('success', __('vouchers successfully Deleted.'));
    }


    public function render()
    {
        $vouchers = Voucher::query();

        if ($this->code) {
            $vouchers = $vouchers->where("code", 'LIKE', "%" . $this->code . "%");
        }

        $vouchers = $vouchers->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.vouchers.vouchers', compact('vouchers'))->layout('livewire.admin.app');
    }

}
