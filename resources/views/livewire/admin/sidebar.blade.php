<header class="main-nav">
    <div class="sidebar-user text-center">
        {{--        <a class="setting-primary" href="javascript:void(0)">--}}
        {{--            <i data-feather="settings"></i>--}}
        {{--        </a>--}}
        <img class="img-90 rounded-circle"
             src="{{ auth()->user()->image ? auth()->user()->image : url('dashboard/images/1.png') }}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="#">
            <h6 class="mt-3 f-14 f-w-600">{{auth()->user()->name}}</h6>
        </a>
        <p class="mb-0 font-roboto">{{auth()->user()->email }}</p>

    </div>
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">

                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{request()->is('admin') ? 'active' : ''}}"
                           href="{{route('admin.home')}}">
                            <i data-feather="home"></i>
                            <span>{{__('Home')}}</span>
                        </a>
                    </li>

                    @if(auth()->guard('web')->user()->can('users show'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/users') ? 'active' : ''}} "
                               href="{{route('admin.users')}}">
                                <i data-feather="users"></i>
                                <span>{{__("Users")}}</span>
                                <span
                                    class="badge badge-primary float-end mt-1">{{App\Models\User::whereNull('deleted_at')->count()}}</span>
                            </a>
                        </li>
                    @endif

{{--                    @if(auth()->guard('web')->user()->can('roles show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/roles*') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.roles')}}">--}}
{{--                                <i data-feather="lock"></i>--}}
{{--                                <span>{{__("Roles")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{\Spatie\Permission\Models\Role::count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('stores categories show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/stores-categories') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.stores-categories')}}">--}}
{{--                                <i data-feather="layout"></i>--}}
{{--                                <span>{{__("Stores Categories")}}</span>--}}

{{--                                @if(!auth()->user()->hasRole("Admin"))--}}
{{--                                    <span--}}
{{--                                        class="badge badge-primary float-end mt-1">{{App\Models\StoreCategory::where('user_id',auth()->id())->count()}}</span>--}}
{{--                                @else--}}
{{--                                    <span--}}
{{--                                        class="badge badge-primary float-end mt-1">{{App\Models\StoreCategory::count()}}</span>--}}
{{--                                @endif--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('stores show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/stores') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.stores')}}">--}}
{{--                                <i data-feather="layout"></i>--}}
{{--                                <span>{{__("Stores")}}</span>--}}

{{--                                @if(!auth()->user()->hasRole("Admin"))--}}
{{--                                    <span--}}
{{--                                        class="badge badge-primary float-end mt-1">{{App\Models\Store::whereNull('deleted_at')->where('user_id',auth()->id())->count()}}</span>--}}
{{--                                @else--}}
{{--                                    <span--}}
{{--                                        class="badge badge-primary float-end mt-1">{{App\Models\Store::whereNull('deleted_at')->count()}}</span>--}}
{{--                                @endif--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('menus show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/menus') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.menus')}}">--}}
{{--                                <i data-feather="menu"></i>--}}
{{--                                <span>{{__("Menus")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Menu::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('pages show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/pages') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.pages')}}">--}}
{{--                                <i data-feather="file-text"></i>--}}
{{--                                <span>{{__("Pages")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Page::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('sliders show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/sliders') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.sliders')}}">--}}
{{--                                <i data-feather="sliders"></i>--}}
{{--                                <span>{{__("Sliders")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{  !auth()->user()->hasRole("Admin") ? App\Models\Slider::whereNull('deleted_at')->where('user_id',auth()->id())->count() : App\Models\Slider::whereNull('deleted_at')->count() }}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

                    @if(auth()->guard('web')->user()->can('categories show'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/categories') ? 'active' : ''}} "
                               href="{{route('admin.categories')}}">
                                <i data-feather="menu"></i>
                                <span>{{__("Categories")}}</span>
                                @if(!auth()->user()->hasRole("Admin"))
                                    <span class="badge badge-primary float-end mt-1">
                                        {{
                                            App\Models\Category::whereHas('categories_stores', function($q){
                                                return $q->whereIn('store_id',auth()->user()->stores()->pluck('id')->toArray());
                                            })->whereNull('deleted_at')->count()
                                        }}
                                    </span>
                                @else
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Category::whereNull('deleted_at')->count()}}</span>
                                @endif
                            </a>
                        </li>
                    @endif

{{--                    @if(auth()->guard('web')->user()->can('brands show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/brands') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.brands')}}">--}}
{{--                                <i data-feather="tag"></i>--}}
{{--                                <span>{{__("Brands")}}</span>--}}
{{--                                @if(!auth()->user()->hasRole("Admin"))--}}
{{--                                    <span class="badge badge-primary float-end mt-1">--}}
{{--                                        {{--}}
{{--                                            App\Models\Brand::whereHas('brands_stores', function($q){--}}
{{--                                                return $q->whereIn('store_id',auth()->user()->stores()->pluck('id')->toArray());--}}
{{--                                            })->whereNull('deleted_at')->count()--}}
{{--                                        }}--}}
{{--                                    </span>--}}
{{--                                @else--}}
{{--                                    <span--}}
{{--                                        class="badge badge-primary float-end mt-1">{{App\Models\Brand::whereNull('deleted_at')->count()}}</span>--}}
{{--                                @endif--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

                    @if(auth()->guard('web')->user()->can('products show') || auth()->guard('web')->user()->can('products create') || auth()->guard('web')->user()->can('products edit')  || auth()->guard('web')->user()->can('products delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/products') ? 'active' : ''}} "
                               href="{{route('admin.products')}}">
                                <i data-feather="shopping-bag"></i>
                                <span>{{__("Products")}}</span>

                                @if(!auth()->user()->hasRole("Admin"))
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Product::whereNull('deleted_at')->where('user_id',auth()->id())->count()}}</span>
                                @else
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Product::whereNull('deleted_at')->count()}}</span>

                                @endif
                            </a>
                        </li>
                    @endif

                    @if(auth()->guard('web')->user()->can('ads show') || auth()->guard('web')->user()->can('ads create') || auth()->guard('web')->user()->can('ads edit')  || auth()->guard('web')->user()->can('ads delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/ads') ? 'active' : ''}} "
                               href="{{route('admin.ads')}}">
                                <i data-feather="radio"></i>
                                <span>{{__("Ads")}}</span>
                                @if(!auth()->user()->hasRole("Admin"))
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Ad::whereNull('deleted_at')->where('user_id',auth()->id())->count()}}</span>
                                @else
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Ad::whereNull('deleted_at')->count()}}</span>

                                @endif
                            </a>
                        </li>
                    @endif

                    @if(auth()->guard('web')->user()->can('carts show') || auth()->guard('web')->user()->can('carts delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/carts') ? 'active' : ''}} "
                               href="{{route('admin.carts')}}">
                                <i data-feather="shopping-cart"></i>
                                <span>{{__("Carts")}}</span>
                                @if(!auth()->user()->hasRole("Admin"))
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Cart::whereNull('deleted_at')->where('user_id',auth()->id())->count()}}</span>
                                @else
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Cart::whereNull('deleted_at')->count()}}</span>

                                @endif
                            </a>
                        </li>
                    @endif

                    @if(auth()->guard('web')->user()->can('orders show') || auth()->guard('web')->user()->can('orders delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/orders') ? 'active' : ''}} "
                               href="{{route('admin.orders')}}">
                                <i data-feather="clipboard"></i>
                                <span>{{__("Orders")}}</span>

                                @php
                                    // $orders = App\Models\Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');
                                    $orders = App\Models\Order::query();
                                    if (auth()->user()->hasRole('Delivery') and request('status') != "1") {
                                        $ordersIDS = \App\Models\OrderUser::where('user_id', auth()->id())->pluck('order_id')->toArray();
                                        $orders = $orders->whereNotIn('id', $ordersIDS)->whereNull('delivery_id');
                                    } elseif (auth()->user()->hasRole('Delivery') and request('status') == "1") {
                                        $orders = $orders->where('delivery_id', auth()->id());
                                    } else if (auth()->user()->hasRole('Merchant')) {
                                        $orders = $orders->where('store_id', auth()->user()->stores()->pluck('id')->toArray());
                                    } else {
                                        if (auth()->user()->hasRole('Customer')) {
                                            $orders = $orders->where('user_id', auth()->id());
                                        }
                                    }
                                @endphp
                                <span
                                    class="badge badge-primary float-end mt-1">{{$orders->count()}}</span>
                            </a>
                        </li>
                    @endif

                    @if(auth()->guard('web')->user()->can('coupons show') || auth()->guard('web')->user()->can('coupons create') || auth()->guard('web')->user()->can('coupons edit')  || auth()->guard('web')->user()->can('coupons delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/coupons') ? 'active' : ''}} "
                               href="{{route('admin.coupons')}}">
                                <i data-feather="percent"></i>
                                <span>{{__("Coupons")}}</span>

                                @if(!auth()->user()->hasRole("Admin"))
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Coupon::whereNull('deleted_at')->where('user_id',auth()->id())->count()}}</span>

                                @else
                                    <span
                                        class="badge badge-primary float-end mt-1">{{App\Models\Coupon::whereNull('deleted_at')->count()}}</span>

                                @endif
                            </a>
                        </li>
                    @endif

{{--                    @if(auth()->user()->hasRole('Admin'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/arrest_receipts') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.arrest.receipts')}}">--}}
{{--                                <i data-feather="sliders"></i>--}}
{{--                                <span>{{__("Arrest Receipts")}}</span>--}}
{{--                                <span class="badge badge-primary float-end mt-1">{{ App\Models\ArrestReceipt::whereNull('deleted_at')->count() }}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->user()->hasRole('Admin'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/store_accounts') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.store.accounts')}}">--}}
{{--                                <i data-feather="sliders"></i>--}}
{{--                                <span>{{__("Stores Accounts")}}</span>--}}
{{--                                <span class="badge badge-primary float-end mt-1">{{ App\Models\StoreAccount::whereNull('deleted_at')->count() }}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}


                    {{--                    @if(auth()->guard('web')->user()->can('vouchers show') || auth()->guard('web')->user()->can('vouchers create') || auth()->guard('web')->user()->can('vouchers edit')  || auth()->guard('web')->user()->can('vouchers delete'))--}}
                    {{--                        <li class="dropdown">--}}
                    {{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/vouchers') ? 'active' : ''}} "--}}
                    {{--                               href="{{route('admin.vouchers')}}">--}}
                    {{--                                <i data-feather="credit-card"></i>--}}
                    {{--                                <span>{{__("Vouchers")}}</span>--}}
                    {{--                                <span--}}
                    {{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Voucher::whereNull('deleted_at')->count()}}</span>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('payment gateways show') || auth()->guard('web')->user()->can('payment gateways create') || auth()->guard('web')->user()->can('payment gateways edit')  || auth()->guard('web')->user()->can('payment gateways delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/payment-gateways') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.payment-gateways')}}">--}}
{{--                                <i data-feather="truck"></i>--}}
{{--                                <span>{{__("Payment Gateways")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\PaymentGateway::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('delivery methods show') || auth()->guard('web')->user()->can('delivery methods create') || auth()->guard('web')->user()->can('delivery methods edit')  || auth()->guard('web')->user()->can('delivery methods delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/deliveryـmethods') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.deliveryـmethods')}}">--}}
{{--                                <i data-feather="truck"></i>--}}
{{--                                <span>{{__("Delivery Methods")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\PaymentGateway::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('posts show') || auth()->guard('web')->user()->can('posts create') || auth()->guard('web')->user()->can('posts edit')  || auth()->guard('web')->user()->can('posts delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/posts') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.posts')}}">--}}
{{--                                <i data-feather="send"></i>--}}
{{--                                <span>{{__("Posts")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Post::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('countries show') || auth()->guard('web')->user()->can('countries create') || auth()->guard('web')->user()->can('countries edit')  || auth()->guard('web')->user()->can('countries delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/countries') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.countries')}}">--}}
{{--                                <i data-feather="globe"></i>--}}
{{--                                <span>{{__("Countries")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{Nnjeim\World\Models\Country::count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('cities show') || auth()->guard('web')->user()->can('cities create') || auth()->guard('web')->user()->can('cities edit')  || auth()->guard('web')->user()->can('cities delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/cities') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.cities')}}">--}}
{{--                                <i data-feather="globe"></i>--}}
{{--                                <span>{{__("Cities")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{Nnjeim\World\Models\City::count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('cities show') || auth()->guard('web')->user()->can('cities create') || auth()->guard('web')->user()->can('cities edit')  || auth()->guard('web')->user()->can('cities delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/district') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.district')}}">--}}
{{--                                <i data-feather="globe"></i>--}}
{{--                                <span>{{__("districts")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{\App\Models\District::count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('transactions show') || auth()->guard('web')->user()->can('transactions delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/transactions') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.transactions')}}">--}}
{{--                                <i data-feather="activity"></i>--}}
{{--                                <span>{{__("Transactions")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Transaction::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('videos show') || auth()->guard('web')->user()->can('videos delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/videos') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.videos')}}">--}}
{{--                                <i data-feather="activity"></i>--}}
{{--                                <span>{{__("Videos")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Video::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->guard('web')->user()->can('faqs show'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/faqs') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.faqs')}}">--}}
{{--                                <i data-feather="file-text"></i>--}}
{{--                                <span>{{__("Faqs")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-primary float-end mt-1">{{App\Models\Faq::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

                    @if(auth()->guard('web')->user()->can('contacts show') ||  auth()->guard('web')->user()->can('contacts delete'))
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/contacts') ? 'active' : ''}} "
                               href="{{route('admin.contacts')}}">
                                <i data-feather="inbox"></i>
                                <span>{{__("Contacts")}}</span>
                                <span
                                    class="badge badge-danger float-end mt-1">{{App\Models\Contact::whereNull('deleted_at')->count()}}</span>
                            </a>
                        </li>
                    @endif

{{--                    @if(auth()->guard('web')->user()->can('subscribes new show') ||  auth()->guard('web')->user()->can('subscribes new delete'))--}}
{{--                        <li class="dropdown">--}}
{{--                            <a class="nav-link menu-title link-nav {{request()->is('admin/subscribes-new') ? 'active' : ''}} "--}}
{{--                               href="{{route('admin.subscribes-new')}}">--}}
{{--                                <i data-feather="at-sign"></i>--}}
{{--                                <span>{{__("Subscribes New")}}</span>--}}
{{--                                <span--}}
{{--                                    class="badge badge-danger float-end mt-1">{{App\Models\SubscribeNews::whereNull('deleted_at')->count()}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}


                    @if(auth()->user()->can('settings show') )
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/settings') ? 'active' : ''}} "
                               href="{{route('admin.settings')}}">
                                <i data-feather="settings"></i>
                                <span>{{__("Settings")}}</span>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>
</header>
