<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- <h3>{{__('Categories')}}</h3> --}}
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li> --}}
                            <li class="breadcrumb-item active">{{ __('Categories') }}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if (auth()->user()->can('categories create'))
                        <a class="btn btn-primary float-end" wire:click.prevent="CreateCategory" data-bs-toggle="modal" data-bs-target="#CreateCategory" data-bs-original-title="" title=""> {{ __('Create Category') }}</a>
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
                                        <input type="text" class="form-control form-control-sm" style="border-radius: .1875rem !important; margin-left: 10px !important" placeholder="{{ __('Name') }}" wire:model.defer="name">
                                    </div>
                                    <div style="width: 170px; ">
                                        <select wire:model.defer="status" class="form-control form-control-sm ">
                                            <option value="0">{{ __('Select Status') }} ...</option>
                                            @foreach (\App\Models\Category::statusList(false) as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group-append ">
                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm" type="submit"><i wire:loading class="fas fa-sync fa-spin"></i>
                                            {{ __('Search') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if ($categories->count() > 0)
                            <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            {{-- <th>{{__("Store")}}</th> --}}
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <img width="50" class="rounded-circle img-thumbnail" src="{{ $category->image ? asset($category->image) : asset('dashboard/images/image1.png') }}" data-holder-rendered="true">

                                            </td>
                                            <td>{{ $category->name ? $category->name : $category->where('id', $category->category_id)->value('name') }}
                                            </td>
                                            {{-- <td>{{$category->store?$category->store->name:__("Empty") }}</td> --}}
                                            <td>
                                                @if ($category->status == 1)
                                                <span class="btn btn-success btn-xs">{{ \App\Models\Category::statusList($category->status) }}</span>
                                                @elseif($category->status == 0)
                                                <span class="btn btn-danger btn-xs">{{ \App\Models\Category::statusList($category->status) }}</span>
                                                @else
                                                <span class="btn btn-primary btn-xs">{!! \App\Models\Category::statusList($category->status) !!}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (auth()->user()->can('categories show'))
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.categories.show', $category->id) }}" title="{{ __('Show') }}" data-toggle="tooltip" data-placement="top">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endif
                                                @if (auth()->user()->can('categories edit') or
                                                $category->user_id == auth()->id())
                                                @if (auth()->user()->hasRole('Admin'))
                                                <a class="btn btn-xs btn-success  {{ $category->status == 1 ? 'disabled' : '' }}" href="#" wire:click.prevent="Status({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#activeModal" title="{{ __('Active') }}"><i class="fa fa-check"></i>
                                                </a>

                                                <a class="btn btn-xs btn-danger {{ $category->status == 0 ? 'disabled' : '' }}" href="#" wire:click.prevent="Status({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#inactiveModal" title="{{ __('Inactive') }}">
                                                    <i class="fa fa fa-ban"></i>
                                                </a>
                                                @endif
                                                {{-- @if (auth()->user()->hasRole('Admin')) --}}
                                                <a class="btn btn-xs btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#EditCategory" wire:click="EditCategory({{ $category->id }})" title="{{ __('Edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{-- @endif --}}
                                                @endif
                                                @if (auth()->user()->can('categories delete'))
                                                <a class="btn btn-xs btn-danger" href="#" wire:click.prevent="deleteId({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteModalCategory" title="{{ __('Delete') }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pt-2">
                                {{ $categories->links() }}
                            </div>
                            @else
                            <div class="alert alert-danger m-4">{{ __('Empty list') }}</div>
                            @endif
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->can('categories delete') or
    $category->user_id == auth()->id())
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalCategory" tabindex="-1" role="dialog" aria-labelledby="deleteModalCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalCategoryLabel">{{ __('Delete Confirm') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure want to delete?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">{{ __('Yes, Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (auth()->user()->can('categories create'))
    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="CreateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Add New Category') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{ __('Loading please wait') }} ...
                        </div>
                    </div>

                    @if ($create_category)
                    @livewire('admin.categories.categories-create', ['store_id' => $store_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->
    @endif

    @if (auth()->user()->can('categories edit') or
    $category->user_id == auth()->id())
    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="EditCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{ __('Loading please wait') }} ...
                        </div>
                    </div>
                    @if ($category_id)
                    @livewire('admin.categories.categories-edit', [$category_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->

    @if (auth()->user()->hasRole('Admin'))
    <!-- Modal activeModal -->
    <div wire:ignore.self class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="activeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activeModalLabel">{{ __('Active Confirm') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure want to Active ?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" wire:click.prevent="active()" class="btn btn-primary close-modal" data-bs-dismiss="modal">{{ __('Yes, Active') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal activeModal -->

    <!-- Modal inactiveModal -->
    <div wire:ignore.self class="modal fade" id="inactiveModal" tabindex="-1" role="dialog" aria-labelledby="inactiveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inactiveModalLabel">{{ __('InActive Confirm') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure want to InActive?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" wire:click.prevent="inactive()" class="btn btn-danger close-modal" data-bs-dismiss="modal">{{ __('Yes, InActive') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal inactiveModal -->
    @endif
    @endif
</div>

@section('js_code')
<script>
    $('#EditCategory').on('hide.bs.modal', function() {
        Livewire.emit('refreshModal')
    })

</script>
@endsection
