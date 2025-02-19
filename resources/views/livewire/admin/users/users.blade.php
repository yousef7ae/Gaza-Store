<div style="display: contents">
    <!-- Page header -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Users')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Users')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('users create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#CreateUser"
                               wire:click.prevent="CreateUser" data-bs-original-title=""
                               title=""> {{__('Create User')}}</a>
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
                                               placeholder="{{__("Email")}}" wire:model.defer="email">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Mobile")}}" wire:model.defer="mobile">
                                    </div>
                                    <div class="mb-2" style="width: 170px; ">
                                        <select class="form-control form-control-sm " wire:model.defer="role_id">
                                            <option>{{__('Select Role')}}...</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
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
                            @if($users->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("Image")}}</th>
                                            <th>{{__("Full Name")}}</th>
                                            <th>{{__("Mobile")}}</th>
                                            <th>{{__("Email")}}</th>
                                            <th>{{__("Status")}}</th>
                                            <th>{{__("Orders")}}</th>
                                            <th>{{__("Role")}}</th>
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $key => $user)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>
                                                    <img width="50" class="rounded-circle img-thumbnail"
                                                         src="{{ $user->image ? $user->image : url('dashboard/images/1.png')}}"
                                                         data-holder-rendered="true">
                                                </td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    @if($user->status == 1)
                                                        <span
                                                            class="btn btn-success btn-xs">{{ \App\Models\User::statusList($user->status)}}</span>
                                                    @elseif( $user->status == 2)
                                                        <span
                                                            class="btn btn-danger btn-xs">{{ \App\Models\User::statusList($user->status)}}</span>
                                                    @elseif( $user->status == 0)
                                                        <span
                                                            class="btn btn-info btn-xs">{!! \App\Models\User::statusList($user->status) !!}</span>
                                                    @else
                                                        <span
                                                            class="btn btn-primary btn-xs">{!! \App\Models\User::statusList($user->status) !!}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$user->orders->count() }}
                                                </td>
                                                <td>
                                                    {{$user->roles->pluck('name')->implode(',') }}
                                                </td>
                                                <td>
                                                    @if(auth()->user()->can('users show'))
                                                        <a class="btn btn-xs btn-light"
                                                           href="{{route('admin.users.show',$user->id)}}"
                                                           title="{{__("Show")}}"><i
                                                                class="fa fa-eye"></i> </a>
                                                    @endif

                                                    @if($user->hasRole('Merchant'))
                                                        <a class="btn btn-xs btn-light"
                                                           href="{{route('admin.stores',['user_id' => $user->id ])}}"
                                                           title="{{__("Stores")}}"><i
                                                                class="fa fa-list"></i> </a>
                                                    @endif

                                                    @if(auth()->user()->can('users edit'))
                                                        <a class="btn btn-primary btn-xs"
                                                           href="#" data-bs-toggle="modal" data-bs-target="#EditUser"
                                                           wire:click="EditUser({{$user->id}})"
                                                           title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> </a>
                                                    @endif

                                                    @if(auth()->user()->can('users delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$user->id}})"
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
                                    {{$users->links()}}
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

    @if(auth()->user()->can('users delete'))
        <!-- Modal deleteModal -->
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to delete?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                                data-bs-dismiss="modal">{{__("Yes, Delete")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal deleteModal -->
    @endif
    @if(auth()->user()->can('users create'))
        <!--  Modal CreateUser -->
        <div wire:ignore.self class="modal fade " id="CreateUser" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create User') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($create_user)
                            @livewire('admin.users.users-create', [$user_id, $store_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateUser -->
    @endif
    @if(auth()->user()->can('users edit'))
        <!--  Modal -->
        <div wire:ignore.self class="modal fade " id="EditUser" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('User') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($user_id)
                            @livewire('admin.users.users-edit',[$user_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal -->
    @endif


</div>

