<div style="display: contents">

    <!-- Content area -->
    <div class="content p-2">


        <div class="card">
            <div class="card-header">{{__("Details")}}
                @if(auth()->user()->can('products images create'))
                <a type="button" class="btn btn-success mb-2 mr-2 pull-right" href="#" data-bs-toggle="modal" data-bs-target="#CreateModalImages">{{__('Create ProductImages')}} <i class="fa fa-plus3"></i></a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if($product_images->count() > 0)
                            <div class="table-responsive-sm">
                            <table class="table color-bordered-table info-table  info-bordered-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__("Image")}}</th>
                                    <th>{{__("Name")}}</th>
{{--                                    <th>{{__("Path")}}</th>--}}
                                    <th>{{__("Size")}}</th>
                                    <th>{{__("Ext")}}</th>
                                    <th width="300">{{__("Action")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_images as  $product_image)
                                    <tr>
                                        <td>{{ $product_image->id}}</td>
                                        <td>

                                            <img width="80" class="img-fluid rounded"
                                                 src="{{ $product_image->image ? $product_image->image : url('assets/images/image.png')}}"
                                                 data-holder-rendered="true">

                                        </td>
                                        <td>{{ $product_image->name}}</td>
{{--                                        <td>{{ $product_image->path}}</td>--}}
                                        <td>{{ $product_image->size}}</td>
                                        <td>{{ $product_image->ext}}</td>
                                        <td>
                                            @if(auth()->user()->can('products images edit'))
                                            <a class="btn btn-sm btn-primary"
                                               href="#" data-bs-toggle="modal" data-bs-target="#EditModalImages"
                                               wire:click="EditModal({{$product_image->id}})"
                                               title="{{__("Edit")}}"><i
                                                    class="fa fa-edit"></i> </a>
                                            @endif

                                                @if(auth()->user()->can('products images delete'))
                                            <a class="btn btn-sm btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$product_image->id}})"
                                               data-bs-toggle="modal" data-bs-target="#deleteImageModal"
                                               title="{{__("Delete")}}"><i class="fa fa-trash-alt"></i>
                                            </a>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

@if(auth()->user()->can('products images delete'))
    <!-- Modal deleteImageModal -->
    <div wire:ignore.self class="modal fade" id="deleteImageModal" tabindex="-1" role="dialog"
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
    <!-- Modal deleteImageModal -->
@endif
@if(auth()->user()->can('products images create'))
    <!--  Modal CreateModalImages -->
    <div wire:ignore.self class="modal fade " id="CreateModalImages" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create ProductImages') }}</h5>
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
                    @livewire('admin.products.product-images-create',[['product_id' => $array['product_id'] ,'url' =>
                    request()->route()->getName()]])
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateModalImages -->
@endif
@if(auth()->user()->can('products images edit'))
    <!--  Modal EditModalImages -->
    <div wire:ignore.self class="modal fade " id="EditModalImages" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('ProductImages') }}</h5>
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
                    @if($product_image_id)
                        @livewire('admin.products.product-images-edit',[$product_image_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Update  Modal EditModalImages -->
    @endif

</div>

@section('js_code')
    <script>
        $('#EditModal').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
