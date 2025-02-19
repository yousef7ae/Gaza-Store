<header class="bg-white shadow-sm fixed-top">

<div class="bg-light">
    <div class="container py-3 d-flex">
        <p class="mb-0 ps-3 d-sm-block d-none" data-aos="zoom-out-down">اهلا وسهلا بك في متجر فدي للتجارة المحدودة</p>
        <p class="mb-0 ps-3" data-aos="zoom-out-down" data-aos-delay="200"> <img class="pe-2" width="30" src="{{asset('fedi/img/icon-1.png')}}" alt="ضمان استعادة الأموال">ضمان استعادة الأموال</p>
        <p class="mb-0 ps-3" data-aos="zoom-out-down" data-aos-delay="400"> <img class="pe-2" width="30" src="{{asset('fedi/img/icon-2.png')}}" alt="ضمان استعادة الأموال">الوافدون الجدد أسبوعيا</p>
    </div>
</div>

<div class="container">
    <div class="row align-items-center pt-md-0 pt-2">
        <div class="col-lg-4 col-2">
            <a class="navbar-brand me-0 position-relative" href="{{route('home')}}"><img width="100" class="img-fluid" src="{{asset('fedi/img/logo.png')}}" alt=""></a>
        </div>

        <div class="col-lg-4 col-5">
            <form class="d-flex position-relative" role="search">
                <input class="form-control rounded-pill pe-5" type="search" placeholder="{{__('Search')}}" aria-label="Search" data-bs-toggle="modal" data-bs-target="#searchModal">
                <button class="btn btn-outline-primary px-3 rounded-pill border-0 h-100 position-absolute top-0 left-0"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="col-lg-4 col-5">
            <ul class="nav h-100 justify-content-lg-end justify-content-center align-items-center position-relative">
                <li class="nav-item">
                @livewire('site.carts.cart-show')
                </li>
                <li class="nav-item">
                @livewire('site.favorites.favorite-show')
                </li>

                @auth
                <li class="nav-item">
                  <a class="nav-link text-p px-md-3 px-2 login" href="{{route('profile')}}"><i class="far fa-user fs-5 pe-2"></i><span class="d-sm-inline-block d-none">{{__("Profile")}}</span> </a>
                </li>
                    @else
                <li class="nav-item">
                  <a class="nav-link text-p px-md-3 px-2 login" href="{{route('login')}}"><i class="far fa-user fs-5 pe-2"></i><span class="d-sm-inline-block d-none">تسجيل دخول</span> </a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
    <div class="d-flex justify-content-md-between justify-content-center align-items-center py-md-3">
        <div class="btm-nav container">
            <div class="d-flex justify-content-between align-items-center">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler position-relative border-0 collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="our-btn">
                            <span class="the-bar"></span>
                            <span class="the-bar"></span>
                            <span class="the-bar"></span>
                        </span>
                    <span class="btn overlaymnu d-lg-none d-block">
                            <span class="our-btn"></span>
                        </span>
                </button>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav justify-content-center w-100 text-center position-relative">
                            <li class="nav-item">
                                <a class="navbar-brand d-lg-none d-block logo-mo my-4 " href="{{route('home')}}"><img class="img-fluid" width="100" src="{{asset('fedi/img/logo.png')}}" alt=""></a>
                            </li>
                            @if($menus)
                                @foreach($menus['submenus'] as $submenu)
                            <li class="nav-item px-2 {{ Route::currentRouteNamed(request()->route()->getName() == $submenu['url']) ?  'active' : '' }}">
                                <a class="nav-link font-weight-bold" href="{{$submenu['url'][app()->getLocale()]}}">{{$submenu['name'][app()->getLocale()]}} </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </nav>
                <p class="mb-0 rival">خصم إضافي للمنتجات + شحن مجاني للطلبات التي تزيد عن 200$ </p>
            </div>
        </div>
    </div>
</div>
</header>
@livewire('site.search')
<!-- <header class="fixed-top bg-primary">
    <div class="container">
        <div class="row g-0 py-2">
            <div class="col-lg-9 col-2">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand me-0" href="{{route('home')}}"><img width="100" class="img-fluid" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('fedi/assets/img/logo.svg')}}" alt=""></a>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav justify-content-center w-100 text-center">
                            <li class="nav-item">
                                <a class="navbar-brand d-block d-lg-none" href="#">
                                    <img class="img-fluid" width="100" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('assets/images/logo.png')}}" alt=""></a>
                            </li>

                            @if($menus)
                                @foreach($menus['submenus'] as $submenu)
                            <li class="nav-item px-2 {{ Route::currentRouteNamed(request()->route()->getName() == $submenu['url']) ?  'active' : '' }}">
                                <a class="nav-link font-weight-bold text-white {{request()->route()->getName() == "home" ? 'text-white' : ''}}" href="{{$submenu['url'][app()->getLocale()]}}">{{$submenu['name'][app()->getLocale()]}} </a>
                            </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </nav>
            </div>


        </div>
    </div>
    <div class="w-100 search collapse " id="serch">
        <div class="bg-dark search">
            <div class="container">
                <form class="row no-gutters align-items-center py-3">
                    <div class="col-10">
                        <input type="text" placeholder="{{__("Type your search word here")}}" class="form-control text-white form-control-lg h-55p bg-transparent border-0 rounded-0" autofocus="">
                    </div>
                    <div class="col-2 bg-dark text-center">
                        <button type="submit" class="btn text-white h-55p rounded-0"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header> -->
