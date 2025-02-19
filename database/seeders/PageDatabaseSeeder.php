<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => ['en' => 'SIGN IN', 'ar' => ''],
            'slug' => 'SIGN IN',
            'description' => ['en' => 'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You.', 'ar' => ''],
            'image' => '../Dukkan/images/bg-login.png'
        ]);

        Page::create([
            'title' => ['en' => 'FORGET PASSWORD', 'ar' => ''],
            'slug' => 'FORGET PASSWORD',
            'description' =>  ['en' => 'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You.','ar' => ''],
            'image' => '../Dukkan/images/bg-Forget-Password.png'
        ]);

        Page::create([
            'title' => ['en' => 'TERMS AND CONDITIONS', 'ar' => ''],
            'slug' => 'TERMS AND CONDITIONS',
            'description' => ['en' =>'It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision. It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision. It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision. It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision. purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making you It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help gulde you before making your decision, It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision. It is important for us at Sbitany to make the purchasing process as easy as possible for you. For that reason we have created a few buying guides to help guide you before making your decision.','ar' => ''],
        ]);

        Page::create([
            'title' => ['en' => 'Update Password', 'ar' => ''],
            'slug' => 'Update Password',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You.', 'ar' => ''],
        ]);

        Page::create([
            'title' => ['en' => 'CREATE A NEW ACCOUNT', 'ar' => ''],
            'slug' => 'CREATE A NEW ACCOUNT',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You.','ar' => ''],
        ]);

        Page::create([
            'title' => ['en' => 'CHOOSE COUNTRY', 'ar' => ''],
            'slug' => 'CHOOSE COUNTRY',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You.','ar' => ''],
        ]);

        Page::create([
            'title' => ['en' => 'STORES', 'ar' => ''],
            'slug' => 'STORES',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-store.png'
        ]);

        Page::create([
            'title' => ['en' => 'Profile', 'ar' => ''],
            'slug' => 'Profile',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.', 'ar' => ''],
            'image' => '../Dukkan/images/bg-Profile.png'
        ]);

        Page::create([
            'title' => ['en' => 'Cart', 'ar' => ''],
            'slug' => 'Cart',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-favorites.png'
        ]);

        Page::create([
            'title' => ['en' => 'Check Out', 'ar' => ''],
            'slug' => 'Check Out',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-favorites.png'
        ]);

        Page::create([
            'title' => ['en' => 'Address', 'ar' => ''],
            'slug' => 'Address',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-favorites.png'
        ]);

        Page::create([
            'title' => ['en' => 'Edit Address', 'ar' => ''],
            'slug' => 'Edit Address',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-favorites.png'
        ]);

        Page::create([
            'title' => ['en' => 'Contacts Us', 'ar' => ''],
            'slug' => 'Contacts Us',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/bg-contacts.png'
        ]);

        Page::create([
            'title' => ['en' => 'Privacy Policy', 'ar' => ''],
            'slug' => 'Privacy Policy',
            'description' => ['en' =>'It Is Important For Us At Sbitany To Make The Purchasing Process As Easy As Possible For You. For That Reason We Have Created A Few Buying Guides To Help Guide You Before Making Your Decision.','ar' => ''],
            'image' => '../Dukkan/images/Privacy-Policy.png'
        ]);

        Page::create([
            'title' => ['en' => 'Subscribe To Our Newsletter &', 'ar' => ''],
            'slug' => 'Subscribe',
            'description' => ['en' =>'Receive Exclusive Offers Every Week','ar' => ''],
            'image' => '../Dukkan/images/apartment.png'
        ]);

        Page::create([
            'title' => ['en' => 'About Us', 'ar' => ''],
            'slug' => 'About Us',
            'description' => ['en' =>'About us page','ar' => ''],
            'image' => ''
        ]);
    }
}
