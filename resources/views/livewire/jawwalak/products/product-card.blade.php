    <div key="products-{{rand(1,1000)}}" class="card shadow-sm border min-h340p rounded-20"
         data-aos-delay="200">
        <div class="px-3 my-2">
            <a href="{{route('product',$product->id)}}" class="overflow-hidden h-130p hover-skl text-center">
                <img width="100%" height="150"
                     src="{{ $product->image ? $product->image : url('assets/images/DTctGB-iphone-transparent-shop.png')}}"
                     class="card-img-top contain mb-2 "
                     alt="{{$product->name}}">
            </a>
            <div class="">
                <a href="{{route('product',$product->id)}}" class="h5 mb-2 card-title">{{$product->name}}</a>
                <h5 class="text-right text-secondary font-weight-bold">{{$product->price_string}}</h5>
            </div>
            <p class="h-60p mb-0"></p>
            <div class="position-absolute w-90 pb-1 mx-auto btm-0">
                <div class="py-2 d-flex">
                    <div class="w-75">
                        <div class="position-relative mb-4 w-110p">
                            <span class="star1"></span>
                            <span class="star2" style="width: {{($product->rate/5)*100}}%"></span>
                        </div>
                     </div>
                    <div class="w-25 text-center">
                        @livewire('site.carts.add-to-cart',[ 'product_id' => $product ])
                    </div>
                </div>
{{--                <div class="d-flex w-100 ">--}}
{{--                    <img src="{{ asset('assets/images/DTctGB-iphone-transparent-shop.png') }}" width="40px" height="40px" class="align-middle my-auto p-1 bg-white border rounded-circle shadow-sm contain" alt="">--}}
{{--                    <div class="align-middle my-auto">--}}
{{--                        <h5 class="font-18 ml-1 mb-0">{{$product->store ? $product->store->name :""}}</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}


            </div>
            <div class="position-absolute top-0 right-0 m-2">
                @livewire('site.favorites.add-to-favorite',[ 'product_id' => $product ])
            </div>
        </div>
    </div>

