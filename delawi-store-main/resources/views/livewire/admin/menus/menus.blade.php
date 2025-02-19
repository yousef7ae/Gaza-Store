<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Menus')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Menus')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('menus create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                               data-bs-target="#CreateMenu" data-bs-original-title=""
                               title=""> {{__('Create Menu')}}</a>
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
                                <div class="input-group mb-3">
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Title")}}" wire:model.defer="name">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($menus->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("Image")}}</th>
                                            <th>{{__("Title")}}</th>
                                            <th>{{__("Order")}}</th>
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($menus as  $key => $menu)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>
                                                    <img width="50" class="img-fluid rounded"
                                                         src="{{ $menu->image ? $menu->image : url('dashboard/images/image1.png')}}"
                                                         data-holder-rendered="true">
                                                </td>
                                                <td>{{$menu->title_lang}}</td>
                                                <td>{{$menu->order}}</td>
                                                <td>
                                                    @if(auth()->user()->can('menus edit'))
                                                        <a class="btn btn-primary btn-xs"
                                                           href="#" data-bs-toggle="modal" data-bs-target="#EditMenu"
                                                           wire:click="EditMenu({{$menu->id}})"
                                                           title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('menus delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$menu->id}})"
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
                                <div class="pt-2">
                                    {{$menus->links()}}
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
    @if(auth()->user()->can('menus delete'))
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
    @if(auth()->user()->can('menus create'))
        <!--  Modal CreateMenu -->
        <div wire:ignore.self class="modal fade " id="CreateMenu" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Menu') }}</h5>
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
                        @livewire('admin.menus.menus-create')
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateMenu -->
    @endif
    @if(auth()->user()->can('menus edit'))
        <!--  Modal EditMenu -->
        <div wire:ignore.self class="modal fade " id="EditMenu" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Menu') }}</h5>
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
                        @if($menu_id)
                            @livewire('admin.menus.menus-edit',[$menu_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditMenu -->
    @endif


</div>


