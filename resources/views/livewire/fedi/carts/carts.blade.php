    <main :key="{{rand(1,1000)}}">
        <div class="container">
            <nav class="py-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{__('Shopping Cart')}}  </li>
              </ol>
            </nav>
        </div>
        <div class="container my-4 shopping">
            <h3 class="fw-bold mb-4"> {{__('Shopping Cart')}} </h3>
            <div class="row">
            @if($carts->count() > 0)
                <div class="col-lg-8 mb-3">
                    <div class="bg-light border rounded-3 p-2 table-responsive-sm">
                        <table class="table ">
                          <thead>
                            <tr>
                              <th class="text-p" scope="col">المنتج</th>
                                <th class="text-p" scope="col">اللون / الحجم </th>
{{--                                <th class="text-p" scope="col">اللون و الحجم</th>--}}
                                <th class="text-p" scope="col">الكمية </th>
                              <th class="text-p" scope="col">الاجمالي</th>
                              <th class="text-p" scope="col">الحذف</th>
                            </tr>
                          </thead>
                          <tbody class="border-top">
                                @foreach($carts as $cart)
                                <tr>
                                    <th class="align-middle">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-md-5">
                                                <div class="overflow-hidden pe-2">
                                                    <img src="{{$cart->product ? $cart->product->image : url('fedi/img/img-ss.png')}}" class="img-fluid" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="pb-4 position-relative">
                                                    <p class="h6 card-title mb-2">{{$cart->product_name}} </p>
                                                    <p class="card-text text-p mb-1"><small>{{$cart->product->name}}</small> </p>
                                                    <div class="position-relative stars w-80p">
                                                        <span class="star1"></span>
                                                        <span class="star2" style="width: {{($cart->product->rate/5)*100}}%"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        <livewire:site.carts.cart-constant :product_id="$cart->product_id" :count="2"
                                                                             :key="'cart-constant-'.rand(1,1000)"></livewire:site.carts.cart-constant>

                                    </td>
                                    <td class="align-middle">
                                    <div class="d-inline-flex rounded-pill bg-white">
                                            <span class="btn text-p plus w-35p h-35p d-flex justify-content-center align-items-center rounded-circle hover-trans" wire:click.prevent="plus('{{$cart->id}}')"><i class="fa-solid fa-plus"></i></span>
                                            <input class="border-0 text-p w-50p text-center" id="quantity" value="{{$cart->qty}}" min="1">
                                            <span class="btn text-p minus rounded-circle w-35p h-35p d-flex justify-content-center align-items-center hover-trans" wire:click.prevent="minus('{{$cart->id}}')"><i class="fa-solid fa-minus"></i></span>
                                        </div>
                                    </td>
                                    <td class="align-middle"><p class="mb-0 fw-bold text-p">{{$cart->total}}</p></td>
                                    <td class="align-middle"><button class="btn btn-danger rounded-circle" wire:click.prevent="remove('{{$cart->id}}')"><i class="fa-solid fa-trash-can"></i></button></td>
                                </tr>
                                @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="bg-light border rounded-3 p-3">
                        <h5>{{__('Cart Total')}} </h5>
                        <div class="border-bottom p-3">
                            <div class="d-flex justify-content-between fw-bold">
                                <p> {{__("Total Price")}} </p>
                                <p class="text-dark">{{$total}} {{$cart->product->store ? $cart->product->store->currency->code : ""}}</p>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <p> {{__("Delivery Fee")}}  </p>
                                <p class="text-dark">{{$cart->product->store ? $cart->product->store->currency->code : ""}} </p>
                            </div>
                        </div>

                        <div class="my-3">
                            <h5 class="fw-bold mb-3"> {{__("Discount Code")}} </h5>
                            <form method="post" wire:submit.prevent="changediscount">
                            <div class="d-flex justify-content-between">
                                <input class="form-control rounded-pill me-2" type="text" wire:model.defer="discount" placeholder="c-00000">
                                <button class="btn px-md-5 px-3 rounded-pill btn-primary" type="submit">تطبيق</button>
                            </div>
                            </form>

                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <p> {{__('Total After Discount')}}</p>
                            <p class="text-primary">{{$total}} {{$cart->product->store ? $cart->product->store->currency->code : ""}}</p>
                        </div>
                        <div class="text-center mt-3">
                            <a class="btn btn-dark w-90 mx-auto rounded-pill" href="{{route('checkout')}}"> {{__('Pay now')}} </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-7">
                    <div class="alert alert-danger mt-3"> {{__("Empty Cart")}}</div>
                </div>
            @endif
            </div>
        </div>
        <!-- start 3 section products-->
<section class="products">
    <div class="container py-5">
        <div class="border-bottom mb-3">
            <div class="w-90 d-flex justify-content-between">
                <h2 class="mb-3 fw-bold"> {{__("Today's Deals")}} </h2>
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


