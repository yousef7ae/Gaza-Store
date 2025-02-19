<header class="fixed-top bg-dark">
    <nav class="bg-secondary nav-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-5">
                    <ul class="nav">
                        <li class="nav-item active">
                            <a class="nav-link text-white"
                               href="tel:{{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}"><i
                                    class="fas fa-phone-volume"></i> {{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-7">
                    <ul class="nav  justify-content-end">
                        <li class="nav-item active">
                            <a class="nav-link hover-skl text-white"
                               href="{{($setting = \App\Models\Setting::where('name',"url_facebook")->first()) ? $setting->value : '#'}}"
                               target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link hover-skl text-white"
                               href="{{($setting = \App\Models\Setting::where('name',"url_instagram")->first()) ? $setting->value : '#'}}"
                               target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link hover-skl text-white"
                               href="{{($setting = \App\Models\Setting::where('name',"url_whatsapp")->first()) ? $setting->value : '#'}}"
                               target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link hover-skl text-white"
                               href="{{($setting = \App\Models\Setting::where('name',"url_twitter")->first()) ? $setting->value : '#'}}"
                               target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link dropdown-toggle nav-link hover-skl text-white"
                               data-toggle="dropdown"
                               href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-globe"></i>
                            </a>
                            <div class="dropdown-menu header-hov bg-danger border-0 shadow"
                                 style="max-width: 5rem !important">
                                @foreach(config('app.locales') as $key => $locale)
                                    <a class="dropdown-item text-white" href="?language={{$key}}"><i
                                            class="fa fa-globe pr-2"></i>{{$locale}}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-3">
                <nav class="navbar navbar-expand-lg navbar-light py-0">
                    <a class="navbar-brand" href="{{route('home')}}">
{{--                        <img width="58" class="logo-img" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}" alt="">--}}
                        <img width="90" class="logo-img" src="{{asset('jawwalak/img/logo-white.png')}}" alt="">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav justify-content-center w-100 text-center">
                            <li class="nav-item active">
                                <a class="navbar-brand d-block d-lg-none" href="#">
{{--                                    <img class="img-fluid" width="100" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('assets/images/logo.png')}}" alt="">--}}
                                    <img class="img-fluid" width="100" src="{{asset('jawwalak/img/logo-white.png')}}" alt="">
                                </a>
                            </li>
                            @if($menus)
                                @foreach($menus['submenus'] as $submenu)
                                    <li class="nav-item {{ request()->route()->getName() == $submenu['url'] ? 'active' : ''}}">
                                        <a class="nav-link font-weight-bold text-white {{request()->route()->getName() == "home" ? 'text-white' : ''}}"
                                           href="{{$submenu['url'][app()->getLocale()]}}">{{$submenu['name'][app()->getLocale()]}} </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-xl-3 col-lg-4 col-9">
                <ul class="nav h-100 justify-content-center align-items-center">
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white hover-skl"
                           href="#"  data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></a>
                    </li>
                    <li class="nav-item">
                        @livewire('site.carts.cart-show')
                    </li>
                    <li class="nav-item">
                        @livewire('site.favorites.favorite-show')
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-md-inline-flex text-white px-1 py-0 align-items-center"
                               data-toggle="dropdown"
                               href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ auth()->user()->image  }}" class="cover d-inline-block" width="32px"
                                     height="32px" alt="">
                            </a>
                            <div class="dropdown-menu header-hov bg-danger border-0 shadow">
                                <a class="dropdown-item text-white" href="{{route('profile')}}"><i
                                        class="fas fa-user pr-2"></i>{{__("Profile")}}</a>


                                @if (!auth()->user()->hasRole('Customer'))
                                    <a class="dropdown-item text-white" href="{{route('admin.home')}}"><i
                                            class="fas fa-tachometer-alt pr-2"></i>{{__("Dashboard")}}</a>
                                @else
                                    <a class="dropdown-item text-white" href="{{route('profile.orders')}}"><i
                                            class="fas fa-layer-group pr-2"></i>{{__("Orders")}}</a>
                                @endif

                                @if (in_array(auth()->id(),auth()->user()->stores->pluck('user_id')->toArray()) and !auth()->user()->hasRole('Admin') and in_array(1,auth()->user()->stores->pluck('status')->toArray()))
                                    <a class="dropdown-item text-white"
                                       href="{{route('stores-single',auth()->user()->stores->pluck('id')->toArray())}}"><i
                                            class="fas fa-store pr-2"></i>{{__("Store")}}</a>
                                @endif

                                <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt pr-2"></i> {{__("Logout")}} </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link px-3 text-white  hover-skl" title="login" href="{{route('login')}}"><i
                                    class="far fa-user"></i></a>
                        </li>
                    @endauth
                        <li class="d-md-none d-inline-block">
                            <button class="navbar-toggler position-relative py-3 border-0" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="our-btn">
                                    <span class="the-bar"></span>
                                    <span class="the-bar"></span>
                                    <span class="the-bar"></span>
                                </span>
                                <span class="btn overlaymnu d-lg-none d-block">
                                    <span class="our-btn"></span>
                                </span>
                            </button>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="pt-99p"></div>
@livewire('site.search')

