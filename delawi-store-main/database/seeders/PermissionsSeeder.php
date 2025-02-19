<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $permissionsList = [

            'users show',
            'users create',
            'users edit',
            'users delete',

            'roles show',
            'roles create',
            'roles edit',
            'roles delete',

            'stores categories show',
            'stores categories create',
            'stores categories edit',
            'stores categories delete',

            'stores show',
            'stores create',
            'stores edit',
            'stores delete',

            'categories show',
            'categories create',
            'categories edit',
            'categories delete',

            'products show',
            'products create',
            'products edit',
            'products delete',

            'products details show',
            'products details create',
            'products details edit',
            'products details delete',

            'products images show',
            'products images create',
            'products images edit',
            'products images delete',

            'address show',
            'address create',
            'address edit',
            'address delete',

            'sliders show',
            'sliders create',
            'sliders edit',
            'sliders delete',

            'coupons show',
            'coupons create',
            'coupons edit',
            'coupons delete',

            'vouchers show',
            'vouchers create',
            'vouchers edit',
            'vouchers delete',

            'brands show',
            'brands create',
            'brands edit',
            'brands delete',

            'ads show',
            'ads create',
            'ads edit',
            'ads delete',

            'payment gateways show',
            'payment gateways create',
            'payment gateways edit',
            'payment gateways delete',

            'delivery methods show',
            'delivery methods create',
            'delivery methods edit',
            'delivery methods delete',

            'menus show',
            'menus create',
            'menus edit',
            'menus delete',

            'pages show',
            'pages create',
            'pages edit',
            'pages delete',

            'faqs show',
            'faqs create',
            'faqs edit',
            'faqs delete',

            'posts show',
            'posts create',
            'posts edit',
            'posts delete',

            'countries show',
            'countries create',
            'countries edit',
            'countries delete',

            'videos show',
            'videos create',
            'videos edit',
            'videos delete',

            'cities show',
            'cities create',
            'cities edit',
            'cities delete',

            'delivery fees show',
            'delivery fees create',
            'delivery fees edit',
            'delivery fees delete',

            'carts show',
            'carts delete',

            'orders show',
            'orders delete',

            'transactions show',
            'transactions delete',

            'subscribes new show',
            'subscribes new delete',

            'contacts show',
            'contacts delete',

            'arrest-receipts show',
            'arrest-receipts create',
            'arrest-receipts edit',
            'arrest-receipts delete',

            'store-accounts show',

            'settings show',
            ];

        $roles = [
            'Admin' => $permissionsList,
//            'Merchant' => [
//
//                'stores show',
//                'stores create',
//                'stores edit',
//                'stores delete',
//
//                'categories show',
//                'categories create',
//                'categories edit',
//                'categories delete',
//
//                'products show',
//                'products create',
//                'products edit',
//                'products delete',
//
//                'products details show',
//                'products details create',
//                'products details edit',
//                'products details delete',
//
//                'products images show',
//                'products images create',
//                'products images edit',
//                'products images delete',
//
//                'address show',
//                'address create',
//                'address edit',
//                'address delete',
//
//                'coupons show',
//                'coupons create',
//                'coupons edit',
//                'coupons delete',
//
//                'vouchers show',
//                'vouchers create',
//                'vouchers edit',
//                'vouchers delete',
//
//                'brands show',
//                'brands create',
//                'brands edit',
//                'brands delete',
//
//                'ads show',
//                'ads create',
//                'ads edit',
//                'ads delete',
//
//                'carts show',
//                'carts delete',
//
//                'orders show',
//                'orders delete',
//
//                'transactions show',
//                'transactions delete',
//
//                'delivery fees show',
//                'delivery fees create',
//                'delivery fees edit',
//                'delivery fees delete',
//
//            ],
//            'Delivery' => [
//
//                'address show',
//                'address create',
//                'address edit',
//                'address delete',
//
//                'orders show',
//
//                'transactions show',
//                'transactions delete',
//
//            ],
            'Customer' => [
                'orders show',
                'transactions show',
                'transactions delete',
            ]
        ];

        foreach ($roles as $role => $permissions) {
            $Role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                Permission::findOrCreate($permission);
                $Role->syncPermissions(Permission::whereIn('name', $permissions)->get());
            }
        }
    }
}
