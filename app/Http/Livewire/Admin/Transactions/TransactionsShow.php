<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;

class TransactionsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = Transaction::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.transactions.transactions-show')->layout('livewire.admin.app');
    }

}
