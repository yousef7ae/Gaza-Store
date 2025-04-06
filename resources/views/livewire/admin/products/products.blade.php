<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Products')}}</h3>
                        @if($header)
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                                <li class="breadcrumb-item active">{{__('Products')}}</li>
                            </ol>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('products create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#CreateProduct"
                               data-bs-original-title="" title=""> {{__('Create Product')}}</a>
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
                                               placeholder="{{__("Name")}}" wire:model.defer="name">
                                    </div>

                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Description")}}" wire:model.defer="description">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Price")}}" wire:model.defer="price">
                                    </div>

                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Code")}}" wire:model.defer="code">
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
                            @if($products->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("Image")}}</th>
                                            <th>{{__("Name")}}</th>
                                            <th>{{__("User")}}</th>
                                            <th>{{__("Store")}}</th>
                                            <th>{{__("Category")}}</th>
                                            {{--                                        <th>{{__("Description")}}</th>--}}
                                            <th>{{__("Price")}}</th>
                                            <th>{{__("Code")}}</th>
                                            <th>{{__("Status")}}</th>
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as  $product)
                                            <tr>
                                                <td>{{ $product->id}}</td>
                                                <td>
                                                    <img width="50" class="rounded-circle img-thumbnail"
                                                        src="{{ $product->images && isset($product->images[0]) ? $product->images[0]->image : url('dashboard/images/image1.png') }}"
                                                        data-holder-rendered="true">
                                                </td>
                                                <td>{{ $product->name}}</td>
                                                <td>{{ $product->user ? $product->user->name : __("Empty") }}</td>
                                                <td>{{ $product->store ? $product->store->name : __("Empty") }}</td>
                                                <td>{{ $product->category ? $product->category->name : __("Empty") }}</td>

                                                {{--                                            <td>--}}
                                                {{--                                                <a href="{{route('admin.products.show', $product->id)}}">{{ $product->description}}</a>--}}
                                                {{--                                            </td>--}}
                                                <td>
                                                    <a href="{{route('admin.products.show', $product->id)}}">{{ $product->price_string}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.products.show', $product->id)}}">{{ $product->code}}</a>
                                                </td>
                                                <td>
                                                    @if($product->status == 1)
                                                        <span
                                                            class="btn btn-success btn-xs">{{ \App\Models\Product::statusList($product->status)}}</span>
                                                    @elseif( $product->status == 0)
                                                        <span
                                                            class="btn btn-danger btn-xs">{{ \App\Models\Product::statusList($product->status)}}</span>
                                                    @else
                                                        <span
                                                            class="btn btn-primary btn-xs">{!! \App\Models\Product::statusList($product->status) !!}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (auth()->user()->hasRole("Admin"))
                                                        <a class="btn btn-xs btn-success  {{$product->status == 1 ? 'disabled' : ''}}"
                                                           href="#"
                                                           wire:click.prevent="Status({{$product->id}})"
                                                           data-bs-toggle="modal" data-bs-target="#activeModal"
                                                           title="{{__("Active")}}"><i class="fa fa-check"></i>
                                                        </a>

                                                        <a class="btn btn-xs btn-danger {{$product->status == 0 ? 'disabled' : ''}}"
                                                           href="#"
                                                           wire:click.prevent="Status({{$product->id}})"
                                                           data-bs-toggle="modal" data-bs-target="#inactiveModal"
                                                           title="{{__("Inactive")}}"><i class="fa fa fa-ban"></i>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->can('products show'))
                                                        <a class="btn btn-xs btn-info"
                                                           href="{{route('admin.products.show',$product->id)}}"
                                                           title="{{__("Show")}}" data-toggle="tooltip"
                                                           data-placement="top"><i
                                                                class="fa fa-eye"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('products edit'))
                                                        <a class="btn btn-xs btn-primary"
                                                           href="#" data-bs-toggle="modal" data-bs-target="#EditProduct"
                                                           wire:click="EditProduct({{$product->id}})"
                                                           title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('products delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$product->id}})"
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
                                    {{$products->links()}}
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

@if(auth()->user()->can('products delete'))
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
        <!--  Modal deleteModal -->
@endif
@if(auth()->user()->can('products create'))
    <!--  Modal CreateProduct -->
        <div wire:ignore.self class="modal fade " id="CreateProduct" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Add New Products') }}</h5>
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
                        @livewire('admin.products.products-create')
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateProduct -->
@endif
@if(auth()->user()->can('products edit'))
    <!--  Modal EditProduct -->
        <div wire:ignore.self class="modal fade " id="EditProduct" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Products') }}</h5>
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
                        @if($product_id)
                            @livewire('admin.products.products-edit',[$product_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditProduct -->
@endif

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
</div>

@section('js_code')
    <script>
        $('#EditProduct').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
