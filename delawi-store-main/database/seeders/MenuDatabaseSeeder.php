<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Database\Seeder;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::create([
            'title' => 'Header Menu',
            'order' => '1',
        ]);

        Submenu::insert([
            [ 'name' => 'Home',       'url' => '/',                  'order' => '1','menu_id' => $menu->id],
            [ 'name' => 'Stores',     'url' => '/stores',            'order' => '2','menu_id' => $menu->id],
            [ 'name' => 'Store Map',  'url' => '#',                  'order' => '3','menu_id' => $menu->id],
            [ 'name' => 'My Points',  'url' => '/profile/my-points', 'order' => '4','menu_id' => $menu->id],
            [ 'name' => 'Contacts',   'url' => '/contacts',          'order' => '5','menu_id' => $menu->id],
        ]);

        $menu = Menu::create([
            'title' => 'Sections',
            'order' => '2',
        ]);

        Submenu::insert([
            [ 'name' => 'Home',        'url' => '/',                  'order' => '1','menu_id' => $menu->id],
            [ 'name' => 'Stores',      'url' => '/stores',            'order' => '2','menu_id' => $menu->id],
            [ 'name' => 'My Cart',     'url' => '#',                  'order' => '3','menu_id' => $menu->id],
            [ 'name' => 'My Profile',  'url' => '/profile',            'order' => '4','menu_id' => $menu->id],
            [ 'name' => 'Favorite',    'url' => '/favorites',          'order' => '5','menu_id' => $menu->id],
        ]);

        $menu = Menu::create([
            'title' => 'Legals',
            'order' => '3',
        ]);

        Submenu::insert([
            [ 'name' => 'Switch Accounts',       'url' => '#',                          'order' => '1','menu_id' => $menu->id],
            [ 'name' => 'Privacy policy',        'url' => '/privacy-policy',            'order' => '2','menu_id' => $menu->id],
            [ 'name' => 'About Us',              'url' => '#',                          'order' => '3','menu_id' => $menu->id],
            [ 'name' => 'Contacts',              'url' => '/contacts',                  'order' => '4','menu_id' => $menu->id],
        ]);


    }
}
