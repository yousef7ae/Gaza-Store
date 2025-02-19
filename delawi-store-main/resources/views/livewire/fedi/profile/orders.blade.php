
<main>
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__("Orders")}}</li>
            </ol>
        </nav>
    </div>
    <img class="img-fluid w-100" src="{{asset('fedi/img/img-11.jpg')}}" style="max-height: 460px" alt="">
    <div class="container Privacy">
        <div class="row">
            <aside class="col-lg-4 mb-4">
                <div class="card border-0 bg-light rounded-3">
                    <div class="text-center py-3">
                        @livewire('site.profile.avatar')
                    </div>
                    @livewire('site.profile.sidebar')
                </div>
            </aside>
            <div class="col-lg-8 mb-4">
                <div class="card card-body border-0 bg-light rounded-3">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th class="text-p text-center" scope="col">{{__('Order number')}} </th>
                            <th class="text-p text-center" scope="col">{{__('Amount')}}</th>
                            <th class="text-p text-center" scope="col">{{__('Date')}}</th>
                            <th class="text-p text-center" scope="col">{{__('Show')}} </th>
                            <th class="text-p text-center" scope="col">{{__("Status")}} </th>
                        </tr>
                        </thead>
                        <tbody class="border-top">
                        @foreach($orders as $order)
                        <tr>
                            <th class="align-middle text-center py-3">{{$order->order_number}}</th>
                            <td class="align-middle text-center py-3">{{$order->total}} sra</td>
                            <td class="align-middle text-center py-3">{{$order->created_at}}</td>
                            <td class="align-middle text-center py-3"><a href="{{route('profile.orders_details',$order->id)}}" class="btn btn-outline-primary w-100 rounded-pill"> {{__("Show details")}}</a></td>
                            <td class="align-middle text-center py-3">
                                @if($order->status == 1)
                                    <button class="btn btn-secondary rounded-pill w-100">{{__("Delivery")}}</button>
                                @elseif($order->status == 2)
                                    <button class="btn btn-success rounded-pill w-100">{{__("Done")}}</button>
                                @elseif($order->status == 3)
                                    <button class="btn btn-danger rounded-pill w-100">{{__("Deleted")}}</button>
                                @elseif($order->status == 5)
                                    <button class="btn btn-danger rounded-pill w-100">{{__("Cancel")}}</button>
                                @else
                                    <button class="btn btn-primary rounded-pill w-100" wire:click.prevent="deleteId({{$order->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal">{{__("Pending")}}</button>
                                    <!-- Modal deleteModal -->
                                    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                         aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true close-btn"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{__("Are you sure want to delete?")}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">{{__("Close")}}</button>
                                                    <button wire:click.prevent="delete()" class="btn btn-danger close-modal"
                                                            data-dismiss="modal">{{__("Yes, Delete")}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal deleteModal -->
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        {{$orders->links()}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="py-md-5 mt-md-5"></div>
</main>


