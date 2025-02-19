<div style="display: contents">

    <div class="card">
        <div class="card-header">{{__("Details")}}
            @if(auth()->user()->can('products details create'))
                <a type="button" class="btn btn-success mb-2 mr-2 pull-right" href="#" data-bs-toggle="modal"
                   data-bs-target="#CreateProductDetail">{{__('Create ProductDetail')}} <i class="fa fa-plus3"></i></a>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if($product_details->count() > 0)
                        <div class="table-responsive-sm">
                            <table class="table color-bordered-table info-table  info-bordered-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__("Image")}}</th>
                                    <th>{{__("Unit")}}</th>
                                    <th>{{__("Value")}}</th>
                                    {{--                                    <th>{{__("Price")}}</th>--}}
                                    <th width="300">{{__("Action")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_details as $product_detail)
                                    <tr>
                                        <td>{{$product_detail->id}}</td>
                                        <td>
                                            <img width="80" class="img-fluid rounded"
                                                 src="{{ $product_detail->image ? $product_detail->image : url('assets/images/image.png')}}"
                                                 data-holder-rendered="true">

                                        </td>
                                        <td>{{$product_detail->unit}}</td>
                                        <td>{{$product_detail->value}}</td>
                                        {{--                                        <td>{{$product_detail->price_string}}</td>--}}
                                        <td>

                                            @if(auth()->user()->can('products details edit'))
                                                <a class="btn btn-sm btn-primary"
                                                   href="#" data-bs-toggle="modal"
                                                   data-bs-target="#EditModalProductDetail"
                                                   wire:click="EditModalProductDetail({{$product_detail->id}})"
                                                   title="{{__("Edit")}}"><i
                                                        class="fa fa-edit"></i> </a>
                                            @endif
                                            @if(auth()->user()->can('products details delete'))
                                                <a class="btn btn-sm btn-danger" href="#"
                                                   wire:click.prevent="deleteId({{$product_detail->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#deleteDetailModal"
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


    @if(auth()->user()->can('products details delete'))
        <!-- Modal deleteDetailModal -->
        <div wire:ignore.self class="modal fade" id="deleteDetailModal" tabindex="-1" role="dialog"
             aria-labelledby="deleteDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteDetailModalLabel">{{__("Delete Confirm")}}</h5>
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
                        <button type="button" wire:click.prevent="deleteDetail()" class="btn btn-danger close-modal"
                                data-dismiss="modal">{{__("Yes, Delete")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal deleteDetailModal -->
    @endif
    @if(auth()->user()->can('products details create'))
        <!--  Modal CreateModalImages -->
        <div wire:ignore.self class="modal fade " id="CreateProductDetail" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center"
                            id="exampleModalLongTitle">{{ __('Create ProductImages') }}</h5>
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
                        @livewire('admin.products.product-details-create',[['product_id' => $array['product_id'] ,'url' =>
                        request()->route()->getName()]])
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateProductDetail -->
    @endif
    @if(auth()->user()->can('products details edit'))
        <!--  Modal -->
        <div wire:ignore.self class="modal fade " id="EditModalProductDetail" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('ProductDetail') }}</h5>
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

                        @if($product_detail_id)
                            @livewire('admin.products.product-details-edit',[$product_detail_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal -->
    @endif

    @section('js_code')
        <script>
            $('#EditModalProductDetail').on('hide.bs.modal', function () {
                Livewire.emit('refreshModal')
            })
        </script>
    @endsection


</div>
