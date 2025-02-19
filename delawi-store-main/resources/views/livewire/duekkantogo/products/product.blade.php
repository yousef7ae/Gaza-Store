<main key="{{rand(1,1000)}}" class="mt-5 pt-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a class="text-secondary px-sm-2" href="#"><i class="fas fa-home"></i></a>
                </li>
{{--                <li class="breadcrumb-item"><a class="text-secondary px-sm-2"--}}
{{--                                               href="#">{{$product->store ? $product->store->name : '-'}}</a></li>--}}
                <li class="breadcrumb-item"><a class="text-secondary px-sm-2"
                                               href="#">{{$product->category ? $product->category->name : '-'}}</a></li>
                <li class="breadcrumb-item"><a class="text-secondary px-sm-2"
                                               href="#">{{$product->brand ? $product->brand->name : '-'}}</a></li>
                <li class="breadcrumb-item text-secondary font-weight-bold active"
                    aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
        <div class="row Product">
            <!-- Product gallery-->
            <div class="col-lg-7">
                <div class="row no-gutters">
                    <div class="col-md-2 col-3 px-2">
                        @foreach($product->images as $image)
                            <a href="#"
                               class="rounded overflow-hidden mb-2 d-flex align-items-center justify-content-center opacity-50">
                                <img height="110" class="image-click active"
                                     src="{{ $image->image ? $image->image : url('assets/images/image.png')}}"
                                     alt="{{$product->name}}">
                            </a>
                        @endforeach
                    </div>

                    <div class="col-md-10 col-9 px-2">
                        <div class="h-460p rounded overflow-hidden" >
                            @if(!empty($image))
                                <img class="rounded-xl w-100 larg-image"
                                     src="{{ $image->image ? $image->image : url('assets/images/image.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-body border-0 shadow rounded-20 mt-3 mb-3">
                    <div class="row ">
                        <div class="col-md-12">
                            @if($product->ProductDetails->count())
                                @foreach($product->ProductDetails as $ProductDetail)
                                    {{--                    <span class="bg-danger rounded mb-1 d-inline-block text-white px-2 py-1">SALE</span>--}}
                                    <p class="text-secondary"><small>Product ID: {{$ProductDetail->Value}}</small></p>
                                    <h4>{{$product->name}}</h4>
                                    <span class="text-secondary h4 pr-4">{{$ProductDetail->price_string}}</span>
{{--                                    <del class="text-secondary h4">{{$ProductDetail->price_string}}</del>--}}
                                @endforeach
                            @endif
                        </div>
                        <div class="col-6">
                            <h3>{{__("Price")}}:</h3>
                            <div class="text-secondary h4 pr-4">{{$product->price_string}}</div>
                        </div>
                        <div class="col-6">
                            @livewire('site.carts.add-to-cart',[ 'product_id' => $product ,'string' => true ])
                            @livewire('site.favorites.add-to-favorite',[ 'product_id' => $product ,'string' => true ])
                        </div>

                        <div class="col-md-12">

                            <h4 class="text-secondary">{{$product->name}}</h4>
                            <p class="pl-2">{{$product->description}}</p>
                        </div>
                    </div>
                </div>

                <h3 class="h2-desc pb-2 mb-4 border-secondary">{{__("Reviews")}}
                    ({{$product->product_rates->count()}})</h3>
                <div class="row no-gutters justify-content-center">
                    <div class="col-4 text-center">
                        <span class="font-weight-bold fs-58p"> {{$product->rate}}  </span>
                        <div class="position-relative mb-4 w-110p mx-auto">
                            <span class="star1"></span>
                            <span class="star2" style="width: {{($product->rate*5)/100}}%"></span>
                        </div>
                        <p class="text-secondary pt-2"><i
                                class="fas fa-user"></i> {{$product->product_rates->count()}} {{__("All opinions")}}</p>
                    </div>
                    <div class="col-8">
                        @for ($i = 1; $i <= 5 ; $i++)
                            <div class="clearfix mb-3">
                                <span class="float-left ml-3 mt-n1 pr-2"><i class="fas fa-star text-warning"></i> {{$i}} </span>
                                <div class="progress rounded-pill" style="height: 11px">
                                    <div class="progress-bar bg-warning rounded-pill" role="progressbar"
                                         style="width: {{ $product->product_rates->count() ? (($product->product_rates->where('rate',$i)->count()/$product->product_rates->count())*100) : 0}}%"
                                         id="start5" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endfor


                    </div>
                </div>

                @auth
                    @if(!in_array($product->id, auth()->user()->product_rates->pluck('id')->toArray()))
                        <div class="text-center">
                            <a href="#" class="btn btn-danger px-5 py-2" data-toggle="modal"
                               data-target="#ProductRate"
                               wire:click="ProductRate({{$product->id}})" title="{{__("Rate")}}"
                            >{{__("ADD OPINION")}}</a>
                        </div>
                    @else
                        <div class="text-center">
                            <a href="#" target="_blank" class="btn btn-danger px-5 py-2 disabled"
                               title="{{__("Rate")}}">{{__("ADD OPINION")}}</a>
                        </div>
                    @endif
                @else
                    <div class="text-center">
                        <a href="{{route('login')}}" target="_blank" class="btn btn-danger px-5 py-2"
                           title="{{__("Rate")}}">{{__("ADD OPINION")}}</a>
                    </div>
                @endauth
            </div>

            <!-- Product details-->
            <div class="col-lg-5 pt-2 pt-lg-0">
                {{--                <p class="mt-2 d-inline-flex align-items-center"><i class="fas text-secondary pr-3 fa-shuttle-van"></i>--}}
                {{--                    <small>Standard shipment <br> Free within 3-6 business days</small></p>--}}
                {{--                <p class="mt-2 d-inline-flex align-items-center"><i class="fas text-secondary pr-3 fa-shuttle-van"></i>--}}
                {{--                    <small>Express delivery<br>$35,00 available </small></p>--}}
            </div>
            {{--            <div class="col-md-6">--}}
            {{--                <h2 class="h2-desc pb-3 mb-4 border-bottom border-secondary">{{__("Description")}}</h2>--}}
            {{--                <h5 class="text-secondary">{{$product->name}}</h5>--}}
            {{--                <p class="pl-2">{{$product->description}}</p>--}}
            {{--            </div>--}}

        </div>

        <section class="my-3 most">
            <hr class="h2-desc pb-3 mb-4 border-bottom border-secondary"/>
            <div class="container">
                <h3 class="text-secondary font-weight-bold">{{__("Product Reviews")}}</h3>
                <div class="owl-carousel owl-theme" id="comment">
                    @if($product->product_rates->count() > 0)
                        @foreach ($product->product_rates as $product_rate)
                            <div class="item h-100 position-relative">
                                <div class="card border-0 my-3 shadow-sm mb-5">
                                    <div class="card-body py-2">
                                        <span class="font-weight-bold text-secondary d-block fa-2x">,....</span>
                                        <p class="">{{$product_rate->comment}}</p>
                                        <span
                                            class="font-weight-bold text-secondary d-block text-right mt-n3 fa-2x">,....</span>
                                        <div class="mb-5 pt-4">
                                            <div class="media MOHAMMED">
                                                <div class="media-body">
                                                    <h5 class="mb-0 text-secondary">{{$product_rate->user ? $product_rate->user->name : '-'}}</h5>
                                                </div>
                                                <img
                                                    src="{{ $product_rate->user ? $product_rate->user->image : url('Dukkan/images/logo.png') }}"
                                                    class="mt-3 shadow-sm rounded-circle w-95p" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


        @if(auth()->check() and !in_array($product->id, auth()->user()->product_rates->pluck('id')->toArray()))
            <!--  ProductRate -->
                <div wire:ignore.self class="modal fade " id="ProductRate" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content bg-white   text-center">
                            <div class="modal-header text-center">
                                <h5 class="modal-title text-center"
                                    id="exampleModalLongTitle">{{ __('Product Rate') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div wire:loading>
                                        <i class="fas fa-sync fa-spin"></i>
                                        {{__("Loading please wait")}} ...
                                    </div>
                                </div>

                                @livewire('site.products.product-rates',[
                                            [
                                            'product_rate_id' => $product->id,
                                            ]])

                            </div>
                        </div>
                    </div>
                </div>
                <!--  ProductRate -->
        @endif

    </div>
    </section>
    <section class="mb-4 mt-3">
        <div class="container">
            <hr class="h2-desc pb-3 mb-4 border-bottom border-secondary"/>
            <h3 class="text-secondary font-weight-bold">{{__("Most wanted")}}</h3>
            <div class="owl-carousel owl-theme" id="wanted">
                @foreach($most_wonted_list as $most_wonted)
                    <div class="item h-100 my-2 position-relative">
                        <livewire:site.products.product-card :product_id="$most_wonted" :count="1"
                                                             :key="'product-card-'.rand(1,1000)"></livewire:site.products.product-card>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    </div>
</main>
