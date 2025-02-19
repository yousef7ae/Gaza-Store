<div>

    @livewire('site.sliders')

    @livewire('site.categories.categories')

    @livewire('site.stores.stores')

    @if($new_products->count() > 0)
        <section class="my-3 most">
            <div class="container">
                <h2 class="text-danger mb-4">{{__("New products")}}</h2>
                <div class="row no-gutters">
                    @foreach($new_products as $new_product)
                        <div class="col-md-3 col-6 min-h-250p mb-4 overflow-hidden px-md-3 px-2">

                        @livewire('site.products.product-card',[ 'product_id' => $new_product ])
                        </div>
                         @endforeach
                </div>
            </div>
        </section>

    @endif

    @if($ads->count() > 0)

        <div class="container">
            <div class="row justify-content-between">
                @foreach($ads->take(2) as $ad)

                    <div class="col-md-6 my-2">
                        <div class="shopping shopping2 overlay px-3 rounded-10"
                             style="background: url({{$ad->image}}) center center no-repeat;">
                            <div class="row align-items-center min-h-250p">
                                <div class="col-md-8">
                                    <h2 class="text-white">{{$ad->title}}<br>
                                        {{$ad->description}}
                                    </h2>
                                </div>
                                <div class="col-md-4">
                                    <a href="/stores" class="btn btn-danger py-3">{{__("Start Shopping")}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @endif


    @if($most_wonted_list->count() > 0)

        <section class="my-3 most">
            <div class="container">
                <h2 class="text-danger mb-4">{{__("Most Wanted")}}</h2>
                <div class="row">
                    <div class="col-lg-12 order-lg-1 order-2">
                        <div class="row no-gutters">

                            @foreach($most_wonted_list->take(6) as $most_wonted)
                        <div class="col-md-3 col-6 min-h-250p mb-4 overflow-hidden px-md-3 px-2">

                                @livewire('site.products.product-card',[ 'product_id' => $most_wonted , 'count'  => 4 ])
                        </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-12 order-3 text-center">
                        <a href="#" class="btn btn-outline-danger px-5 py-2">{{__("View All")}}</a>
                    </div>
                </div>
            </div>
        </section>

    @endif

    <section class="py-4 take">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-danger mb-4">{{__("Brands")}}</h4>
                    <div class="mb-4 row no-gutters">
                        @foreach( $brands->take(6) as $brand)
                            <div class="col-lg-2 col-md-3 col-4 p-1">
                                <a href="#brand-{{$brand->id}}"
                                   class="d-flex h-100 rounded shadow justify-content-center align-items-center"><img
                                        class="img-fluid cover"
                                        src="{{ $brand->image ? $brand->image : url('assets/images/image.png')}}"
                                        alt=""></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach($ads->take(1) as $ad)
        <section class="shopping shopping3 overlay" style="background:#33709C url({{$ad->image}}) center center no-repeat;">
            <div class="container h-100">
                <div class="row align-items-center min-h-250p">
                    <div class="col-md-9">
                        <h2 class="text-white">{{$ad->title}}<br>
                            {{$ad->description}}
                        </h2>
                    </div>
                    <div class="col-md-3">
                        <a href="/stores" class="btn px-lg-5 border-light btn-danger py-3">{{__("Start Shopping")}}</a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

</div>

