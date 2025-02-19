<?php

namespace App\Http\Livewire\Admin\Users;
;

use App\Models\User;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $store_id, $deleteId, $name, $email, $role_id, $mobile, $status, $role, $user_id, $create_user, $Status;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
    }

    public function search()
    {
        if (array_key_exists(request('status'), User::statusList(false))) {
            $this->status = request('status');
        }
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function CreateUser()
    {
        $this->create_user = rand(0, 10000);
    }

    public function EditUser($id)
    {
        $this->user_id = $id;
    }

    public function refreshModal()
    {
        $this->user_id = "";
        $this->create_user = "";
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function acceptable()
    {
        $status = '1';

        $users = User::findOrFail($this->Status);
        $users->status = $status;

        $users->save();

        session()->flash('success', __('User successfully Accepted'));
    }

    public function disabled()
    {
        $status = '2';

        $users = User::findOrFail($this->Status);
        $users->status = $status;

        $users->save();

        session()->flash('success', __('User successfully Disabled'));
    }

    public function delete()
    {
        $categories = User::findOrFail($this->deleteId);

        if (!auth()->user()->can('users delete')) {
            session()->flash('danger', __('users does not have the right permissions.'));
            return redirect()->route('admin.users');
        }

        $categories->delete();
        session()->flash('success', __('users successfully Deleted.'));
        return redirect()->route('admin.users');
    }

    public function render()
    {
        $roles = Role::get();
        $users = User::query();

        if ($this->name) {
            $users = $users->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if ($this->email) {
            $users = $users->where("email", 'LIKE', "%" . $this->email . "%");
        }

        if ($this->store_id) {
            $store = Store::find($this->store_id);
            $store->delevaries;
            $users = $users->whereIn("id", $store->orders()->pluck('user_id')->toArray());
        }

        if ($this->mobile) {
            $users = $users->where("mobile", 'LIKE', "%" . $this->mobile . "%");
        }

        if ($this->role_id) {
            $users = $users->whereHas("roles", function ($q) {
                $q->where("id", $this->role_id);
            });
        }

        if (array_key_exists($this->status, User::statusList(false))) {
            $users = $users->where('status', $this->status);
        }

        $users = $users->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.users.users', compact('users', 'roles'))->layout('livewire.admin.app');
    }
}
