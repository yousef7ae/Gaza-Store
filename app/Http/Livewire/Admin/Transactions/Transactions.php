<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;

class Transactions extends Component
{

    public $search, $amount, $discount, $total, $status, $order_id, $buyer_id, $driver_id, $user_id, $header, $deleteId;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    function mount($id = null, $header = true)
    {
        $this->user_id = $id;
        $this->header = $header;
    }


    public function delete()
    {

        $transactions = Transaction::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('transactions delete')) {
            $this->emit('error', __('transactions does not have the right permissions.'));
            return false;
        }

        $transactions->delete();
        $this->emit('success', __('transactions successfully Deleted.'));

    }

    public function render()
    {
        $transactions = Transaction::query();

        if ($this->amount) {
            $transactions = $transactions->where("amount", 'LIKE', "%" . $this->amount . "%");
        }

        if ($this->discount) {

            $transactions = $transactions->where("discount", 'LIKE', "%" . $this->discount . "%");
        }

        if ($this->total) {

            $transactions = $transactions->where("total", 'LIKE', "%" . $this->total . "%");
        }

        if ($this->status) {

            $transactions = $transactions->where("status", 'LIKE', "%" . $this->status . "%");
        }

        if ($this->user_id) {

            $transactions = $transactions->where("user_id", $this->user_id);
        }


        $transactions = $transactions->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.transactions.transactions', compact('transactions'))->layout('livewire.admin.app');
    }

}
