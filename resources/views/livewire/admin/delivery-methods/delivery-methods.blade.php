<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Delivery Methods')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Delivery Methods')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('delivery methods create'))
                        <a class="btn btn-primary float-end" data-bs-toggle="modal"
                           data-bs-target="#CreateDeliveryMethod" data-bs-original-title=""
                           title=""> {{__('Create Delivery Methods')}}</a>
                        @endif
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
                                               placeholder="{{__("Delivery Methods")}}" wire:model.defer="name">
                                    </div>
                                    <div class="d-block w-100 text-center ">
                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm"
                                                type="submit"><i wire:loading
                                                                 class="fas fa-sync fa-spin"></i> {{__("Search")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($payment_gateways->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Image")}}</th>
                                        <th>{{__("Name Delivery Methods")}}</th>
                                        <th>{{__("Description")}}</th>
                                        <th>{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payment_gateways as $key => $payment_gateway)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                <img width="50" class="img-fluid rounded"
                                                     src="{{ $payment_gateway->image ? $payment_gateway->image : url('dashboard/images/image1.png')}}"
                                                     data-holder-rendered="true">
                                            </td>
                                            <td>{{$payment_gateway->name}}</td>
                                            <td>{{$payment_gateway->description}}</td>
                                            <td>
                                                @if(auth()->user()->can('delivery methods show'))
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('admin.deliveryـmethods.show',$payment_gateway->id)}}"
                                                   title="{{__("Show")}}" data-toggle="tooltip" data-placement="top"><i
                                                        class="fa fa-eye"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('delivery methods edit'))
                                                <a class="btn btn-xs btn-primary"
                                                   href="#" data-bs-toggle="modal" data-bs-target="#EditDeliveryMethod"
                                                   wire:click="EditDeliveryMethod({{$payment_gateway->id}})"
                                                   title="{{__("Edit")}}"><i
                                                        class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('delivery methods delete'))
                                                <a class="btn btn-xs btn-danger" href="#"
                                                   wire:click.prevent="deleteId({{$payment_gateway->id}})"
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
                                    {{$payment_gateways->links()}}
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
@if(auth()->user()->can('delivery methods delete'))
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
@endif
@if(auth()->user()->can('delivery methods create'))
    <!--  Modal CreateDeliveryMethod -->
    <div wire:ignore.self class="modal fade " id="CreateDeliveryMethod" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Add Delivery Methods') }}</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{__("Loading please wait")}} ...
                        </div>
                    </div>
                    @livewire('admin.delivery-methods.delivery-methods-create')
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateDeliveryMethod -->
@endif
@if(auth()->user()->can('delivery methods edit'))
    <!--  Modal EditDeliveryMethod-->
    <div wire:ignore.self class="modal fade " id="EditDeliveryMethod" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Payment Gateway') }}</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{__("Loading please wait")}} ...
                        </div>
                    </div>
                    @if($delivery_method_id)
                        @livewire('admin.delivery-methods.delivery-methods-edit',[$delivery_method_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal EditDeliveryMethod-->
    @endif

</div>


@section('js_code')
    <script>
        $('#EditDeliveryMethod').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
