<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Vouchers')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Vouchers')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('vouchers create'))
                        <a class="btn btn-primary float-end" data-bs-toggle="modal"
                           data-bs-target="#CreateVoucher" data-bs-original-title=""
                           title=""> {{__('Create Voucher')}}</a>
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
                            @if($vouchers->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("code")}}</th>
                                        <th>{{__("value")}}</th>
                                        <th>{{__("type")}}</th>
                                        <th>{{__("count")}}</th>
                                        <th>{{__("used")}}</th>
                                        <th>{{__("expiration")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vouchers as $voucher)
                                        <tr>
                                            <td>{{$voucher->id}}</td>
                                            <td>{{$voucher->code}}</td>
                                            <td>{{$voucher->value}}</td>
                                            <td>{{$voucher->type}}</td>
                                            <td>{{$voucher->count}}</td>
                                            <td>{{$voucher->used}}</td>
                                            <td>{{$voucher->expiration}}</td>
                                            <td>
                                                @if(auth()->user()->can('vouchers show'))
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('admin.vouchers.show',$voucher->id)}}"
                                                   title="{{__("Show")}}" data-toggle="tooltip" data-placement="top"><i
                                                        class="fa fa-eye"></i> </a>
                                                @endif
                                                    @if(auth()->user()->can('vouchers edit'))
                                                <a class="btn btn-xs btn-primary"
                                                   href="#" data-bs-toggle="modal" data-bs-target="#EditVoucher"
                                                   wire:click="EditVoucher({{$voucher->id}})"
                                                   title="{{__("Edit")}}"><i
                                                        class="fa fa-edit"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('vouchers delete'))
                                                <a class="btn btn-xs btn-danger" href="#"
                                                   wire:click.prevent="deleteId({{$voucher->id}})"
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
                                    {{$vouchers->links()}}
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



@if(auth()->user()->can('vouchers delete'))
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
@if(auth()->user()->can('vouchers create'))
    <!--  Modal CreateVoucher -->
    <div wire:ignore.self class="modal fade " id="CreateVoucher" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Vouchers') }}</h5>
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
                    @livewire('admin.vouchers.vouchers-create')
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateVoucher -->
@endif
@if(auth()->user()->can('vouchers edit'))
    <!--  Modal EditVoucher -->
    <div wire:ignore.self class="modal fade " id="EditVoucher" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Voucher') }}</h5>
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
                    @if($voucher_id)
                        @livewire('admin.vouchers.vouchers-edit',[$voucher_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal EditVoucher -->
    @endif

</div>



@section('js_code')
    <script>
        $('#EditVoucher').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
