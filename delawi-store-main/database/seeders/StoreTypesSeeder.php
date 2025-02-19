<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreType;

class StoreTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (StoreType::count() == 0)
        {
            StoreType::insert([
                ['name' => "Store",],
                ['name' => "Resturant",]
            ]);
        }
    }
}
