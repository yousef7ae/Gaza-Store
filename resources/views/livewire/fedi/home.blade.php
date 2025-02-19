<div>

    <!-- Stores -->
    @livewire('site.sliders')
    <!-- Stores -->
{{--    @livewire('site.categories.categories')--}}
    <section class="">
        @if($categories->count() > 0)
            <div class="container">
                <div class="row">
                    @foreach($categories->take(3) as $category)
                        <div class="col-md-4 col-6 mx-auto">
                            <div class="card layout my-3 shadow-sm d-flex justify-content-center align-items-center h-300p overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                                <a class="text-center mx-auto stretched-link" href="{{route('stores-single',$category->store_id)}}?category_id={{$category->id}}">
                                    <img class="cover" src="{{ $category->image ? $category->image : url('fedi/img/img-2.png')}}" alt="">
                                    <div class="carousel-caption text-white">
                                        <h4 class="text-white fw-bold"> {{$category->name}} </h4>
                                        <p>{{$category->description}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                <a href="{{route('site.categories')}}" class="btn fw-bold px-md-5 px-3 py-2 btn-primary rounded-o"> {{__('Show More')}} </a>
                </div>
            </div>
        @endif
    </section>

    @if($most_wonted_list->count() > 0)

    <section class="products">
        <div class="container py-5">
            <div class="border-bottom mb-3">
                <div class="w-90 d-flex justify-content-between">
                    <h2 class="mb-3 fw-bold"> {{__("Most Wanted")}} </h2>
                    <a class="h4 nav-link text-dark" href="#"> {{__('View products')}}  <span class="bg-primary cont-o rounded-circle text-white">{{$most_wonted_list->count()}}</span></a>
                </div>
            </div>
            <div>
                <div class="product">
                @foreach($most_wonted_list->take(6) as $most_wonted)
                        <div class="item mx-md-3 mx-1">
                   @livewire('site.products.product-card',[ 'product_id' => $most_wonted , 'count'  => 3 ])
                        </div>
                @endforeach
                </div>

            </div>
        </div>

    </section>
    @endif


    <section>
        <div class="container">
        @foreach($ads->random(1) as $ad)
            <div class="row">
                <div class="col-md-7">
                    <div class="d-flex justify-content-center align-items-center overflow-hidden position-relative">
                        <img src="{{ $ad->image ? $ad->image : url('fedi/img/Group 43853.png')}}" class="card-img-top rounded-2" alt="...">
                    </div>
                </div>
                <div class="col-md-5 align-self-center">
                    <h2 class="fs-1 fw-bold mb-4"> <br> {{$ad->title}} </h2>
                    <p> {{$ad->description}}</p>
                    <a href="{{route('site.categories')}}" class="btn fw-bold px-md-5 px-3 btn-outline-primary rounded-o"> {{__("Shop Now")}}</a>
                </div>
            </div>
        @endforeach
        </div>
    </section>


    <section class="products">
        <div class="container py-5">
            <div class="border-bottom mb-3">
                <div class="w-90 d-flex justify-content-between">
                    <h2 class="mb-3 fw-bold"> {{__("New products")}} </h2>
                    <a class="h4 nav-link text-dark" href="#"> {{__('View products')}}  <span class="bg-primary cont-o rounded-circle text-white"> {{$new_products->count()}} </span></a>
                </div>
            </div>
            <div>
                <div class="product">
                @foreach($new_products as $new_product)
                        <div class="item mx-md-3 mx-1">
                        @livewire('site.products.product-card',[ 'product_id' => $new_product ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>


    @livewire('site.subscribes')


    <section>
        <div class="container">
            <div class="clients">
            @foreach( $brands->take(6) as $brand)
                <div class="box-clients px-4"><img src="{{ $brand->image ? $brand->image : url('fedi/img/clients/client-1.png')}}" class="img-fluid" alt=""></div>
            @endforeach

            </div>
        </div>
    </section>

    @livewire('site.contacts')

</div>


