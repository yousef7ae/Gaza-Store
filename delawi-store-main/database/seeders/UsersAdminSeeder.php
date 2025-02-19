<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','oracle@email.com')->first();
        if(!$user) {
            $user = User::create([
                'name' => "Admin Account",
                'email' => 'oracle@email.com',
                'password' => Hash::make("Admin@123!@#"),
                'status' => 1
            ]);
        }

        $user->assignRole('Admin');
    }
}
