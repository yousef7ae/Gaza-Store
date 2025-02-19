<?php

namespace App\Http\Livewire\Admin\Menus;

use App\Models\Submenu;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;

class MenusCreate extends Component
{

    public $menu = ['title' => "", 'order' => 0, 'submenus' => []];

    public function removeSubmenu($submenu_id)
    {

        unset($this->menu['submenus'][$submenu_id]);

    }

    function addSubmenu()
    {

        $this->menu['submenus'][] = [
            'name' => "",
            'url' => "",
            'order' => "",
        ];

    }

    public function store()
    {
        $this->validate([
            'menu.title.*' => 'required',
        ]);


        $menu = new Menu();
        $menu->title = $this->menu['title'];
        $menu->submenus = $this->menu['submenus'];
        $menu->order = $this->menu['order'];
        $menu->save();

        $this->emit('success', __('Menu  successfully Added.'));
        $this->menu = ['title' => "", 'order' => 0, 'submenus' => []];

    }


    public function render()
    {

        return view('livewire.admin.menus.menus-create')->layout('livewire.admin.app');
    }

}
