<main class="mt-4 pt-2 Privacy" style="margin-top: 150px !important;">
    <div class="container">
        <div class="row">
            <!-- sidebar -->
            @livewire('site.profile.sidebar')
            <div class="col-lg-8">
                <h4 class="text-danger mb-4">{{__("Orders")}}</h4>

                <div class="row no-gutters mt-3">

                    @foreach($orders as $order)
                        <div class="col-12 mx-auto mb-3 px-1 overflow-hidden">
                            <div class="card border-light shadow-sm h-100" data-aos="fade-left" data-aos-delay="200">
                                <div class="px-2 my-2">
                                    <div class="row">
                                        <h5 class="col-3 card-title">{{$order->order_number}}</h5>
                                        <h5 class="col-3 card-title">{{$order->store?$order->store->name : "N/A"}}</h5>
                                        <h5 class="col-3 card-title">{{$order->delivery?$order->delivery->name:"N/A"}}</h5>
                                        <h5 class="col-3 card-title">{{$order->created_at}}</h5>
                                        <h5 class="col-3 card-title">{{__("Items Count")}}
                                            : {{$order->OrderDetails->count()}}</h5>
                                        <h5 class="col-3 text-right text-danger font-weight-bold">
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
                                        <h5 class="col-3 text-right text-danger font-weight-bold">
                                            {{__("Total")}}: {{$order->total}}$</h5>
                                        <div class="pt-3 pb-1"><a href="{{route('profile.orders_details',$order->id)}}"
                                                                  class="btn btn-danger fs-13p px-md-2 px-1"><i
                                                    class="fas fa-cart-plus"></i> {{__("Show details")}}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{$orders->links()}}
                </div>


            </div>
        </div>
    </div>

</main>
