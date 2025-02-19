<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Delivery Fees')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Delivery Fees')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('delivery fees create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                               data-bs-target="#CreateDeliveryFee" data-bs-original-title=""
                               title=""> {{__('Create Delivery Fee')}}</a>
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($delivery_fees->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("From")}}</th>
                                            <th>{{__("To")}}</th>
                                            <th>{{__("value")}}</th>
                                            <th>{{__("Store")}}</th>
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($delivery_fees as $delivery_fee)
                                            <tr>
                                                <td>{{$delivery_fee->id}}</td>
                                                <td>{{$delivery_fee->from}}</td>
                                                <td>{{$delivery_fee->to}}</td>
                                                <td>{{$delivery_fee->value}}</td>
                                                <td>{{$delivery_fee->store?$delivery_fee->store->name:'غير محدد'}}</td>
                                                <td>


                                                    @if(auth()->user()->can('delivery fees edit'))
                                                        <a class="btn btn-xs btn-primary"
                                                           href="#" data-bs-toggle="modal"
                                                           data-bs-target="#EditDeliveryFee"
                                                           wire:click="EditDeliveryFee({{$delivery_fee->id}})"
                                                           title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('delivery fees delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$delivery_fee->id}})"
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
                                    {{$delivery_fees->links()}}
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


    @if(auth()->user()->can('delivery fees delete'))
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
    @if(auth()->user()->can('delivery fees create'))
        <!--  Modal CreateDeliveryFee -->
        <div wire:ignore.self class="modal fade " id="CreateDeliveryFee" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center"
                            id="exampleModalLongTitle">{{ __('Create Delivery Fees') }}</h5>
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
                        @livewire('admin.delivery-fees.delivery-fees-create',['store_id' => $store_id])
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateDeliveryFee -->
    @endif
    @if(auth()->user()->can('delivery fees edit'))
        <!--  Modal EditDeliveryFee -->
        <div wire:ignore.self class="modal fade " id="EditDeliveryFee" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center"
                            id="exampleModalLongTitle">{{ __('Edit Delivery Fee') }}</h5>
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
                        @if($delivery_fee_id)
                            @livewire('admin.delivery-fees.delivery-fees-edit',[$delivery_fee_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditDeliveryFee -->
    @endif

</div>



@section('js_code')
    <script>
        $('#EditDeliveryFee').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
