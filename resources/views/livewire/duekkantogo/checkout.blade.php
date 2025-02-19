<main class="Privacy">
    <div class="container">
        <div class="row my-5">
            @if($carts->count() > 0)
                <div class="col-12">
                    <h3 class="text-secondary mb-3 font-weight-bold">{{__("Shopping Cart")}}
                        ({{$carts->count()}} {{__("Items")}})</h3>
                </div>
                <div class="col-lg-8">
                    @foreach($carts as $cart)
                        <div class="card shadow card-body rounded-lg border-0 mb-3">
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <div class="h-130p overflow-hidden">
                                        <img src="{{$cart->product->image}}" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="card-title mb-3">{{$cart->name}}</h5>

                                    <div class="row mx-auto w-100 px-2">
                                                    <span class="btn btn-secondary bg-secondary col-3 col-sm-2 w-35p h-35p d-flex justify-content-center align-items-center"
                                                          wire:click.prevent="minus('{{$cart->id}}')"><i
                                                            class="fa fa-minus"></i></span>
                                        <input class="col-md-7 col-6 border-0 bg-light text-center" type="number"
                                               id="quantity" value="{{$cart->qty}}" min="1">
                                        <span class="btn btn-secondary bg-secondary col-3 col-sm-2 w-35p h-35p d-flex justify-content-center align-items-center"
                                              wire:click.prevent="plus('{{$cart->id}}')"><i
                                                class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <div class="position-relative h-100">
                                        <p class="h5 text-secondary">{{$cart->price_string }}</p>
                                        <p class="h5 text-secondary">{{__("Total")}} {{$cart->total_string}}</p>
                                        <button class="btn position-absolute btm-0 right-0 left-edit btn-danger"
                                                wire:click.prevent="remove('{{$cart->id}}')"><i
                                                class="far fa-trash-alt"></i> {{__("Delete")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            @else
                <div class="col-lg-8">
                    <div class="alert alert-danger mt-3"> {{__("Empty Cart")}}</div>
                </div>
            @endif
            <div class="col-lg-4">

                    <div class="card shadow card-body rounded-lg border-0 mb-3">
                        <h3>{{__("Delivery to address")}}:</h3>
                        @foreach($address as $address_)
                            <label>
                                <input class="mr-2" type="radio" wire:model="address_id" name="address_id"
                                       value="{{$address_->id}}"/>{{$address_->name}} , {{$address_->location}}
                                ,{{$address_->email}}
                                ,{{$address_->mobile}}
                            </label>
                        @endforeach

                        <button type="button" wire:click="$set('add_new_address', {{!$add_new_address}})"
                                class="btn btn-secondary bg-secondary">{{__("Add New Address")}}</button>

                        @if($add_new_address)
                            <h3 class="box-title mt-3">{{__("Add New Address")}}</h3>
                            <div class="form-group">
                                <label for="name">{{__("Name")}}<span>*</span></label>
                                <input type="text" id="name" wire:model.defer="new_address.name" class="form-control"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__("Email")}}<span>*</span></label>
                                <input type="email" id="email" wire:model.defer="new_address.email" class="form-control"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__("Mobile")}}<span>*</span></label>
                                <input type="number" id="mobile" wire:model.defer="new_address.mobile"
                                       class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__("Address")}}<span>*</span></label>
                                <input type="text" id="location" wire:model.defer="new_address.location"
                                       class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__("Zip code")}}<span>*</span></label>
                                <input type="text" id="zip_code" wire:model.defer="new_address.zip_code"
                                       class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__("Note")}}<span>*</span></label>
                                <input type="text" id="note" wire:model.defer="new_address.note" class="form-control"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success"
                                        wire:click.prevent="saveAddress">{{__("Save Address")}}</button>
                            </div>
                        @endif

                    </div>

                    <div class="card shadow card-body rounded-lg border-0 mb-3">
                        <h3>{{__("Payment gateway")}}:</h3>
                        <div class="row">
                            @foreach($payment_gatewaies as $payment_gateway)

                            <div class="col-12">
                                <div style="border-radius: 10px" class="border py-1 px-2 rounded-3 shadow-sm h-100">
                                    <label class="m-0">
                                        <input type="radio" class="font-20 w-radio" wire:model="payment_gateway_id" name="payment_gateway_id"
                                               value="{{$payment_gateway->id}}"/> <img src="{{$payment_gateway->image}}"
                                                                                       width="50" class="rounded-circle align-middle"
                                                                                       height="50"/> <span class="align-middle">{{$payment_gateway->name}}</span>
                                    </label>
                                </div>

                            </div>
                            @endforeach

                        </div>

                    </div>

                    <div class="card shadow card-body rounded-lg border-0 mb-3">
                        <h3>{{__("Delivery method")}}:</h3>

                            <label>
                                <input type="radio" class="w-radio" wire:model="delivery_method" name="delivery_method"
                                       value="0"/> <span class="ml-1">{{__("From Store")}}</span>
                            </label>


                            <label>
                                <input type="radio" class="w-radio" wire:model="delivery_method" name="delivery_method"
                                       value="1"/> <span class="ml-1">{{__("By Delivery")}}</span>
                            </label>

                    </div>

                <div class="card card-body border-0 shadow-sm rounded-lg mb-3">
                    <h5 class="text-secondary font-weight-bold ">{{__("Discount Code")}}</h5>
                    <div class="row">
                        <div class="col-8">
                            <input class="form-control bg-light border-0 rounded" type="text" placeholder="c-00000" wire:model.defer="coupon">
                        </div>
                        <div class="col-4">
                            <button wire:click="refreshCarts" class="btn btn-danger">{{__("Check")}}</button>
                        </div>
                        @if($coupon_message == "success")
                            <div class="col-12">
                                <h3>{{__("Code")}}:{{$discount_code}} </h3>
                                <h3>{{__("Present")}}:{{$coupon_percent}}%</h3>
                                <h3>{{__("Amount")}}:{{$coupon_price}} </h3>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card card-body border-0 shadow-sm rounded-lg mb-3">
                    <h2 class="text-secondary font-weight-bold ">{{__("Total")}}</h2>
                    <ul class="nav flex-column">
                        <li class="nav-item font-weight-bold py-3">{{__("Total Price")}}<span
                                class="float-right">{{$cart_total}} {{$cart->product->store->currency->code}}</span></li>
                        <li class="nav-item font-weight-bold py-3 border-bottom">{{__("Delivery Fee")}} <span
                                class="float-right">{{$delivery_fee_price}} {{$cart->product->store->currency->code}} </span>
                        </li>
                        @if($coupon_message == "success")
                            <li class="nav-item font-weight-bold py-3 border-bottom">{{__("Discount")}} <span
                                    class="float-right">{{$coupon_price}} {{$cart->product->store->currency->code}} </span>
                            </li>
                        @endif

                        <li class="nav-item font-weight-bold py-3"><h4>{{__("Total (incl. VAT)")}} <span
                                    class="float-right">{{$total}} {{$cart->product->store->currency->code}}</span>
                            </h4></li>
                    </ul>
                </div>
                <div class="text-right">
                    <button class="btn btn-lg btn-success" wire:click.prevent="confirm"><i
                            class="fa fa-check"></i>
                        {{__("Confirm")}}
                    </button>
                </div>
            </div>

        </div>
    </div>

</main>

