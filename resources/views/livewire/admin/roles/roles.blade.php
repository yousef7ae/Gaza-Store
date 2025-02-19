    <div style="display: contents">
        <!-- Page header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>{{__('Roles')}}</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active">{{__('Roles')}}</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            @if(auth()->user()->can('roles create'))
                                <a class="btn btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#CreateModal"  data-bs-original-title="" title=""> {{__('Create Role')}}</a>
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

                                    <div class="d-block w-100 text-center ">
                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm"
                                                type="submit"><i  wire:loading class="fas fa-sync fa-spin"></i> {{__("Search")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($roles->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("users")}}</th>
                                        <th>{{__("Roles")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as  $key => $role)
                                        <tr>
                                            <td>{{ $key + $roles->firstItem() }}</td>
                                            <td>{{$role->name}}</td>
                                            <td><a class="text-success text-bold" href="{{route('admin.users',['role_id' => $role->id])}}">{{$role->users()->count()}}</a></td>
                                            <td><span class="badge badge-success">{!!  $role->name == "Admin" ? 'All permissions' : $role->permissions()->pluck('name')->implode('</span> <span class="badge badge-success"> ') !!}</span></td>
                                            <td>
                                                @if(auth()->user()->can('roles edit'))
                                                    <a class="btn btn-primary btn-xs"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditModal"
                                                       wire:click="EditModal({{$role->id}})"
                                                       title="{{__("Edit")}}"><i
                                                            class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('roles delete'))
                                                    <a class="btn btn-xs btn-danger" href="#"
                                                       wire:click.prevent="deleteId({{$role->id}})"
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
                                    {{$roles->links()}}
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
@if(auth()->user()->can('roles delete'))
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
@if(auth()->user()->can('roles create'))
    <!--  Modal CreateModal -->
        <div wire:ignore.self class="modal fade " id="CreateModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Role') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @livewire('admin.roles.roles-create')
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateModal -->
@endif
@if(auth()->user()->can('roles edit'))
    <!--  Modal -->
        <div wire:ignore.self class="modal fade " id="EditModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Role') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($role_id)
                            @livewire('admin.roles.roles-edit',[$role_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal -->
    @endif
</div>

@section('js_code')
    <script>
        $('#EditModal').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
