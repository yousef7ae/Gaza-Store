<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesCreate extends Component
{

    public $role = [], $roles = [], $permissions = [], $permission, $permissionsList = [], $allPermissions;

    function mount()
    {

        $this->roles = Role::get();

        $allPermissions = Permission::get();

        foreach ($allPermissions as $permission) {

            $explode = explode(' ', $permission->name);
            if (!empty($explode[2])) {
                $key = $explode[0] . ' ' . $explode[1];
                $name = __($explode[2]);
            } elseif (!empty($explode[1])) {
                $key = $explode[0];
                $name = __($explode[1]);
            } else {
                $key = "global";
                $name = __($explode[0]);
            }

            $this->allPermissions[$key][] = ['id' => $permission->id, 'name' => $name];
        }

    }

    public function store()
    {
        $this->validate([
            'role.name' => 'required|min:3',
        ]);

        $role = Role::create($this->role);
        $role->syncPermissions($this->permissionsList);

        session()->flash('success', __('Role successfully Added.'));
        return redirect()->route('admin.roles');
    }

    public function render()
    {
        return view('livewire.admin.roles.roles-create')->layout('livewire.admin.app');
    }

}
