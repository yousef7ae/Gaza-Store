<div key="{{rand(1,1000000)}}" class="mt-5">

    <section class="">
        @if($store->sliders->count() > 0)
            <div class="owl-carousel owl-theme archive">
                @foreach($sliders as $slider)
                    <div class="item">
                        <a href="{{ !empty($slider->product_id) ? route('product',$slider->product_id) : '#' }}" class="d-flex align-items-center vh-100 overlay overflow-hidden" style="height: 400px">
                            <img class="w-100"
                                 src="{{ $slider->image ? $slider->image : url('assets/images/image.png')}}"
                                 alt="{{$slider->name}}">
                            <div class="carousel-caption d-flex h-100 justify-content-start align-items-center">
                                <div class="container text-left">
{{--                                    <h2 class="font-weight-bold">{{$slider->name}}</h2>--}}
{{--                                    @if(!empty($slider->product_id))--}}
{{--                                        <a class="text-white" href="{{ route('product',$slider->product_id) }}">--}}
{{--                                            <span class="rounded-circle px-2 py-1 bg-danger"><i--}}
{{--                                                    class="fas fa-arrow-right"></i></span> {{__("Shop now")}} </a>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="height: 80px"></div>

        @endif
        <div class="container">
            <div class="filter max-w-950p mb-4">
                <div class="rounded-top-right bg-light p-3">
                    <div class="media">
                        <img width="100" height="100" src="{{ $store->image ? url($store->image) : url('assets/images/image.png')}}"
                             class="align-self-center shadow-sm rounded-circle mr-3" alt="...">
                        <div class="media-body mt-4">
                            <h5 class="mt-0 text-secondary">{{$store->name}}</h5>
                            <p>{{$store->description}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h5 class="border-bottom font-weight-bold pb-3 text-uppercase text-secondary"><span
                            class="info position-relative px-4">{{__("Info")}}</span></h5>
                    <div class="card rounded-lg border-0">
                        <div class="card-body">
                            <p>{{$store->description}}</p>
                            <div class="row">
                                <div class="col-md col-6  text-center">
                                    <i class="far fa-star fs-25p text-secondary"></i>
                                    <h5 class="text-secondary mb-1">{{$store->rate}}</h5>
                                    <p>{{__("Evaluation")}}</p>
                                </div>
                                <div class="col-md col-6  text-center">
                                    <i class="fab fa-palfed fs-25p text-secondary"></i>
                                    <h5 class="text-secondary mb-1">{{$store->products->count()}}</h5>
                                    <p>{{__("Products")}}</p>
                                </div>
                                <div class="col-md col-6  text-center">
                                    <i class="fas fa-users fs-25p text-secondary"></i>
                                    <h5 class="text-secondary mb-1">{{$store->orders->count()}}</h5>
                                    <p>{{__("Customers")}}</p>
                                </div>
                                <div class="col-md-5 col-6  text-center">
                                    <i class="far fa-clock fs-25p text-secondary"></i>
                                    @if($store->store_time_works()->where('status',1)->count() > 0)
                                        @foreach($store->store_time_works->where('status',1) as $store_time_work)
                                            <div class="text-secondary">
                                                {{$store_time_work->day}} {{date("H:i",strtotime($store_time_work->from))}}
                                                -{{date("H:i",strtotime($store_time_work->to))}}
                                            </div>
                                        @endforeach
                                    @else
                                        <h5 class="text-secondary">
                                            {{__("Undefined")}}
                                        </h5>
                                    @endif
                                                                        <p>{{__("Available until midnight")}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="border-bottom pb-3 text-uppercase"><span
                            class="info position-relative px-3">{{__("Contact information")}}</span>
                    </h5>
                    <div class="card rounded-lg border-0">
                        <div class="card-body">
                            <a href="tel:{{$store->phone}}"
                               class="nav-item nav-link px-2 text-dark d-flex align-items-center "><span
                                    class="fs-20p hover-skl text-white w-30p h-30p text-center mr-3 rounded bg-danger"><i
                                        class="fas fa-phone-volume"></i></span> {{$store->phone}}</a>
                            <a href="#" class="nav-item nav-link px-2 text-dark d-flex align-items-center "><span
                                    class="fs-20p hover-skl text-white w-30p h-30p text-center mr-3 rounded bg-danger"><i
                                        class="fas fa-map-marker-alt"></i></span> {{$store->address}} </a>
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link px-2 hover-skl"
                                       href="{{$store->url_facebook ? $store->url_facebook : "#"}} ">
                                        <span
                                            class="fs-20p text-white w-30p h-30p text-center rounded bg-danger d-inline-block"><i
                                                class="fab fa-facebook-f"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 hover-skl"
                                       href="{{$store->url_instagram ? $store->url_instagram : "#"}}">
                                        <span
                                            class="fs-20p text-white w-30p h-30p text-center rounded bg-danger d-inline-block"><i
                                                class="fab fa-instagram"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 hover-skl"
                                       href="{{$store->url_whatsapp ? $store->url_whatsapp : "#"}}">
                                        <span
                                            class="fs-20p text-white w-30p h-30p text-center rounded bg-danger d-inline-block"><i
                                                class="fab fa-whatsapp"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 hover-skl"
                                       href="{{$store->url_twitter ? $store->url_twitter : "#"}}">
                                        <span
                                            class="fs-20p text-white w-30p h-30p text-center rounded bg-danger d-inline-block"><i
                                                class="fab fa-twitter"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 hover-skl"
                                       href="{{$store->url_telegram ? $store->url_telegram : "#"}}">
                                        <span
                                            class="fs-20p text-white w-30p h-30p text-center rounded bg-danger d-inline-block"><i
                                                class="fab fa-telegram-plane"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <form class="container">
                <div class="form-row">
                    <div class="col-lg-3 col-6 mb-3">
                        <label class="mb-3" for="City">{{__("Brand")}}</label>
                        <select class="form-control" id="Brand" wire:model="brand_id">
                            <option value="">{{__("Brand")}}</option>
                            @foreach($store->brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-6 mb-3">
                        <label class="mb-3" for="Categories">{{__("Category")}}</label>
                        <select class="form-control" id="Categories" wire:model="category_id">
                            <option value="">{{__("Category")}}</option>
                            @foreach($store->categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-6 mb-3">
                        <label class="mb-4" for="Categories">{{__("Rate")}}</label>
                        <div class="position-relative mb-4 w-110p mx-auto">
                            <span wire:click="changeRate(5)" class="{{$rate >= 5 ? 'star2' : 'star1'}}"
                                  style="width: 100%"></span>
                            <span wire:click="changeRate(4)" class="{{$rate >= 4 ? 'star2' : 'star1'}}"
                                  style="width: 80%"></span>
                            <span wire:click="changeRate(3)" class="{{$rate >= 3 ? 'star2' : 'star1'}}"
                                  style="width: 60%"></span>
                            <span wire:click="changeRate(2)" class="{{$rate >= 2 ? 'star2' : 'star1'}}"
                                  style="width: 40%"></span>
                            <span wire:click="changeRate(1)" class="{{$rate >= 1 ? 'star2' : 'star1'}}"
                                  style="width: 20%"></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 mb-3">
                        <label class="mb-4" for="Categories"></label>
                        <input type="button" class="btn btn-danger px-md-2 px-1 btn-block" value="{{__("Search")}}">
                    </div>
                </div>
            </form>

        </div>
    </section>

    <section class="my-3 most">
        <div class="container">
            <h2 class="text-secondary mb-4">{{__("Products")}}</h2>
            <div class="row">
                @foreach($products as $product)
                   <div class="col-md-3 col-6 min-h-250p mb-4 overflow-hidden px-md-3 px-2">

                    <livewire:site.products.product-card :product_id="$product" :count="4"
                                                         :key="'product-card-'.rand(1,10000)"></livewire:site.products.product-card>
                   </div>
                @endforeach
            </div>

            {{$products->links()}}
        </div>
    </section>

{{--    <section class="my-3 most">--}}
{{--        <hr/>--}}
{{--        <div class="container">--}}
{{--            <h3>{{__("Store Reviews")}}</h3>--}}

{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}

{{--                </div>--}}
{{--                <div class="col-md-6 text-right">--}}

{{--                    @auth--}}
{{--                        @if(!in_array($store->id, auth()->user()->store_rates->pluck('id')->toArray()))--}}
{{--                            <div class="text-center">--}}
{{--                                <a href="#" class="btn btn-danger px-5 py-2" data-toggle="modal"--}}
{{--                                   data-target="#StoreRate"--}}
{{--                                   wire:click="StoreRate({{$store->id}})" title="{{__("Rate")}}"--}}
{{--                                >{{__("ADD OPINION")}}</a>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="text-center">--}}
{{--                                <a href="#" target="_blank" class="btn btn-danger px-5 py-2 disabled"--}}
{{--                                   title="{{__("Rate")}}">{{__("ADD OPINION")}}</a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @else--}}
{{--                        <div class="text-center">--}}
{{--                            <a href="{{route('login')}}" target="_blank" class="btn btn-danger px-5 py-2"--}}
{{--                               title="{{__("Rate")}}">{{__("ADD OPINION")}}</a>--}}
{{--                        </div>--}}
{{--                    @endauth--}}

{{--                </div>--}}

{{--                @if($store->store_rates->count() > 0)--}}
{{--                    @foreach ($store->store_rates as $store_rate)--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="card border-0 mt-3 shadow-sm mb-5">--}}
{{--                                <div class="card-body py-2">--}}
{{--                                    <span class="font-weight-bold text-secondary d-block fa-2x">,....</span>--}}
{{--                                    <p class="">{{$store_rate->comment}}</p>--}}
{{--                                    <span--}}
{{--                                        class="font-weight-bold text-secondary d-block text-right mt-n3 fa-2x">,....</span>--}}
{{--                                    <div class="mb-5 pt-4">--}}
{{--                                        <div class="media MOHAMMED">--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h5 class="mb-0 text-secondary">{{$store_rate->user ? $store_rate->user->name : '-'}}</h5>--}}
{{--                                            </div>--}}
{{--                                            <img--}}
{{--                                                src="{{ $store_rate->user ? $store_rate->user->image : url('Dukkan/images/logo.png') }}"--}}
{{--                                                class="mt-3 shadow-sm rounded-circle w-95p" alt="...">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}

{{--            </div>--}}
{{--            @if(auth()->check() and !in_array($store->id, auth()->user()->store_rates->pluck('id')->toArray()))--}}
{{--                <!--  StoreRate -->--}}
{{--                <div wire:ignore.self class="modal fade " id="StoreRate" tabindex="-1" role="dialog"--}}
{{--                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                    <div class="modal-dialog  modal-lg" role="document">--}}
{{--                        <div class="modal-content bg-white   text-center">--}}
{{--                            <div class="modal-header text-center">--}}
{{--                                <h5 class="modal-title text-center"--}}
{{--                                    id="exampleModalLongTitle">{{ __('Store Rate') }}</h5>--}}
{{--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <div>--}}
{{--                                    <div wire:loading>--}}
{{--                                        <i class="fas fa-sync fa-spin"></i>--}}
{{--                                        {{__("Loading please wait")}} ...--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                                @livewire('site.stores.store-rates',[--}}
{{--                                            [--}}
{{--                                            'store_rate_id' => $store->id,--}}
{{--                                            ]])--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--  StoreRate -->--}}
{{--            @endif--}}

{{--        </div>--}}
{{--    </section>--}}
</div>
