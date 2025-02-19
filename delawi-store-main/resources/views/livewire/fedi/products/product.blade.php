<main key="{{rand(1,1000)}}">
    <div class="container mt-3">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a class="text-p" href="#">{{$product->category ? $product->category->name : '-'}}</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page"><span>{{$product->name}}</span></li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row Product">
            <!-- Product gallery-->
            <div class="col-lg-6">
                <div class="h-460p d-flex justify-content-center border rounded-3 align-items-center overflow-hidden">
                    @foreach($product->images->random(1) as $image)
                    <img class="rounded-xl w-100 larg-image" src="{{ $image->image ? $image->image : url('fedi/img/img-10.png')}}" alt="{{$product->name}}">
                    @endforeach
                </div>
                <div class="slider-for mt-3 px-4">
                    @foreach($product->images as $image)
                    <button class="btn rounded overflow-hidden mb-2 mx-2 d-flex align-items-center justify-content-center">
                        <img height="150" class="image-click" src="{{ $image->image ? $image->image : url('fedi/img/img-10.png')}}" alt="{{$product->name}}">
                    </button>
                    @endforeach

                </div>
            </div>
            <!-- Product details-->
            <div class="col-lg-6 pt-4 pt-lg-0">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{$product->name}}
                            @if(!empty($copone))
                            <small class="bg-danger d-inline-block rounded text-white px-3 py-1 fs-6">{{__('Discount')}}
                            {{$copone ? ($copone->value/$product->price) * 100 : ""}}%</small>
                            @endif
                        </h4>
                        <div class="position-relative mb-4 w-80p">
                            <span class="star1"></span>
                            <span class="star2" style="width: {{($product->rate/5)*100}}%"></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fs-1 text-primary fw-bold">{{$product->store ? $product->store->currency->code : ""}} {{$product->price}}
                            @if($product->old_price != 0)
                                <small class="d-inline-block text-p px-3 py-1 fs-5"><del><sup>{{$product->old_price}} {{$product->store ? $product->store->currency->code : ""}}</sup></del></small>
                            @endif
                        </h2>
                        @if($product->old_price != 0)
                            <p class="fw-bold text-warning"> <img class="pe-2" src="{{asset('fedi/img/icon4.png')}}" alt=""> {{__('Exclusive offer')}} </p>
                        @endif
                    </div>

                    <p>{{$product->description}} </p>
                        @livewire('site.products.product-constant',[ 'product_id' => $product->id ])
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <p class="text-danger fw-bold mb-0">الكمية </p>
                            <a class="text-decoration-none" href="{{route('carts')}}">
                            <div class="px-4 py-2 bg-white rounded-pill d-flex border">
                                <span class="btn d-inline-block hover-scl p-0 minus"><i class="fas fa-minus"></i></span>
                                <input class="w-35p text-center count border-0" type="text" value="1">
                                <span class="btn d-inline-block hover-scl p-0 plus"><i class="fas fa-plus"></i></span>
                            </div>
                            </a>
                                @livewire('site.carts.add-to-cart',[ 'product_id' => $product ])
                                @livewire('site.favorites.add-to-favorite',[ 'product_id' => $product ])
                        </div>

                </div>
                <a href="{{route('carts')}}" class="btn btn-dark px-3 py-2 rounded-pill w-100 my-2">اشتري الان !</a>
                <div href="" class="btn px-3 share-o py-2 rounded-pill w-100 my-2"> <div class="sharethis-inline-share-buttons text-center"></div> </div>
            </div>
        </div>
    </div>
    <!-- start 3 section products-->
    <section class="products">
        <div class="container py-5">
            <div class="border-bottom mb-3">
                <div class="w-90 d-flex justify-content-between">
                    <h2 class="mb-3 fw-bold">عروض اليوم </h2>
                </div>
            </div>
            <div>
                <div class="product">
                    @foreach($most_wonted_list as $most_wonted)
                        <div class="item mx-md-3 mx-1">
                            <livewire:site.products.product-card :product_id="$most_wonted" :count="1"
                                                                 :key="'product-card-'.rand(1,1000)"></livewire:site.products.product-card>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

</main>

