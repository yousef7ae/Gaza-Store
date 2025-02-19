<main class="Privacy">
    <div class="container">
        <div class="filter max-w-950p mb-4">
            <div class="rounded-top-right bg-light p-md-3">
                <h1 class="text-secondary h3">{{$page_data->description_lang}}</h1>
            </div>
        </div>
        <div class="row mb-3">
            @if($carts->count() > 0)
                <div class="col-12">
                    <h3 class="text-secondary font-weight-bold">{{__("Shopping Cart")}}
                        ({{$carts->count()}} {{__("Items")}})</h3>
                </div>
                <div class="col-lg-8">
                    @foreach($carts as $cart)
                        <div class="card shadow card-body rounded-lg border-0 mb-3">
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <div class="h-130p overflow-hidden">
                                        <img src="{{$cart->product ? $cart->product->image : ''}}" class="card-img-top"
                                             alt="{{$cart->product?$cart->product->name:'Deleted'}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="card-title mb-3">{{$cart->product?$cart->product->name:'Deleted'}}</h5>
                                    <div class="row mx-auto w-100 px-2">
                                                    <span
                                                        class="btn btn-secondary bg-secondary col-3 col-sm-2 w-35p h-35p d-flex justify-content-center align-items-center"
                                                        wire:click.prevent="minus('{{$cart->id}}')"><i
                                                            class="fa fa-minus"></i></span>
                                        <input class="col-md-7 col-6 border-0 bg-light text-center" type="number"
                                               id="quantity" value="{{$cart->qty}}" min="1">
                                        <span
                                            class="btn btn-secondary bg-secondary col-3 col-sm-2 w-35p h-35p d-flex justify-content-center align-items-center"
                                            wire:click.prevent="plus('{{$cart->id}}')"><i
                                                class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <div class="position-relative h-100">
                                        <p class="h5 text-secondary">{{$cart->price_string}}</p>
                                        <p class="h5 text-secondary">{{__("Total")}} {{$cart->total_string}}</p>
                                        <button class="btn btn-danger bg-danger position-absolute btm-0 right-0 left-edit "
                                                wire:click.prevent="remove('{{$cart->id}}')"><i
                                                class="far fa-trash-alt"></i> {{__("Delete")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="col-lg-4">

                    <div class="card card-body border-0 shadow-sm rounded-lg mb-3">
                        <h5 class="text-secondary font-weight-bold ">{{__("Discount Code")}}</h5>
                        <input class="form-control bg-light border-0 rounded" type="text" placeholder="c-00000">
                    </div>

                    <div class="card card-body border-0 shadow-sm rounded-lg mb-3">
                        <h2 class="text-secondary font-weight-bold ">{{__("Total")}}</h2>
                        <ul class="nav flex-column">
                            <li class="nav-item font-weight-bold py-3">{{__("Total Price")}}<span
                                    class="float-right">{{$total}} {{$cart->product->store->currency->code}}</span></li>
                            <li class="nav-item font-weight-bold py-3 border-bottom">{{__("Delivery Fee")}} <span
                                    class="float-right">0 {{$cart->product->store->currency->code}} </span>
                            </li>
                            <li class="nav-item font-weight-bold py-3"><h4>{{__("Total (incl. VAT)")}} <span
                                        class="float-right">{{$total}} {{$cart->product->store->currency->code}}</span>
                                </h4></li>
                        </ul>
                    </div>
                    <div class="text-right">
                        <a href="{{route('checkout')}}" class="btn btn-lg btn-success"><i
                                class="fa fa-check"></i>
                            {{__("Checkout")}}
                        </a>
                    </div>
                </div>
            @else
                <div class="col-lg-7">
                    <div class="alert alert-danger mt-3"> {{__("Empty Cart")}}</div>
                </div>
            @endif
        </div>
    </div>

</main>
