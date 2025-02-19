<main class="mt-4 pt-2 Privacy" style="margin-top: 150px !important;">
    <div class="container">
        <div class="row">
            <!-- sidebar -->
            @livewire('site.profile.sidebar')

            <div class="col-lg-8">
                <h4 class="text-danger mb-4">{{__("Order Detail")}}</h4>

                <div class="row no-gutters mt-3">

                    <div class="row">

                        <h5 class="col-12 card-title text-center"><img class="img-thumbnail" width="200" src="{{$order->qr_code}}"/> </h5>
                        <h5 class="col-3 card-title">{{$order->order_number}}</h5>
                        <h5 class="col-3 card-title">{{$order->store?$order->store->name : "N/A"}}</h5>
                        <h5 class="col-3 card-title">{{$order->delivery?$order->delivery->name:"N/A"}}</h5>
                        <h5 class="col-3 card-title">{{$order->created_at}}</h5>
                        <h5 class="col-3 card-title">{{__("Items Count")}}: {{$order->OrderDetails->count()}}</h5>
                        <h5 class="col-3 text-right font-weight-bold">
                            {{__("Status")}}: @if($order->status == 1)
                                <span class="badge bg-secondary text-white">{{__("Delivery")}}</span>
                            @elseif($order->status == 2)
                                <span class="badge bg-success text-white">{{__("Done")}}</span>
                            @elseif($order->status == 3)
                                <span class="badge bg-danger text-white">{{__("Deleted")}}</span>
                            @else
                                <span class="badge bg-primary text-white">{{__("Pending")}}</span>
                            @endif

                        </h5>
                        <h5 class="col-6 text-right text-danger font-weight-bold">{{__('Total')}}: {{$order->total}}$</h5>
                    </div>


                    @foreach($order->OrderDetails as $detail)
                        <div class="card shadow card-body rounded-lg border-0 mb-3">
                            <div class="row">
                                <div class="col-3">
                                    <div class="h-130p overflow-hidden">
                                        <img src="{{$detail->product ? $detail->product->image : ''}}"
                                             class="card-img-top"
                                             alt="{{$detail->product ? $detail->product->name : ''}}">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title mb-3">{{$detail->product->name}}</h5>
                                    {{--                            <form class="d-flex mb-2">--}}
                                    {{--                                <p class="mx-1">--}}
                                    {{--                                    Color :--}}
                                    {{--                                </p>--}}
                                    {{--                                <div class="mx-1">--}}
                                    {{--                                    <input class="sr-only" type="radio" name="color" id="color1" checked>--}}
                                    {{--                                    <label style="background: #E8A021"--}}
                                    {{--                                           class=" input-hover pointer input-o rounded-circle  w-25p h-25p" for="color1">--}}
                                    {{--                                    </label>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="mx-1">--}}
                                    {{--                                    <input class="sr-only" type="radio" name="color" id="color2">--}}
                                    {{--                                    <label style="background: #FFD91A"--}}
                                    {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color2">--}}
                                    {{--                                    </label>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="mx-1">--}}
                                    {{--                                    <input class="sr-only" type="radio" name="color" id="color3">--}}
                                    {{--                                    <label style="background: #303030"--}}
                                    {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color3">--}}
                                    {{--                                    </label>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="mx-1">--}}
                                    {{--                                    <input class="sr-only" type="radio" name="color" id="color4">--}}
                                    {{--                                    <label style="background: #00CBFF"--}}
                                    {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color4">--}}
                                    {{--                                    </label>--}}
                                    {{--                                </div>--}}
                                    {{--                            </form>--}}

                                    <div class="text-right">
                                        <div class="position-relative row align-items-center">
                                            <p class="h5 col text-danger">{{__("Price")}}{{$detail->price_string}}</p>
                                            <p class="h5 col text-danger">{{__("Qty")}}: {{$detail->qty}}</p>
                                            <p class="h5 col text-danger">{{__("Total")}} {{$detail->total}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>
    </div>

</main>
