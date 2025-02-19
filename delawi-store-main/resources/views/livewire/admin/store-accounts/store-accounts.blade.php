<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Stores Accounts')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Stores Accounts')}}</li>
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
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Title")}}" wire:model.defer="title">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Description")}}" wire:model.defer="description">
                                    </div>

                                    <div class="mb-3" style="width: 170px; ">
                                        <select wire:model.defer="status"
                                                class="form-control form-control-sm ">
                                            <option value="0">{{__("Select Status")}} ...</option>
                                            {{--                                            @foreach(\App\Models\Ad::statusList(false) as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}">{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>

                                    <div class="d-block w-100 text-center mb-2">
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
                            @if($store_accounts->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("Store")}}</th>
                                            <th>{{__("Order Number")}}</th>
                                            <th>{{__("Arrest Receipt")}}</th>
                                            <th>{{__("Amount")}}</th>
                                            <th>{{__("Date")}}</th>
                                            {{--                                            <th>{{__("Status")}}</th>--}}
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($store_accounts as  $key => $item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->store->name}}</td>
                                                <td>{{$item->order ? $item->order->order_number : ''}}</td>
                                                <td>{{$item->arrest_receipt ? $item->arrest_receipt->id : ''}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->date}}</td>

                                                {{--                                                <td>--}}
                                                {{--                                                    @if($ad->status == 1)--}}
                                                {{--                                                        <span--}}
                                                {{--                                                            class="btn btn-success btn-xs">{{ \App\Models\Ad::statusList($ad->status) }}</span>--}}
                                                {{--                                                    @elseif($ad->status == 2)--}}
                                                {{--                                                        <span--}}
                                                {{--                                                            class="btn btn-danger btn-xs">{{ \App\Models\Ad::statusList($ad->status) }}</span>--}}
                                                {{--                                                    @elseif( $ad->status == 0)--}}
                                                {{--                                                        <span--}}
                                                {{--                                                            class="btn btn-info btn-xs">{!! \App\Models\Ad::statusList($ad->status) !!}</span>--}}
                                                {{--                                                    @else--}}
                                                {{--                                                        <span--}}
                                                {{--                                                            class="btn btn-primary btn-xs">{!! \App\Models\Ad::statusList($ad->status) !!}</span>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                </td>--}}
                                                <td>
{{--                                                    @if(auth()->user()->can('ads edit'))--}}
{{--                                                        --}}{{--                                                        <a class="btn btn-xs btn-success {{$ad->status == 1 ? 'disabled' : ''}}"--}}
{{--                                                        --}}{{--                                                           href="#"--}}
{{--                                                        --}}{{--                                                           wire:click.prevent="Status({{$ad->id}})"--}}
{{--                                                        --}}{{--                                                           data-bs-toggle="modal" data-bs-target="#acceptableModal"--}}
{{--                                                        --}}{{--                                                           title="{{__("Acceptable")}}"><i class="fa fa-check"></i>--}}
{{--                                                        --}}{{--                                                        </a>--}}

{{--                                                        --}}{{--                                                        <a class="btn btn-xs btn-danger {{$ad->status == 2 ? 'disabled' : ''}}"--}}
{{--                                                        --}}{{--                                                           href="#"--}}
{{--                                                        --}}{{--                                                           wire:click.prevent="Status({{$ad->id}})"--}}
{{--                                                        --}}{{--                                                           data-bs-toggle="modal" data-bs-target="#disabledModal"--}}
{{--                                                        --}}{{--                                                           title="{{__("Disabled")}}"><i class="fa fa fa-ban"></i>--}}
{{--                                                        --}}{{--                                                        </a>--}}

{{--                                                        <a class="btn btn-primary btn-xs"--}}
{{--                                                           href="#" data-bs-toggle="modal" data-bs-target="#EditAd"--}}
{{--                                                           wire:click="EditArrestReceipt({{$item->id}})"--}}
{{--                                                           title="{{__("Edit")}}"><i--}}
{{--                                                                class="fa fa-edit"></i> </a>--}}
{{--                                                    @endif--}}
                                                    @if(auth()->user()->can('ads delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$item->id}})"
                                                           data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                           title="{{__("Delete")}}"><i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{--                                <div class="pt-2">--}}
                                {{--                                    {{$arrest_receipts->links()}}--}}
                                {{--                                </div>--}}

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

{{--    @if(auth()->user()->can('ads delete'))--}}
{{--        <!-- Modal deleteModal -->--}}
{{--        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="deleteModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true close-btn">×</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <p>{{__("Are you sure want to delete?")}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary close-btn"--}}
{{--                                data-bs-dismiss="modal">{{__("Close")}}</button>--}}
{{--                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"--}}
{{--                                data-bs-dismiss="modal">{{__("Yes, Delete")}}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Modal deleteModal -->--}}
{{--    @endif--}}
{{--    @if(auth()->user()->can('ads create'))--}}
{{--        <!--  Modal CreateAd -->--}}
{{--        <div wire:ignore.self class="modal fade " id="CreateArrestReceipt" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content text-center">--}}
{{--                    <div class="modal-header text-center">--}}
{{--                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Arrest Receipt') }}</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div>--}}
{{--                            <div wire:loading>--}}
{{--                                <i class="fas fa-sync fa-spin"></i>--}}
{{--                                {{__("Loading please wait")}} ...--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        @if($create_id)--}}
{{--                            @livewire('admin.arrest-receiptes.create-arrest-receipt')--}}
{{--                        @endif--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!--  Modal CreateAd -->--}}
{{--    @endif--}}
{{--    @if(auth()->user()->can('ads edit'))--}}
{{--        <!--  Modal EditAd -->--}}
{{--        <div wire:ignore.self class="modal fade " id="EditAd" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content text-center">--}}
{{--                    <div class="modal-header text-center">--}}
{{--                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Arrest Receipt') }}</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div>--}}
{{--                            <div wire:loading>--}}
{{--                                <i class="fas fa-sync fa-spin"></i>--}}
{{--                                {{__("Loading please wait")}} ...--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @if($edit_id)--}}
{{--                            @livewire('admin.arrest-receiptes.edit-arrest-receipt', ['id' => $edit_id])--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}


</div>
