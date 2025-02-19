<div style="display: contents">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="fa fa-arrow-right6 mr-2"></i> <span class="font-weight-semibold">{{ __('Home') }}</span>
                    -
                    {{ __('Dashboard') }}</h4>
                <a href="{{ route('admin.home') }}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb ml-2">
                    <a href="{{ route('admin.home') }}" class="breadcrumb-item"><i class="fa fa-home2 mr-2"></i>
                        {{ __('Home') }}</a>
                    <span class="breadcrumb-item active">{{ __('Orders') }}</span>
                </div>
                <a href="{{ route('admin.home') }}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="card">
        <div class="card-header">{{ __('Orders') }}</div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("QR Code")}}: </label>
                        <b><img src="{{$order->qr_code}}"></b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('order_number') }}: </label>
                        <b>{{ $order->order_number }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Discount') }}: </label>
                        <b>{{ $order->discount }}</b>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Total') }}: </label>
                        <b>{{ $order->total }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Coupon') }}: </label>
                        <b>{{ $order->coupon }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Note') }}: </label>
                        <b>{{ $order->note }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('created_at') }}: </label>
                        <b>{{ $order->created_at->diffForHumans() }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('updated_at') }}: </label>
                        <b>{{ $order->updated_at->diffForHumans() }}</b>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('User') }}: </label>
                        <b>{{ $order->user->name ?? '' }}</b>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Country') }}: </label>
                        <b>{{ $order->address->country ?? '' }}</b>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Location') }}: </label>
                        <b>{{ $order->address->location ?? '' }}</b>
                    </div>

                    <div class="form-group">
                        <label class="control-label">{{ __('Distrect') }}: </label>
                        <b>{{ $order->district->name ?? '' }}</b>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Status') }}:</label>
                        <h5 class="col-3 text-right text-danger font-weight-bold">
                            <span class="badge bg-secondary text-white">{{ \App\Models\Order::statusList($order->status) }}</span>
{{--                            @if ($order->status == 0)--}}
{{--                                <span class="badge bg-primary text-white">{{ __('Pending') }}</span>--}}
{{--                            @elseif($order->status == 1)--}}
{{--                                <span class="badge bg-success text-white">{{ __('Store Accepted') }}</span>--}}
{{--                            @elseif($order->status == 2)--}}
{{--                                <span class="badge bg-danger text-white">{{ __('Delivery accepted') }}</span>--}}
{{--                            @elseif($order->status == 3)--}}
{{--                                <span class="badge bg-danger text-white">{{ __('In delivery') }}</span>--}}
{{--                            @elseif($order->status == 4)--}}
{{--                                <span class="badge bg-danger text-white">{{ __('Completed') }}</span>--}}
{{--                            @else--}}
{{--                                <span class="badge bg-primary text-white">{{ __('Canceled') }}</span>--}}
{{--                            @endif--}}
                        </h5>
                    </div>

                </div>

                <div class="col-md-6">
                    @if($order->address)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                    <label class="control-label">{{ __('Delivery') }}: </label>
                                    <b>{{ $order->delivery->name ?? '' }}</b>
                                </div>
                            <div class="col-md-6">
                                    @livewire('admin.orders.change-delivery', ['order_id' => $order->id])
                                </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">{{ __('Delivery status') }}: </label>
                                <b>{{ $order->delivery->name ?? '' }}</b>
                            </div>
                            <div class="col-md-6">
                                @livewire('admin.orders.delivery-status', ['order_id' => $order->id])
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="form-group">
                            <label class="control-label">{{ __('Receipt From Store') }}: </label>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label">{{ __('Email') }}: </label>
                        <b>{{ $order->delivery->email ?? '' }}</b>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>{{ __('Address') }}</h3>
                    <div class="form-group">
                        <div class="row">
                            @if (auth()->user()->hasRole('Admin'))
                                <div class="col-md-6">
                                    <label class="control-label">{{ __('Adreess name') }}: </label>
                                    <b>{{ $order->address->name ?? '' }}</b>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">{{ __('Adreess email') }}: </label>
                                    <b>{{ $order->address->email ?? '' }}</b>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">{{ __('Adreess mobile') }}: </label>
                                    <b>{{ $order->address->mobile ?? '' }}</b>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="control-label">{{ __('Adreess country') }}: </label>
                                <b>{{ $order->address->country ?? '' }}</b>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">{{ __('Adreess') }}: </label>
                                <b>{{ $order->address->location ?? '' }}</b>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">{{ __('Adreess zip code') }}: </label>
                                <b>{{ $order->address->zip_code ?? '' }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <a href="{{ route('admin.orders') }}" class="btn btn-info float-right" type="submit"><i
                    class="fa fa-edit"></i> {{ __('Back') }}
            </a>

            <div class="col-md-12">
                <br>
            </div>
            @foreach ($order->OrderDetails as $detail)
                <div class="card shadow card-body rounded-lg border-0 mb-3">
                    <div class="row">
                        <div class="col-3">
                            <div class="h-130p overflow-hidden">
                                <img src="{{ $detail->product ? $detail->product->image : '' }}" class="card-img-top"
                                    alt="{{ $detail->product ? $detail->product->name : '' }}">
                            </div>
                        </div>
                        <div class="col-9">
                            <h5 class="card-title mb-3">{{ $detail->product->name ?? '' }}</h5>
                            {{--                            <form class="d-flex mb-2"> --}}
                            {{--                                <p class="mx-1"> --}}
                            {{--                                    Color : --}}
                            {{--                                </p> --}}
                            {{--                                <div class="mx-1"> --}}
                            {{--                                    <input class="sr-only" type="radio" name="color" id="color1" checked> --}}
                            {{--                                    <label style="background: #E8A021" --}}
                            {{--                                           class=" input-hover pointer input-o rounded-circle  w-25p h-25p" for="color1"> --}}
                            {{--                                    </label> --}}
                            {{--                                </div> --}}
                            {{--                                <div class="mx-1"> --}}
                            {{--                                    <input class="sr-only" type="radio" name="color" id="color2"> --}}
                            {{--                                    <label style="background: #FFD91A" --}}
                            {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color2"> --}}
                            {{--                                    </label> --}}
                            {{--                                </div> --}}
                            {{--                                <div class="mx-1"> --}}
                            {{--                                    <input class="sr-only" type="radio" name="color" id="color3"> --}}
                            {{--                                    <label style="background: #303030" --}}
                            {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color3"> --}}
                            {{--                                    </label> --}}
                            {{--                                </div> --}}
                            {{--                                <div class="mx-1"> --}}
                            {{--                                    <input class="sr-only" type="radio" name="color" id="color4"> --}}
                            {{--                                    <label style="background: #00CBFF" --}}
                            {{--                                            class="pointer input-o rounded-circle  w-25p h-25p" for="color4"> --}}
                            {{--                                    </label> --}}
                            {{--                                </div> --}}
                            {{--                            </form> --}}

                            <div class="text-right">
                                <div class="position-relative row align-items-center">
                                    <p class="h5 col text-danger">
                                        {{ __('Price') }}{{ $detail->product->price_string }}</p>
                                    <p class="h5 col text-danger">{{ __('Qty') }}: {{ $detail->qty }}</p>
                                    <p class="h5 col text-danger">{{ __('Total') }}
                                        {{ $detail->product->price * $detail->qty }}</p>
                                </div>
                                <div class="position-relative row align-items-center">
                                    @if ($detail->product->constant)
                                        <p class="h5 col text-danger">{{ __('Color') }}
                                            :{{ $detail->product->constant['color'] ?? '' }}</p>
                                        <p class="h5 col text-danger">{{ __('Size') }}
                                            :{{ $detail->product->constant['size'] ?? '' }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
