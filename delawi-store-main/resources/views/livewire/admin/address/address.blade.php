<div style="display: contents">

    <!-- Content area -->
    <div class="content p-2">

        @include('livewire.admin.alert')

        <div class="card">
            <div class="breadcrumb-line header-elements-md-inline" style="padding-top: 10px">
                <div class="d-flex">
                    <div class="breadcrumb ml-2">
                        <a href="{{route('admin.home')}}" class="breadcrumb-item"><i
                                class="fa fa-home2 mr-2" style="font-size: 17px !important"></i> {{__("Home")}}</a>
                        <span class="breadcrumb-item active">{{ __('Address') }}</span>
                    </div>
                    <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                            class="fa fa-more"></i></a>
                </div>
                <div class="text-left">
                    <a type="button" class="btn btn-success mb-2 ml-2"
                       href="#" data-bs-toggle="modal" data-bs-target="#CreateAddress">
                        {{__('Create Address')}} <i
                            class="fa fa-plus3"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-md-12" wire:submit.prevent="search">
                        <div class="input-group mb-3 " style="justify-content: center">
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Name")}}" wire:model.defer="name">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Email")}}" wire:model.defer="email">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Mobile")}}" wire:model.defer="mobile">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Country")}}" wire:model.defer="country">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("City")}}" wire:model.defer="city">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Address")}}" wire:model.defer="address">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("zip_code")}}" wire:model.defer="zip_code">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control pl-2"
                                       style="border-radius: .1875rem !important; margin-left: 10px !important"
                                       placeholder="{{__("Note")}}" wire:model.defer="note">
                            </div>
                            <div class="d-block w-100 text-center mb-2">
                                <button class="btn  btn-primary"
                                        style="margin-right:10px !important ; padding: 7px 30px; border-radius: .1875rem !important"
                                        type="submit">{{__("Search")}}</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                        @if($addresses->count() > 0)
                            <div class="table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("Email")}}</th>
                                        <th>{{__("Mobile")}}</th>
                                        <th>{{__("Country")}}</th>
                                        <th>{{__("City")}}</th>
                                        <th>{{__("Address")}}</th>
                                        <th>{{__("zip_code")}}</th>
                                        <th>{{__("Note")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($addresses as $address)
                                        <tr>
                                            <td>{{$address->id}}</td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->name}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->email}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->mobile}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->country}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->city}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->location}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->zip_code}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.address.show',$address->id)}}">{{$address->note}}</a>
                                            </td>

                                            <td>
                                                <a class="btn btn-sm btn-info"
                                                   href="{{route('admin.address.show',$address->id)}}"
                                                   title="Edit"><i
                                                            class="fa fa-eye"></i> {{__("Show")}}

                                                    <a class="btn btn-sm btn-primary"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditAddress"
                                                       wire:click="EditAddress({{$address->id}})"
                                                       title="{{__("Edit")}}"><i
                                                                class="fa fa-edit"></i> {{__("Edit")}}</a>

                                                    <a class="btn btn-sm btn-danger" href="#"
                                                       data-id="{{$address->id}}" data-name="{{$address->name}}"
                                                       data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                       title="Edit"><i class="fa fa-trash-alt"></i> {{__("Delete")}}
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="pt-4">
                                {{$addresses->links()}}
                            </div>

                        @else
                            <div class="alert alert-danger">{{__("Empty list")}}</div>
                        @endif
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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

    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="CreateAddress" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Address') }}</h5>
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
                    @livewire('admin.addresses.address-create')
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->


    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="EditAddress" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Address') }}</h5>
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
                    @if($address_id)
                        @livewire('admin.addresses.address-edit',[$address_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->


</div>



@section('js_code')
    <script>
        $('#EditAddress').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
