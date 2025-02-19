<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Countries')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Countries')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('countries create'))
                            <a class="btn btn-primary float-end" wire:click.prevent="CreateCountry" data-bs-toggle="modal"
                               data-bs-target="#CreateCountry" data-bs-original-title="" title=""> {{__('Create Country')}}</a>
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
                                               placeholder="{{__("iso2")}}" wire:model.defer="iso2">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("iso3")}}" wire:model.defer="iso3">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Phone Code")}}" wire:model.defer="phone_code">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("region")}}" wire:model.defer="region">
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("sub region")}}" wire:model.defer="sub_region">
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
                            @if($countries->count() > 0)
                                <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("iso2")}}</th>
                                        <th>{{__("iso3")}}</th>
                                        <th>{{__("phone_code")}}</th>
                                        <th>{{__("region")}}</th>
                                        <th>{{__("sub region")}}</th>
                                        <th>{{__("Count City")}}</th>
                                        <th>{{__("status")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($countries as  $key => $country)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$country->name}}</td>
                                            <td>{{$country->iso2}}</td>
                                            <td>{{$country->iso3}}</td>
                                            <td>{{$country->phone_code}}</td>
                                            <td>{{$country->region}}</td>
                                            <td>{{$country->sub_region}}</td>
                                            <td>{{$country->cities->count()}}</td>
                                            <td>
                                                @if($country->status == 1  )
                                                    <span
                                                        class="btn btn-success btn-xs">{{ \App\Models\Slider::statusList($country->status)}}</span>

                                                @elseif( $country->status == 0)
                                                    <span
                                                        class="btn btn-danger btn-xs">{{ \App\Models\Slider::statusList($country->status)}}</span>
                                                @else
                                                    <span
                                                        class="btn btn-primary btn-xs">{!! \App\Models\Slider::statusList($country->status) !!}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(auth()->user()->can('countries edit'))

                                                    <a class="btn btn-xs btn-success  {{$country->status == 1 ? 'disabled' : ''}}"
                                                       href="#"
                                                       wire:click.prevent="Status({{$country->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#activeModal"
                                                       title="{{__("Active")}}"><i class="fa fa-check"></i>
                                                    </a>

                                                    <a class="btn btn-xs btn-danger {{$country->status == 0 ? 'disabled' : ''}}"
                                                       href="#"
                                                       wire:click.prevent="Status({{$country->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#inactiveModal"
                                                       title="{{__("Inactive")}}"><i class="fa fa fa-ban"></i>
                                                    </a>


                                                    <a class="btn btn-primary btn-xs"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditCountry"
                                                       wire:click="EditCountry({{$country->id}})"
                                                       title="{{__("Edit")}}"><i
                                                            class="fa fa-edit"></i> </a>

                                                @endif
                                                @if(auth()->user()->can('countries delete'))
                                                    <a class="btn btn-xs btn-danger" href="#"
                                                       wire:click.prevent="deleteId({{$country->id}})"
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
                                    {{$countries->links()}}
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
@if(auth()->user()->can('countries delete'))
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
@if(auth()->user()->can('countries create'))
    <!--  Modal CreateCountry -->
        <div wire:ignore.self class="modal fade " id="CreateCountry" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Country') }}</h5>
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

                        @if($create_country)
                            @livewire('admin.countries-lists.countries-lists-create')

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateCountry -->
@endif
@if(auth()->user()->can('countries edit'))
    <!--  Modal EditCountry -->
        <div wire:ignore.self class="modal fade " id="EditCountry" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Country') }}</h5>
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
                        @if($country_id)
                            @livewire('admin.countries-lists.countries-lists-edit',[$country_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditCountry -->

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
        <!-- Modal inactiveModal -->

    @endif

</div>


