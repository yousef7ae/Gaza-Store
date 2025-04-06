<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', [\App\Http\Controllers\V2\HomeController::class, 'test']);

Route::middleware(['api-token', 'api-localization'])->group(function () {

    // Route::prefix('v1')->group(function () {

    //     Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
    //     Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
    //     Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
    //     Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    //     Route::get('/countries', [\App\Http\Controllers\CountryController::class, 'index']);
    //     Route::get('/cities/{country_id}', [\App\Http\Controllers\CityController::class, 'index']);
    //     Route::get('/stores', [\App\Http\Controllers\StoreController::class, 'index']);
    //     Route::get('/stores/{store_id}', [\App\Http\Controllers\StoreController::class, 'show']);
    //     Route::post('/stores/{store_id}/join', [\App\Http\Controllers\StoreController::class, 'join']);
    //     Route::post('/stores/{store_id}/need_delivery', [\App\Http\Controllers\StoreController::class, 'need_delivery']);
    //     Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    //     Route::get('/brands', [\App\Http\Controllers\BrandController::class, 'index']);
    //     Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
    //     Route::get('/products/{product_id}', [\App\Http\Controllers\ProductController::class, 'show']);

    //     Route::get('/favorites', [\App\Http\Controllers\FavoritesController::class, 'index']);
    //     Route::post('/favorites', [\App\Http\Controllers\FavoritesController::class, 'create']);
    //     Route::delete('/favorites', [\App\Http\Controllers\FavoritesController::class, 'remove']);

    //     Route::get('/payment_gateway', [\App\Http\Controllers\PaymentGatewayController::class, 'index']);
    //     Route::get('/videos', [\App\Http\Controllers\VideoController::class, 'index']);
    //     Route::get('/videos/{id}', [\App\Http\Controllers\VideoController::class, 'show']);
    //     Route::get('/points', [\App\Http\Controllers\PointController::class, 'index']);
    //     Route::get('/points/{id}', [\App\Http\Controllers\PointController::class, 'show']);
    //     Route::get('/pages', [\App\Http\Controllers\PageController::class, 'index']);
    //     Route::get('/pages/{id}', [\App\Http\Controllers\PageController::class, 'show']);

    //     Route::get('/faqs', [\App\Http\Controllers\FaqController::class, 'index']);
    //     Route::get('/faqs/{id}', [\App\Http\Controllers\FaqController::class, 'show']);

    //     Route::get('/forget', [\App\Http\Controllers\UserController::class, 'forget']);
    //     Route::post('/forget_confirm', [\App\Http\Controllers\UserController::class, 'forget_confirm']);

    //     Route::get('/carts', [\App\Http\Controllers\CartsController::class, 'index']);
    //     Route::post('/carts', [\App\Http\Controllers\CartsController::class, 'create']);
    //     Route::delete('/carts', [\App\Http\Controllers\CartsController::class, 'remove']);

    //     Route::middleware('auth:sanctum')->group(function () {

    //         Route::get('/checkout', [\App\Http\Controllers\CartsController::class, 'checkout']);

    //         Route::get('/profile', [\App\Http\Controllers\UserController::class, 'user']);
    //         Route::post('/profile', [\App\Http\Controllers\UserController::class, 'profile']);
    //         Route::post('/change_password', [\App\Http\Controllers\UserController::class, 'change_password']);
    //         Route::get('/notifications', [\App\Http\Controllers\NotificationsController::class, 'index']);
    //         //Route::get('/notifications/', [\App\Http\Controllers\NotificationsController::class, 'notification']);

    //         Route::get('/product_rates', [\App\Http\Controllers\ProductRateController::class, 'index']);
    //         Route::post('/product_rates', [\App\Http\Controllers\ProductRateController::class, 'create']);

    //         Route::get('/store_rates', [\App\Http\Controllers\StoreRateController::class, 'index']);
    //         Route::post('/store_rates', [\App\Http\Controllers\StoreRateController::class, 'create']);

    //         Route::post('/store_times', [\App\Http\Controllers\StoreController::class, 'store_times']);

    //         Route::get('/address', [\App\Http\Controllers\AddressController::class, 'index']);
    //         Route::post('/address', [\App\Http\Controllers\AddressController::class, 'store']);
    //         Route::put('/address/{id}', [\App\Http\Controllers\AddressController::class, 'update']);
    //         Route::get('/address/{id}', [\App\Http\Controllers\AddressController::class, 'show']);
    //         Route::delete('/address/{id}', [\App\Http\Controllers\AddressController::class, 'delete']);

    //         Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
    //         Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store']);
    //         Route::get('/orders/statistics', [\App\Http\Controllers\OrderController::class, 'statistics']);
    //         Route::put('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
    //         Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show']);
    //         Route::delete('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'delete']);

    //         Route::get('/check_coupon', [\App\Http\Controllers\CouponController::class, 'index']);
    //         Route::get('/check_coupon/{id}', [\App\Http\Controllers\CouponController::class, 'show']);
    //         Route::post('/check_coupon', [\App\Http\Controllers\CouponController::class, 'create']);
    //         Route::put('/coupons/{coupon_id}/update_status', [\App\Http\Controllers\CouponController::class, 'change_status']);

    //         Route::get('chats', [\App\Http\Controllers\ChatController::class, 'index']);
    //         Route::post('chats', [\App\Http\Controllers\ChatController::class, 'chat']);
    //         Route::get('messages', [\App\Http\Controllers\ChatController::class, 'messages']);
    //         Route::post('messages', [\App\Http\Controllers\ChatController::class, 'message']);

    //         Route::put('/products/{product_id}/update_status', [\App\Http\Controllers\ProductController::class, 'change_status']);

    //         Route::get('/requests', [\App\Http\Controllers\UserController::class, 'requests']);
    //         Route::get('/request_delivery', [\App\Http\Controllers\UserController::class, 'request_delivery']);
    //         Route::post('/request_delivery_status', [\App\Http\Controllers\UserController::class, 'request_delivery_status']);
    //     });
    // });

    Route::prefix('v2')->group(function () {

        Route::get('/home', [\App\Http\Controllers\V2\HomeController::class, 'index']);

        Route::get('/store_categories/{store_type_id}', [\App\Http\Controllers\V2\StoreCategories::class, 'index']);
        Route::get('/store_types', [\App\Http\Controllers\V2\StoreTypes::class, 'index']);

        Route::get('/carts_count', [\App\Http\Controllers\V2\HomeController::class, 'carts_count']);
        Route::post('/contact', [\App\Http\Controllers\V2\ContactController::class, 'create']);

        Route::post('/login', [\App\Http\Controllers\V2\UserController::class, 'login']);
        Route::post('/register', [\App\Http\Controllers\V2\UserController::class, 'register']);
        Route::get('/users', [\App\Http\Controllers\V2\UserController::class, 'index']);
        Route::get('/countries', [\App\Http\Controllers\V2\CountryController::class, 'index']);
        Route::get('/cities/{country_id}', [\App\Http\Controllers\V2\CityController::class, 'index']);
        Route::get('/stores', [\App\Http\Controllers\V2\StoreController::class, 'index']);
        Route::get('/stores/{store_id}', [\App\Http\Controllers\V2\StoreController::class, 'show']);
        Route::post('/stores/{store_id}/join', [\App\Http\Controllers\V2\StoreController::class, 'join']);
        Route::post('/stores/{store_id}/need_delivery', [\App\Http\Controllers\V2\StoreController::class, 'need_delivery']);
        Route::get('/categories', [\App\Http\Controllers\V2\CategoryController::class, 'index']);
        Route::post('/categories/store', [\App\Http\Controllers\V2\CategoryController::class, 'store']);
        Route::put('/categories/update/{id}', [\App\Http\Controllers\V2\CategoryController::class, 'update']);
        Route::get('/categories/show/{id}', [\App\Http\Controllers\V2\CategoryController::class, 'show']);
        Route::get('/categories/delete/{id}', [\App\Http\Controllers\V2\CategoryController::class, 'destroy']);
        Route::get('/brands', [\App\Http\Controllers\V2\BrandController::class, 'index']);
        Route::get('/products', [\App\Http\Controllers\V2\ProductController::class, 'index']);
        Route::get('/products/{product_id}', [\App\Http\Controllers\V2\ProductController::class, 'show']);

        Route::get('/favorites', [\App\Http\Controllers\V2\FavoritesController::class, 'index']);
        Route::post('/favorites', [\App\Http\Controllers\V2\FavoritesController::class, 'create']);
        Route::delete('/favorites', [\App\Http\Controllers\V2\FavoritesController::class, 'remove']);

        Route::get('/payment_gateway', [\App\Http\Controllers\V2\PaymentGatewayController::class, 'index']);
        Route::get('/videos', [\App\Http\Controllers\V2\VideoController::class, 'index']);
        Route::get('/videos/{id}', [\App\Http\Controllers\V2\VideoController::class, 'show']);
        Route::get('/points', [\App\Http\Controllers\V2\PointController::class, 'index']);
        Route::get('/points/{id}', [\App\Http\Controllers\V2\PointController::class, 'show']);
        Route::get('/pages', [\App\Http\Controllers\V2\PageController::class, 'index']);
        Route::get('/pages/{id}', [\App\Http\Controllers\V2\PageController::class, 'show']);

        Route::get('/faqs', [\App\Http\Controllers\V2\FaqController::class, 'index']);
        Route::get('/faqs/{id}', [\App\Http\Controllers\V2\FaqController::class, 'show']);

        Route::post('/forget', [\App\Http\Controllers\V2\UserController::class, 'forget']);
        Route::post('/forget_confirm', [\App\Http\Controllers\V2\UserController::class, 'forget_confirm']);
        Route::post('/reset_password', [\App\Http\Controllers\V2\UserController::class, 'reset_password']);

        Route::get('/carts', [\App\Http\Controllers\V2\CartsController::class, 'index']);
        Route::post('/carts', [\App\Http\Controllers\V2\CartsController::class, 'create']);
        Route::delete('/carts', [\App\Http\Controllers\V2\CartsController::class, 'remove']);

        Route::middleware('auth:sanctum')->group(function () {

            Route::get('/checkout', [\App\Http\Controllers\V2\CartsController::class, 'checkout']);

            Route::get('/profile', [\App\Http\Controllers\V2\UserController::class, 'user']);
            Route::post('/profile', [\App\Http\Controllers\V2\UserController::class, 'profile']);
            Route::post('/change_delivery_available', [\App\Http\Controllers\V2\UserController::class, 'change_delivery_available']);
            Route::post('/change_password', [\App\Http\Controllers\V2\UserController::class, 'change_password']);
            Route::get('/notifications', [\App\Http\Controllers\V2\NotificationsController::class, 'index']);
            //Route::get('/notifications/', [\App\Http\Controllers\V2\NotificationsController::class, 'notification']);
            Route::get('/send_notification', [\App\Http\Controllers\V2\NotificationsController::class, 'send_notification']);

            Route::get('/product_rates', [\App\Http\Controllers\V2\ProductRateController::class, 'index']);
            Route::post('/product_rates', [\App\Http\Controllers\V2\ProductRateController::class, 'create']);

            Route::get('/store_rates', [\App\Http\Controllers\V2\StoreRateController::class, 'index']);
            Route::post('/store_rates', [\App\Http\Controllers\V2\StoreRateController::class, 'create']);

            Route::post('/store_times', [\App\Http\Controllers\V2\StoreController::class, 'store_times']);

            Route::get('/address', [\App\Http\Controllers\V2\AddressController::class, 'index']);
            Route::post('/address', [\App\Http\Controllers\V2\AddressController::class, 'store']);
            Route::post('/address/{id}', [\App\Http\Controllers\V2\AddressController::class, 'update']);
            // Route::post('/address-update-coordinates/{id}', [\App\Http\Controllers\V2\AddressController::class, 'updateCoordinates']);
            Route::get('/address/{id}', [\App\Http\Controllers\V2\AddressController::class, 'show']);
            Route::delete('/address/{id}', [\App\Http\Controllers\V2\AddressController::class, 'delete']);

            Route::get('/orders', [\App\Http\Controllers\V2\OrderController::class, 'index']);
            Route::get('/index_delivery', [\App\Http\Controllers\V2\OrderController::class, 'index_delivery']);
            Route::get('/index_delivery_status', [\App\Http\Controllers\V2\OrderController::class, 'index_delivery_status']);
            Route::get('/index_Merchant', [\App\Http\Controllers\V2\OrderController::class, 'index_Merchant']);
            Route::get('/index_Customer', [\App\Http\Controllers\V2\OrderController::class, 'index_Customer']);
            Route::get('/statusList', [\App\Http\Controllers\V2\OrderController::class, 'statusList']);
            Route::post('/orders', [\App\Http\Controllers\V2\OrderController::class, 'store']);
            Route::get('/orders/statistics', [\App\Http\Controllers\V2\OrderController::class, 'statistics']);
            Route::get('/orders/statistics_delivery', [\App\Http\Controllers\V2\OrderController::class, 'statistics_delivery']);
            Route::put('/orders/{id}', [\App\Http\Controllers\V2\OrderController::class, 'update']);
            Route::put('/update_order/{id}', [\App\Http\Controllers\V2\OrderController::class, 'update_order']);
            Route::post('update_QrCode', [\App\Http\Controllers\V2\OrderController::class, 'update_qr_code']);

            Route::get('/orders/{id}', [\App\Http\Controllers\V2\OrderController::class, 'show']);
            Route::delete('/orders/{id}', [\App\Http\Controllers\V2\OrderController::class, 'delete']);
            Route::get('/order_accept/{id}', [\App\Http\Controllers\V2\OrderController::class, 'order_accept']);

            Route::get('/check_coupon', [\App\Http\Controllers\V2\CartsController::class, 'checkCoupon']);

            //        Route::get('/check_coupon', [\App\Http\Controllers\V2\CouponController::class, 'index']);
            Route::get('/check_coupon/{id}', [\App\Http\Controllers\V2\CouponController::class, 'show']);
            Route::post('/check_coupon', [\App\Http\Controllers\V2\CouponController::class, 'create']);
            Route::put('/coupons/{coupon_id}/update_status', [\App\Http\Controllers\V2\CouponController::class, 'change_status']);

            Route::get('chats', [\App\Http\Controllers\V2\ChatController::class, 'index']);
            Route::post('chats', [\App\Http\Controllers\V2\ChatController::class, 'chat']);
            Route::get('messages', [\App\Http\Controllers\V2\ChatController::class, 'messages']);
            Route::post('messages', [\App\Http\Controllers\V2\ChatController::class, 'message']);

            Route::put('/products/{product_id}/update_status', [\App\Http\Controllers\V2\ProductController::class, 'change_status']);

            Route::get('/requests', [\App\Http\Controllers\V2\UserController::class, 'requests']);
            Route::get('/request_delivery', [\App\Http\Controllers\V2\UserController::class, 'request_delivery']);
            Route::post('/request_delivery_status', [\App\Http\Controllers\V2\UserController::class, 'request_delivery_status']);
        });
    });
});
