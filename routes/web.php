<?php

use App\Http\Livewire\Site\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/fcm', [\App\Http\Controllers\HomeController::class, 'index'])->name('fcm');
//Route::patch('/fcm-token', [\App\Http\Controllers\HomeController::class, 'updateToken'])->name('fcmToken');
//Route::any('/send-notification', [\App\Http\Controllers\HomeController::class, 'notification'])->name('notification');
//
//Route::get('api/v1/google_login', [\App\Http\Controllers\UserController::class, 'google_login']);
//Route::get('api/v1/facebook_login', [\App\Http\Controllers\UserController::class, 'facebook_login']);
//Route::get('/pages/{slug}', \App\Http\Livewire\Site\Page::class)->name('site.page');
//Route::get('/categories', \App\Http\Livewire\Site\Categories\Categories::class)->name('site.categories');
//Route::get('/', \App\Http\Livewire\Site\Products\ProductConstant::class)->name('site.constant');
//
//Route::middleware('localization')->group(function () {
//
//    Route::middleware('guest')->group(function () {
//
//        Route::get('/login', \App\Http\Livewire\Site\Auth\Login::class)->name('login');
//        Route::get('/register', \App\Http\Livewire\Site\Auth\Register::class)->name('register');
//        Route::get('/reset-password', \App\Http\Livewire\Site\Auth\ResetPassword::class)->name('reset-password');
//        Route::get('/auth-password', \App\Http\Livewire\Site\Auth\ResetPassword::class)->name('auth.password');
//        Route::get('/update-password', \App\Http\Livewire\Site\Auth\UpdatePassword::class)->name('password.reset');
//
//
//        Route::get('auth/facebook/redirect', [\App\Http\Controllers\FacebookController::class, 'redirect'])->name('auth.facebook.redirect');
//        Route::get('auth/facebook/callback', [\App\Http\Controllers\FacebookController::class, 'handleCallback']);
//
//        Route::get('auth/google/redirect', [\App\Http\Controllers\GoogleController::class, 'redirect'])->name('auth.google.redirect');
//        Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleCallback']);
//
//    });
//
//    Route::get('/', \App\Http\Livewire\Site\Home::class)->name('home');
//    Route::get('/products/{product_id}', \App\Http\Livewire\Site\Products\Product::class)->name('product');
//    Route::any('/logout', \App\Http\Livewire\Site\Auth\Login::class)->name('logout');
//    Route::get('/favorites', \App\Http\Livewire\Site\Favorites\Favorites::class)->name('favorites');
//    Route::get('/carts', \App\Http\Livewire\Site\Carts\Carts::class)->name('carts');
//    Route::get('/checkout', \App\Http\Livewire\Site\Carts\Checkout::class)->middleware('auth')->name('checkout');
//    Route::get('/contacts', \App\Http\Livewire\Site\Contacts::class)->name('contacts');
//
//    Route::middleware(['auth'])->prefix('profile')->group(function () {
//        Route::get('/', \App\Http\Livewire\Site\Profile\PersonalInformation::class)->name('profile');
//        Route::get('/orders', \App\Http\Livewire\Site\Profile\Orders::class)->name('profile.orders');
//        Route::get('/orders/{order_id}', \App\Http\Livewire\Site\Profile\OrderDetails::class)->name('profile.orders_details');
//        Route::get('/my-points', \App\Http\Livewire\Site\Profile\MyPoints::class)->name('profile.my-points');
//        Route::get('/settings', \App\Http\Livewire\Site\Profile\Settings::class)->name('profile.settings');
//    });
//
//    //Stores
//    Route::get('/stores', \App\Http\Livewire\Site\Stores\StoresArchive::class)->name('stores');
//    Route::get('/stores/{slug}', \App\Http\Livewire\Site\Stores\StoresSingle::class)->name('stores-single');

    Route::get('/', Home::class)->name('home');

    Route::prefix('admin')->group(function () {

        Route::get('/login', \App\Http\Livewire\Admin\Login::class)->name('admin.login');
        Route::any('/logout', \App\Http\Livewire\Admin\Login::class)->name('admin.logout');

        Route::middleware(['auth'])->group(function () {

            Route::get('/', \App\Http\Livewire\Admin\Home::class)->name('admin.home');
            Route::get('/settings', \App\Http\Livewire\Admin\Settings::class)->middleware(['permission:settings show'])->name('admin.settings');
            Route::get('/contacts', \App\Http\Livewire\Admin\Contacts::class)->middleware(['permission:contacts show'])->name('admin.contacts');
            Route::get('/subscribes-new', \App\Http\Livewire\Admin\SubscribesNew::class)->middleware(['permission:subscribes new show'])->name('admin.subscribes-new');

            Route::prefix('users')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Users\Users::class)->middleware('permission:users show|permission:users create|permission:users edit|permission:users delete')->name('admin.users');
                Route::get('/{id}', \App\Http\Livewire\Admin\Users\UsersShow::class)->middleware(['permission:users show'])->name('admin.users.show');
            });

            Route::prefix('roles')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Roles\Roles::class)->middleware('permission:roles show')->name('admin.roles');
            });

            Route::prefix('stores-categories')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\StoresCategories\StoresCategories::class)->middleware('permission:stores categories show|permission:stores categories create|permission:stores categories edit|permission:stores categories delete')->name('admin.stores-categories');
                Route::get('/{id}', \App\Http\Livewire\Admin\StoresCategories\StoresCategoriesShow::class)->middleware(['permission:stores categories show'])->name('admin.stores-categories.show');
            });

            Route::prefix('stores')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Stores\Stores::class)->middleware('permission:stores show|permission:stores create|permission:stores edit|permission:stores delete')->name('admin.stores');
                Route::get('/{id}', \App\Http\Livewire\Admin\Stores\StoresShow::class)->middleware(['permission:stores show'])->name('admin.stores.show');
                Route::get('/edit/{id}', \App\Http\Livewire\Admin\Stores\StoresEdit::class)->name('admin.stores.edit');
            });

            Route::prefix('categories')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Categories\Categories::class)->middleware('permission:categories show|permission:categories create|permission:categories edit|permission:categories delete')->name('admin.categories');
                Route::get('/{id}', \App\Http\Livewire\Admin\Categories\CategoriesShow::class)->middleware(['permission:categories show'])->name('admin.categories.show');
            });

            Route::prefix('products')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Products\Products::class)->middleware('permission:products show|permission:products create|permission:products edit|permission:products delete')->name('admin.products');
                Route::get('/{id}', \App\Http\Livewire\Admin\Products\ProductsShow::class)->middleware(['permission:products show'])->name('admin.products.show');
            });

            Route::prefix('carts')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Carts\Carts::class)->middleware('permission:carts show|permission:carts create|permission:carts edit|permission:carts delete')->name('admin.carts');
                Route::get('/{id}', \App\Http\Livewire\Admin\Carts\CartsShow::class)->middleware(['permission:carts show'])->name('admin.carts.show');
            });

            Route::prefix('orders')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Orders\Orders::class)->middleware('permission:orders show|permission:orders delete')->name('admin.orders');
                Route::get('/{id}', \App\Http\Livewire\Admin\Orders\OrdersShow::class)->middleware(['permission:orders show'])->name('admin.orders.show');
            });

            Route::prefix('transactions')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Transactions\Transactions::class)->middleware('permission:transactions show|permission:transactions delete')->name('admin.transactions');
                Route::get('/{id}', \App\Http\Livewire\Admin\Transactions\TransactionsShow::class)->middleware(['permission:transactions show'])->name('admin.transactions.show');
            });

            Route::prefix('posts')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Posts\Posts::class)->middleware('permission:posts show|permission:posts create|permission:posts edit|permission:posts delete')->name('admin.posts');
            });

            Route::prefix('countries-list')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\CountriesLists\CountriesLists::class)->middleware('permission:countries show|permission:countries create|permission:countries edit|permission:countries delete')->name('admin.countries');
            });

            Route::prefix('cities-list')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\CitiesLists\CitiesLists::class)->middleware('permission:cities show|permission:cities create|permission:cities edit|permission:cities delete')->name('admin.cities');
            });

            Route::prefix('district-list')->group(function () {
                Route::get('/', App\Http\Livewire\Admin\DistrictLists\CitiesLists::class)->middleware('permission:cities show|permission:cities create|permission:cities edit|permission:cities delete')->name('admin.district');
            });

            Route::prefix('coupons')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Coupons\Coupons::class)->middleware('permission:coupons show|permission:coupons create|permission:coupons edit|permission:coupons delete')->name('admin.coupons');
                Route::get('/{id}', \App\Http\Livewire\Admin\Coupons\CouponsShow::class)->middleware(['permission:coupons show'])->name('admin.coupons.show');
            });

            Route::prefix('arrest_receipts')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\ArrestReceiptes\ArrestReceiptes::class)->middleware('permission:arrest-receipts show|permission:arrest-receipts create|permission:arrest-receipts edit|permission:arrest-receipts delete')->name('admin.arrest.receipts');
            });

            Route::prefix('store_accounts')->group(function () {
               Route::get('/',\App\Http\Livewire\Admin\StoreAccounts\StoreAccounts::class)->middleware('permission:store-accounts show|permission:store-accounts create|permission:store-accounts edit|permission:store-accounts delete')->name('admin.store.accounts');
            });

            Route::prefix('vouchers')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Vouchers\Vouchers::class)->middleware('permission:vouchers show|permission:vouchers create|permission:vouchers edit|permission:vouchers delete')->name('admin.vouchers');
                Route::get('/{id}', \App\Http\Livewire\Admin\Vouchers\VouchersShow::class)->middleware(['permission:vouchers show'])->name('admin.vouchers.show');
            });

            Route::prefix('delivery_fees')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\DeliveryFees\DeliveryFees::class)->middleware('permission:delivery fees show|permission:delivery fees create|permission:delivery fees edit|permission:delivery fees delete')->name('admin.delivery-fees');
                Route::get('/{id}', \App\Http\Livewire\Admin\DeliveryFees\DeliveryFeesShow::class)->middleware(['permission:delivery fees show'])->name('admin.delivery-fees.show');
            });

            Route::prefix('videos')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Videos\Videos::class)->middleware('permission:videos show|permission:videos create|permission:videos edit|permission:videos delete')->name('admin.videos');
                Route::get('/{id}', \App\Http\Livewire\Admin\Videos\VideosShow::class)->middleware(['permission:videos show'])->name('admin.videos.show');
            });

            Route::prefix('brands')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Brands\Brands::class)->middleware('permission:brands show|permission:brands create|permission:brands edit|permission:brands delete')->name('admin.brands');
            });

            Route::prefix('ads')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Ads\Ads::class)->middleware('permission:ads show|permission:ads create|permission:ads edit|permission:ads delete')->name('admin.ads');
            });

            Route::prefix('sliders')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Sliders\Sliders::class)->middleware('permission:sliders show|permission:sliders create|permission:sliders edit|permission:sliders delete')->name('admin.sliders');
            });

            Route::prefix('menus')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Menus\Menus::class)->middleware('permission:menus show|permission:menus create|permission:menus edit|permission:menus delete')->name('admin.menus');
            });

            Route::prefix('pages')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Pages\Pages::class)->middleware('permission:pages show|permission:pages create|permission:pages edit|permission:pages delete')->name('admin.pages');
            });

            Route::prefix('faqs')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Faqs\Faqs::class)->middleware('permission:pages show|permission:pages create|permission:pages edit|permission:pages delete')->name('admin.faqs');
            });

            Route::prefix('payment-gateways')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\PaymentGateways\PaymentGateways::class)->middleware('permission:payment gateways show|permission:payment gateways create|permission:payment gateways edit|permission:payment gateways delete')->name('admin.payment-gateways');
                Route::get('/{id}', \App\Http\Livewire\Admin\PaymentGateways\PaymentGatewaysShow::class)->middleware(['permission:payment gateways show'])->name('admin.payment-gateways.show');
            });

            Route::prefix('deliveryـmethods')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\DeliveryMethods\DeliveryMethods::class)->middleware('permission:payment gateways show|permission:payment gateways create|permission:payment gateways edit|permission:payment gateways delete')->name('admin.deliveryـmethods');
                Route::get('/{id}', \App\Http\Livewire\Admin\DeliveryMethods\DeliveryMethodsShow::class)->middleware(['permission:payment gateways show'])->name('admin.deliveryـmethods.show');
            });
        });
    });
//});


