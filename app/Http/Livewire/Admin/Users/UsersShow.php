<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersShow extends Component
{

    public $user;

    function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.users.users-show')->layout('livewire.admin.app');
    }
}
