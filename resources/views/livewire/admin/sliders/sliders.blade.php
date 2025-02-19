<div style="display: contents">
    <!-- Page header -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Sliders')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Sliders')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('sliders create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                               wire:click.prevent="CreateSlider" data-bs-target="#CreateSlider"
                               data-bs-original-title="" title=""> {{__('Create Slider')}}</a>
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
                                               placeholder="{{__("Url")}}" wire:model.defer="url">
                                    </div>

                                    <div class="mb-2" style="width: 170px; ">
                                        <select wire:model.defer="status"
                                                class="form-control form-control-sm ">
                                            <option value="0">{{__("Select Status")}} ...</option>
                                            @foreach(\App\Models\Slider::statusList(false) as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
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
                            @if($sliders->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table color-bordered-table info-table  info-bordered-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__("Image")}}</th>
                                            <th>{{__("Store")}}</th>
                                            <th>{{__("Name")}}</th>
                                            <th>{{__("Product")}}</th>
                                            <th>{{__("Status")}}</th>
                                            <th width="300">{{__("Action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sliders as  $key => $slider)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>
                                                    <img width="50" class="img-fluid rounded"
                                                         src="{{ $slider->image ? $slider->image : url('dashboard/images/image1.png')}}"
                                                         data-holder-rendered="true">
                                                </td>
                                                <td>{{$slider->store ? $slider->store->name : ''}}</td>
                                                <td>{{$slider->name}}</td>
                                                <td>
                                                    @if (!empty($slider->product_id))
                                                        <a href="{{ route('admin.products.show',$slider->product_id) }}"
                                                           target="_blank"> {{ $slider->product ? Str::limit($slider->product->name,50) : '' }}
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($slider->status == 1  )
                                                        <span
                                                            class="btn btn-success btn-xs">{{ \App\Models\Slider::statusList($slider->status)}}</span>

                                                    @elseif( $slider->status == 0)
                                                        <span
                                                            class="btn btn-danger btn-xs">{{ \App\Models\Slider::statusList($slider->status)}}</span>
                                                    @else
                                                        <span
                                                            class="btn btn-primary btn-xs">{!! \App\Models\Slider::statusList($slider->status) !!}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(auth()->user()->can('sliders edit'))
                                                        <a class="btn btn-xs btn-success  {{$slider->status == 1 ? 'disabled' : ''}}"
                                                           href="#"
                                                           wire:click.prevent="Status({{$slider->id}})"
                                                           data-bs-toggle="modal" data-bs-target="#activeSliderModal"
                                                           title="{{__("Active")}}"><i class="fa fa-check"></i>
                                                        </a>

                                                        <a class="btn btn-xs btn-danger {{$slider->status == 0 ? 'disabled' : ''}}"
                                                           href="#"
                                                           wire:click.prevent="Status({{$slider->id}})"
                                                           data-bs-toggle="modal" data-bs-target="#inactiveSliderModal"
                                                           title="{{__("Inactive")}}"><i class="fa fa fa-ban"></i>
                                                        </a>

                                                        <a class="btn btn-primary btn-xs"
                                                           href="#" data-bs-toggle="modal" data-bs-target="#EditSlider"
                                                           wire:click="EditSlider({{$slider->id}})"
                                                           title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> </a>
                                                    @endif
                                                    @if(auth()->user()->can('sliders delete'))
                                                        <a class="btn btn-xs btn-danger" href="#"
                                                           wire:click.prevent="deleteId({{$slider->id}})"
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
                                    {{$sliders->links()}}
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

@if(auth()->user()->can('sliders delete'))
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

@if(auth()->user()->can('sliders create'))
    <!--  Modal CreateSlider -->
        <div wire:ignore.self class="modal fade " id="CreateSlider" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{__('Create Sliders')}}</h5>
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
                        @if($create_slider)
                            @livewire('admin.sliders.sliders-create',['store_id' => $store_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateSlider -->
@endif
@if(auth()->user()->can('sliders edit'))
    <!--  Modal EditSlider -->
        <div wire:ignore.self class="modal fade " id="EditSlider" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Sliders') }}</h5>
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
                        @if($slider_id)
                            @livewire('admin.sliders.sliders-edit',[$slider_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditSlider -->

        <!-- Modal activeSliderModal -->
        <div wire:ignore.self class="modal fade" id="activeSliderModal" tabindex="-1" role="dialog"
             aria-labelledby="activeSliderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activeSliderModalLabel">{{__("Active Confirm")}}</h5>
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
        <!-- Modal activeSliderModal -->

        <!-- Modal inactiveSliderModal -->
        <div wire:ignore.self class="modal fade" id="inactiveSliderModal" tabindex="-1" role="dialog"
             aria-labelledby="inactiveSliderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inactiveSliderModalLabel">{{__("InActive Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to InActive ?")}}</p>
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
        <!-- Modal inactiveSliderModal -->
    @endif
</div>

