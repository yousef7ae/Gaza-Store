    <div style="display: contents">
        <!-- Page header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>{{__('Orders')}}</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                                <li class="breadcrumb-item active">{{__('Orders')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /page header -->

    <!-- Content area -->
        <div class="content">
            <div class="container-fluid">

                @include('livewire.admin.alert')

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <form class="col-md-12" wire:submit.prevent="search">
                                    <div class="input-group mb-3 " style="justify-content: center">
                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm"
                                                   style="border-radius: .1875rem !important; margin-left: 10px !important"
                                                   placeholder="{{__("order_number")}}" wire:model.defer="order_number">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm"
                                                   style="border-radius: .1875rem !important; margin-left: 10px !important"
                                                   placeholder="{{__("Discount")}}" wire:model.defer="discount">
                                        </div>

                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm"
                                                   style="border-radius: .1875rem !important; margin-left: 10px !important"
                                                   placeholder="{{__("Total")}}" wire:model.defer="total">
                                        </div>

                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm"
                                                   style="border-radius: .1875rem !important; margin-left: 10px !important"
                                                   placeholder="{{__("Coupon")}}" wire:model.defer="coupon">
                                        </div>

                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                   style="border-radius: .1875rem !important; margin-left: 10px !important"
                                                   placeholder="{{__("Note")}}" wire:model.defer="note">
                                        </div>

                                        <div class="d-block w-100 text-center">
                                            <button wire:loading.attr="disabled" class="btn btn-block mx-auto text-center btn-primary btn-sm"
                                                    type="submit"><i wire:loading
                                                                     class="fas fa-sync fa-spin"></i> {{__("Search")}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            @if(auth()->user()->hasRole('Customer') || auth()->user()->hasRole('Delivery') || auth()->user()->hasRole('Merchant'))
                            <div class="row p-3">
                                <div class="col-md-4">
                                <lable>{{__('Total Order')}} : {{$orderstotals}}</lable>
                                </div>
                                <div class="col-md-4">
                                <lable>{{__('percent')}} : {{$orderstotals * 0.1}} </lable>
                                </div>
                                <div class="col-md-4">
                                <lable>{{__('points')}} : {{$points}}</lable>
                                </div>
                            </div>


                            @endif
                            <div class="card-body p-0">
                                @if($orders->count() > 0)
                                    <div class="table-responsive-sm">
                                        <table class="table color-bordered-table info-table  info-bordered-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__("User")}}</th>
                                                <th>{{__("Order number")}}</th>
                                                <th>{{__("Discount")}}</th>
                                                <th>{{__("Total")}}</th>
                                                <th>{{__("Coupon")}}</th>
                                                <th>{{__("Note")}}</th>
                                                <th width="300">{{__("Action")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as  $key=>$order)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $order->user ? $order->user->name : ''}}</td>
                                                    <td>
                                                        <a href="{{route('admin.orders.show', $order->id)}}">{{ $order->order_number}}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('admin.orders.show', $order->id)}}">{{ $order->discount}}</a>
                                                    </td>
                                                    <td><a href="{{route('admin.orders.show', $order->id)}}">{{ $order->total}}</a>
                                                    </td>
                                                    <td><a href="{{route('admin.orders.show', $order->id)}}">{{ $order->discount}}</a>
                                                    </td>
                                                    <td><a href="{{route('admin.orders.show', $order->id)}}">{{ $order->note}}</a>
                                                    </td>
                                                    <td>

                                                        @if(auth()->user()->can('orders show'))
                                                            <a class="btn btn-xs btn-info"
                                                               href="{{route('admin.orders.show',$order->id)}}"
                                                               title="{{__("Show")}}" data-toggle="tooltip" data-placement="top"><i
                                                                        class="fa fa-eye"></i> </a>
                                                        @endif

                                                            <a class="btn btn-xs btn-success  {{$order->status == 1 ? 'disabled' : ''}}"
                                                               href="#"
                                                               wire:click.prevent="Status({{$order->id}})"
                                                               data-bs-toggle="modal" data-bs-target="#activeModal"
                                                               title="{{__("accept")}}"><i class="fa fa-check"></i>
                                                            </a>

                                                            <a class="btn btn-xs btn-danger {{$order->status == 0 ? 'disabled' : ''}}"
                                                               href="#"
                                                               wire:click.prevent="Status({{$order->id}})"
                                                               data-bs-toggle="modal" data-bs-target="#inactiveModal"
                                                               title="{{__("refuse")}}"><i class="fa fa fa-ban"></i>
                                                            </a>


                                                        @if(auth()->user()->can('orders delete'))
                                                            <a class="btn btn-xs btn-danger" href="#"
                                                               wire:click.prevent="deleteId({{$order->id}})"
                                                               data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                               title="{{__("Delete")}}"><i class="fa fa-trash-alt"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="pt-2">
                                        {{$orders->links()}}
                                    </div>

                                @else
                                    <div class="alert alert-danger m-4">{{__("Empty list")}}</div>
                            @endif
                            <!-- /.card-body -->
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

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
                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                                data-dismiss="modal">{{__("Yes, Delete")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal deleteModal -->


        @if (auth()->user()->hasRole("Admin"))
    <!-- Modal activeModal -->
        <div wire:ignore.self class="modal fade" id="activeModal" tabindex="-1" role="dialog"
             aria-labelledby="activeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activeModalLabel">{{__("Active Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to Active ?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="active()" class="btn btn-primary close-modal"
                                data-bs-dismiss="modal">{{__("Yes, Active")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal activeModal -->

        <!-- Modal inactiveModal -->
        <div wire:ignore.self class="modal fade" id="inactiveModal" tabindex="-1" role="dialog"
             aria-labelledby="inactiveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inactiveModal">{{__("InActive Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to InActive?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="inactive()" class="btn btn-danger close-modal"
                                data-bs-dismiss="modal">{{__("Yes, InActive")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal inactiveModal -->
    @endif
</div>


</div>


