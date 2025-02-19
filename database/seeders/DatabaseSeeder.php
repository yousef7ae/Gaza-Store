<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PermissionsSeeder::class);
         $this->call(UsersAdminSeeder::class);
         $this->call(StoreTypesSeeder::class);
//         $this->call(MenuDatabaseSeeder::class);
//         $this->call(PageDatabaseSeeder::class);
//        $this->call(WorldSeeder::class);
    }
}
