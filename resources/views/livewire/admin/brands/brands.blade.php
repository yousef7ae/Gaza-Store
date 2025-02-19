<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Brands')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Brands')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('brands create'))
                            <a class="btn btn-primary float-end" wire:click.prevent="CreateBrand" data-bs-toggle="modal"
                               data-bs-target="#CreateBrand" data-bs-original-title=""
                               title=""> {{__('Create Brand')}}</a>
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
                                    <div>
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Title")}}" wire:model.defer="name">
                                    </div>
                                    <div>
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Description")}}" wire:model.defer="description">
                                    </div>

                                    <div style="width: 170px; ">
                                        <select wire:model.defer="status"
                                                class="form-control form-control-sm ">
                                            <option value="0">{{__("Select Status")}} ...</option>
                                            @foreach(\App\Models\Brand::statusList(false) as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="input-group-append ">
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
                            @if($brands->count() > 0)
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Image")}}</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("Description")}}</th>
                                        <th>{{__("Status")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as  $key => $brand)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                <img width="50" class="img-fluid rounded"
                                                     src="{{ $brand->image ? $brand->image : url('dashboard/images/image1.png')}}"
                                                     data-holder-rendered="true">
                                            </td>
                                            <td>{{empty($brand->name) ? $brand->where('id',$brand->brand_id)->pluck('name')->first() : $brand->name}}</td>
                                            <td>{{ Str::limit($brand->description,50) }}</td>
                                            <td>
                                                @if($brand->status == 1  )
                                                    <span
                                                        class="btn btn-success btn-xs">{{ \App\Models\Brand::statusList($brand->status)}}</span>

                                                @elseif( $brand->status == 0)
                                                    <span
                                                        class="btn btn-danger btn-xs">{{ \App\Models\Brand::statusList($brand->status)}}</span>
                                                @else
                                                    <span
                                                        class="btn btn-primary btn-xs">{!! \App\Models\Brand::statusList($brand->status) !!}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(auth()->user()->can('brands edit'))
                                                    @if (auth()->user()->hasRole("Admin"))
                                                    <a class="btn btn-xs btn-success  {{$brand->status == 1 ? 'disabled' : ''}}"
                                                       href="#"
                                                       wire:click.prevent="Status({{$brand->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#activeModal"
                                                       title="{{__("Active")}}"><i class="fa fa-check"></i>
                                                    </a>

                                                    <a class="btn btn-xs btn-danger {{$brand->status == 0 ? 'disabled' : ''}}"
                                                       href="#"
                                                       wire:click.prevent="Status({{$brand->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#inactiveModal"
                                                       title="{{__("Inactive")}}"><i class="fa fa fa-ban"></i>
                                                    </a>
                                                    @endif

                                                    <a class="btn btn-primary btn-xs"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditBrand"
                                                       wire:click="EditBrand({{$brand->id}})"
                                                       title="{{__("Edit")}}"><i
                                                            class="fa fa-edit"></i> </a>

                                                @endif
                                                @if(auth()->user()->can('brands delete'))
                                                    <a class="btn btn-xs btn-danger" href="#"
                                                       wire:click.prevent="deleteId({{$brand->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                       title="{{__("Delete")}}"><i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pt-2">
                                    {{$brands->links()}}
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
@if(auth()->user()->can('brands delete'))
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
@if(auth()->user()->can('brands create'))
    <!--  Modal CreateBrand -->
        <div wire:ignore.self class="modal fade " id="CreateBrand" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Brand') }}</h5>
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

                        @if($create_brand)
                            @livewire('admin.brands.brands-create',['store_id' => $store_id])

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateBrand -->
@endif
@if(auth()->user()->can('brands edit'))
    <!--  Modal EditBrand -->
        <div wire:ignore.self class="modal fade " id="EditBrand" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Brand') }}</h5>
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
                        @if($brand_id)
                            @livewire('admin.brands.brands-edit',[$brand_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditBrand -->
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
                        <h5 class="modal-title" id="inactiveModalLabel">{{__("InActive Confirm")}}</h5>
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
    @endif

</div>


