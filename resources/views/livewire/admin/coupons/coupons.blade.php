<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Coupons')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Coupons')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('coupons create'))
                        <a class="btn btn-primary float-end" data-bs-toggle="modal"
                           data-bs-target="#CreateCoupon" data-bs-original-title=""
                           title=""> {{__('Create Coupon')}}</a>
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
                                               placeholder="{{__("code")}}" wire:model.defer="code">
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
                            @if($coupons->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("code")}}</th>
                                        <th>{{__("value")}}</th>
                                        {{-- <th>{{__("count")}}</th>
                                        <th>{{__("used")}}</th> --}}
                                        <th>{{__("expiration")}}</th>
                                        {{-- <th>{{__("product_id")}}</th> --}}
                                        {{-- <th>{{__("user_id")}}</th> --}}
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{$coupon->id}}</td>
                                            <td>{{$coupon->code}}</td>
                                            <td>{{$coupon->value}}</td>
                                            {{-- <td>{{$coupon->count}}</td>
                                            <td>{{$coupon->used}}</td> --}}
                                            <td>{{$coupon->expiration}}</td>
                                            {{-- <td>{{$coupon->product_id}}</td>
                                            <td>{{$coupon->user_id}}</td> --}}
                                            <td>
                                                @if(auth()->user()->can('coupons show'))
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('admin.coupons.show',$coupon->id)}}"
                                                   title="{{__("Show")}}" data-toggle="tooltip" data-placement="top"><i
                                                        class="fa fa-eye"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('coupons edit'))
                                                <a class="btn btn-xs btn-success  {{$coupon->status == 1 ? 'disabled' : ''}}"
                                                   href="#"
                                                   wire:click.prevent="Status({{$coupon->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#acceptableModal"
                                                   title="{{__("Acceptable")}}"><i class="fa fa-check"></i>
                                                </a>

                                                <a class="btn btn-xs btn-danger {{$coupon->status == 2 ? 'disabled' : ''}}"
                                                   href="#"
                                                   wire:click.prevent="Status({{$coupon->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#disabledModal"
                                                   title="{{__("Disabled")}}"><i class="fa fa fa-ban"></i>
                                                </a>

                                                <a class="btn btn-xs btn-primary"
                                                   href="#" data-bs-toggle="modal" data-bs-target="#EditCoupon"
                                                   wire:click="EditCoupon({{$coupon->id}})"
                                                   title="{{__("Edit")}}"><i
                                                        class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('coupons delete'))
                                                <a class="btn btn-xs btn-danger" href="#"
                                                   wire:click.prevent="deleteId({{$coupon->id}})"
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
                                    {{$coupons->links()}}
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
@if(auth()->user()->can('coupons delete'))
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
@if(auth()->user()->can('coupons create'))
    <!--  Modal CreateCoupon -->
    <div wire:ignore.self class="modal fade " id="CreateCoupon" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Coupons') }}</h5>
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
                    @livewire('admin.coupons.coupons-create',['store_id' => $store_id])
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateCoupon -->
@endif
@if(auth()->user()->can('coupons edit'))
    <!--  Modal EditCoupon -->
    <div wire:ignore.self class="modal fade " id="EditCoupon" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Coupon') }}</h5>
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
                    @if($coupon_id)
                        @livewire('admin.coupons.coupons-edit',[$coupon_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal EditCoupon -->

        <!-- Modal acceptableModal -->
        <div wire:ignore.self class="modal fade" id="acceptableModal" tabindex="-1" role="dialog"
             aria-labelledby="acceptableModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptableModalLabel">{{__("Acceptable Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to Acceptable ?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="acceptable()" class="btn btn-success close-modal"
                                data-bs-dismiss="modal">{{__("Yes, Acceptable")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal acceptableModal -->

        <!-- Modal disabledModal -->
        <div wire:ignore.self class="modal fade" id="disabledModal" tabindex="-1" role="dialog"
             aria-labelledby="disabledModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disabledModalLabel">{{__("Disabled Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to Disabled ?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="disabled()" class="btn btn-danger close-modal"
                                data-bs-dismiss="modal">{{__("Yes, Disabled")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal disabledModal -->

    @endif


</div>



@section('js_code')
    <script>
        $('#EditCoupon').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
