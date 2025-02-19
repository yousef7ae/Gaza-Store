<div :key="'products-'.{{rand(1,1000)}}" class="">
    <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card-body mb-3">
            <h5 class="card-title h-50p overflow-hidden pe-4 pe-2"><a href="{{route('product',$product->id)}}" class="text-decoration-none text-black"> {{$product->name}}  </a></h5>
            <p class="card-text mb-1 h-45p overflow-hidden">{{ strlen($product->description) > 50 ? substr($product->description,0,50).'..' : $product->description }} </p>


            <div class="position-relative stars w-80p">
                <span class="star1"></span>
                <span class="star2" style="width: {{($product->rate/5)*100}}%"></span>
            </div>
            <span class="p-2 position-absolute top-0 left-0 position-relative z-index40">
            @livewire('site.favorites.add-to-favorite',[ 'product_id' => $product ])
            </span>
        </div>
        <div class="d-flex justify-content-center align-items-center overflow-hidden position-relative h-120p">
            <img src="{{ $product->image ? $product->image : url('assets/img/portfolio/portfolio-2.jpg')}}" class="card-img-top" alt="{{$product->name}}">
        </div>
        <div class="card-body">
            <h6 class="fw-bold pt-2 d-flex justify-content-between text-danger">{{$product->price}} {{$product->store ? $product->store->currency->code : ""}} <small><del class="text-secondary"> {{$product->old_price}} {{$product->store ? $product->store->currency->code : ""}}</del></small></h6>
            <div class="d-flex justify-content-between pt-3 text-center">
            @livewire('site.carts.add-to-cart',[ 'product_id' => $product ])
                <button type="button" class="btn px-0 ms-2 btn-outline-primary rounded-circle w-35p h-35p" data-bs-toggle="modal" data-bs-target="#product-modal_{{$product->id}}"><i class="fa-solid fa-eye"></i></button>
                @push('js_code')
                <div class="modal fade" id="product-modal_{{$product->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body rounded-0 p-0">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="modal-product d-flex justify-content-center align-items-center bg-dark h-100">
                                            <img class="img-fluid" src="{{ $product->image ? $product->image : url('fedi/img/img-4.png')}}" alt="{{$product->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn-close float-end m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="card border-0 card-body pt-5">
                                            <h3 class="fw-bold">{{$product->name}}</h3>
                                            <h5 class="py-2 fw-bold">{{$product->description}} </h5>
                                            <div class="position-relative stars w-80p">
                                                <span class="star1"></span>
                                                <span class="star2" style="width: {{($product->rate/5)*100}}%"></span>
                                            </div>

                                            <div class="py-3 mb-3">
                                                <div class="p-3 d-flex align-items-center">
                                                    <h4 class="fw-bold pt-2">{{__("Quantity")}}</h4>
                                                    <div class="d-inline-flex px-3">
                                                        <button class="btn btn-outline-primary plus w-35p h-35p d-flex justify-content-center align-items-center rounded-circle hover-trans"><i class="fa-solid fa-plus"></i></button>
                                                        <input class="w-50p text-center count border-0" type="text" value="1" max="99">
                                                        <button class="btn btn-outline-primary minus rounded-circle w-35p h-35p d-flex justify-content-center align-items-center hover-trans"><i class="fa-solid fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @livewire('site.carts.add-to-cart',[ 'product_id' => $product ])
                                        </div>
                                        <div class="border-top mx-4 pt-3">
                                            <h4 class="text-p">قسم : <span class="text-primary font-weight-bold">{{$product->store ? $product->store->name : ""}}</span> </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpush
            </div>
        </div>
    </div>
</div>


