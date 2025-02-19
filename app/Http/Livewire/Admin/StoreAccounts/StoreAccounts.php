<?php

namespace App\Http\Livewire\Admin\StoreAccounts;

use App\Models\StoreAccount;
use Livewire\Component;

class StoreAccounts extends Component
{
    public $store_accounts;
    public function mount()
    {
        $this->store_accounts = StoreAccount::all();

    }
    public function byStore($id)
    {
        $this->store_accounts = StoreAccount::where('store_id', $id)->get();
    }
    public function render()
    {
        return view('livewire.admin.store-accounts.store-accounts')
            ->layout('livewire.admin.app');
    }
}
