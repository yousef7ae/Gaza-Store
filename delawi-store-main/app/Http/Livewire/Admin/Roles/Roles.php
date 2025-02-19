<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModalRoles'];


    public $search, $name, $deleteId, $role_id;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditModal($id)
    {
        $this->role_id = $id;
    }

    public function refreshModalRoles()
    {
        $this->role_id = "";
    }


    public function delete()
    {

        $roles = Role::findOrFail($this->deleteId);

        if (!auth()->user()->can('roles delete')) {
            session()->flash('danger', __('Role does not have the right permissions.'));
            return redirect()->route('admin.roles');
        }
        $roles->delete();
        session()->flash('success', __('Role successfully Deleted.'));
        return redirect()->route('admin.roles');

    }

    public function render()
    {
        $roles = Role::query();

        if ($this->name) {
            $roles = $roles->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $roles = $roles->orderBy('name', "ASC")->paginate(10);
        return view('livewire.admin.roles.roles', compact('roles'))->layout('livewire.admin.app');
    }

}
