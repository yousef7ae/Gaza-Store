<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Faqs')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Faqs')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('faqs create'))
                        <a class="btn btn-primary float-end"  data-bs-toggle="modal"
                           data-bs-target="#CreateFaq" data-bs-original-title="" title=""> {{__('Create Faq')}}</a>
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
                                               placeholder="{{__("Title")}}" wire:model.defer="title">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Description")}}" wire:model.defer="description">
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
                            @if($pages->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Image")}}</th>
                                        <th>{{__("Title")}}</th>
                                        <th>{{__("Url")}}</th>
                                        <th>{{__("Order")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as  $key => $page)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                <img width="50" class="img-fluid rounded"
                                                     src="{{ $page->image ? $page->image : url('dashboard/images/image1.png')}}"
                                                     data-holder-rendered="true">
                                            </td>
                                            <td>{{ $page->title_lang }}</td>
                                            <td>
                                                {{route('site.page',$page->id)}}
                                                <br>
                                                {{route('site.page',$page->slug)}}
                                            </td>
                                            <td>{{$page->order}}</td>
                                            <td>
                                                @if(auth()->user()->can('faqs edit'))
                                                <a class="btn btn-primary btn-xs"
                                                   href="#" data-bs-toggle="modal" data-bs-target="#EditFaq"
                                                   wire:click="EditFaq({{$page->id}})"
                                                   title="{{__("Edit")}}"><i
                                                        class="fa fa-edit"></i> </a>
                                                @endif
                                                    @if(auth()->user()->can('faqs delete'))
                                                <a class="btn btn-xs btn-danger" href="#"
                                                   wire:click.prevent="deleteId({{$page->id}})"
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
                                    {{$pages->links()}}
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

@if(auth()->user()->can('faqs delete'))
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
@if(auth()->user()->can('faqs create'))
    <!--  Modal CreateFaq -->
    <div wire:ignore.self class="modal fade " id="CreateFaq" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Faq') }}</h5>
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
                    @livewire('admin.faqs.faqs-create')
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateFaq -->
@endif
@if(auth()->user()->can('faqs edit'))
    <!--  Modal EditFaq -->
    <div wire:ignore.self class="modal fade " id="EditFaq" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Faqs') }}</h5>
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
                    @if($faq_id)
                        @livewire('admin.faqs.faqs-edit',[$faq_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal EditFaq -->
    @endif

</div>


