
<main>
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__("Order Detail")}} </li>
            </ol>
        </nav>
    </div>
    <div class="container requests">
        <h5 class="mb-4">{{__('Order number')}} : {{$order->order_number}} </h5>

        <div class="card card-body border-0 bg-light pb-0 rounded-3">
            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th class="text-p text-center" style="width: 300px" scope="col">المنتج</th>
                    <th class="text-p text-center" scope="col">الكمية</th>
                    <th class="text-p text-center" scope="col">لون المنتج</th>
                    <th class="text-p text-center" scope="col">حجم المنتج</th>
                    <th class="text-p text-center" scope="col">الإجمالي</th>
                </tr>
                </thead>
                <tbody class="border-top">
                @foreach($order->OrderDetails as $detail)
                <tr>
                    <td class="align-middle mw-350p ">
                        <div class="row g-0 align-items-center mw-350p">
                            <div class="col-md-5">
                                <div class="overflow-hidden m-2">
                                    <img src="{{$detail->product ? $detail->product->image : asset('fedi/img/img-ss.png') }}" class="img-fluid" alt="{{$detail->product ? $detail->product->name : ''}}">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="pb-4 position-relative">
                                    <h5 class="card-title mb-2">{{$detail->product ? $detail->product->name : ""}}</h5>
                                    <p class="card-text text-p mb-1">{{$detail->product ? $detail->product->description : ""}} </p>
                                    <div class="position-relative stars w-80p">
                                        <span class="star1"></span>
                                        <span class="star2" style="width: {{($detail->product ? $detail->product->rate : 0/5)*100}}%"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        <div class="">
                            <input class="border-0 w-80p rounded-pill text-center" disabled value="{{$detail->qty}}" >
                        </div>
                    </td>
                    <td class="align-middle text-center">{{$detail->constant ? $detail->constant['color'] : 'N'}}</td>
                    <td class="align-middle text-center">{{$detail->constant ? $detail->constant['size'] : 'N'}}</td>
                    <td class="align-middle text-center">{{$detail->price}} {{$detail->product->store ? $detail->product->store->currency->code : ""}}</td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="py-md-5 mt-md-5"></div>
</main>




{{----}}

{{--<main class="mt-4 pt-2 Privacy" style="margin-top: 150px !important;">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <!-- sidebar -->--}}
{{--            @livewire('site.profile.sidebar')--}}

{{--            <div class="col-lg-8">--}}
{{--                <h4 class="text-danger mb-4">{{__("Order Detail")}}</h4>--}}

{{--                <div class="row no-gutters mt-3">--}}

{{--                    <div class="row">--}}
{{--                        <h5 class="col-3 card-title">{{$order->order_number}}</h5>--}}
{{--                        <h5 class="col-3 card-title">{{$order->store?$order->store->name : "N/A"}}</h5>--}}
{{--                        <h5 class="col-3 card-title">{{$order->delivery?$order->delivery->name:"N/A"}}</h5>--}}
{{--                        <h5 class="col-3 card-title">{{$order->created_at}}</h5>--}}
{{--                        <h5 class="col-3 card-title">{{__("Items Count")}}: {{$order->OrderDetails->count()}}</h5>--}}
{{--                        <h5 class="col-3 text-right font-weight-bold">--}}
{{--                            {{__("Status")}}: @if($order->status == 1)--}}
{{--                                <span class="badge bg-secondary text-white">{{__("Delivery")}}</span>--}}
{{--                            @elseif($order->status == 2)--}}
{{--                                <span class="badge bg-success text-white">{{__("Done")}}</span>--}}
{{--                            @elseif($order->status == 3)--}}
{{--                                <span class="badge bg-danger text-white">{{__("Deleted")}}</span>--}}
{{--                            @else--}}
{{--                                <span class="badge bg-primary text-white">{{__("Pending")}}</span>--}}
{{--                            @endif--}}

{{--                        </h5>--}}
{{--                        <h5 class="col-6 text-right text-danger font-weight-bold">Total: {{$order->total}}$</h5>--}}
{{--                    </div>--}}


{{--                    @foreach($order->OrderDetails as $detail)--}}
{{--                        <div class="card shadow card-body rounded-lg border-0 mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-3">--}}
{{--                                    <div class="h-130p overflow-hidden">--}}
{{--                                        <img src="{{$detail->product ? $detail->product->image : ''}}"--}}
{{--                                             class="card-img-top"--}}
{{--                                             alt="{{$detail->product ? $detail->product->name : ''}}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-9">--}}
{{--                                    <h5 class="card-title mb-3">{{$detail->product->name}}</h5>--}}

{{--                                    <div class="text-right">--}}
{{--                                        <div class="position-relative row align-items-center">--}}
{{--                                            <p class="h5 col text-danger">{{__("Price")}}{{$detail->price}}$</p>--}}
{{--                                            <p class="h5 col text-danger">{{__("Qty")}}: {{$detail->qty}}</p>--}}
{{--                                            <p class="h5 col text-danger">{{__("Total")}} {{$detail->total}}$</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</main>--}}
