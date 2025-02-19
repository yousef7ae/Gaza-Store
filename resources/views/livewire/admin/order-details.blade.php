<div style="display: contents">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="fa fa-arrow-right6 mr-2"></i> <span class="font-weight-semibold">{{__("Home")}}</span> -
                    {{__("OrdersDetails")}}</h4>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>


        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb ml-2">
                    <a href="{{route('admin.home')}}" class="breadcrumb-item"><i
                            class="fa fa-home2 mr-2"></i> {{__("Home")}}</a>
                    <span class="breadcrumb-item active">{{__("OrdersDetails")}}</span>
                </div>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content p-2">

        @include('livewire.admin.alert')

        {{--<a type="button" class="btn btn-success mb-2 ml-2" href="{{route('admin.order-details.create')}}">--}}
        {{--{{__('Add New OrdersDetails')}} <i--}}
        {{--class="fa fa-plus3"></i>--}}
        {{--</a>--}}

        <div class="card">
            <div class="card-header">{{ __('OrdersDetails') }}</div>
            <div class="card-body">
                <div class="row">

                    <div class="table-responsive">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control mb-sm-2 mb-0" placeholder="{{__("order_number")}}"
                                   wire:model.lazy="product_name">
                            <input type="text" class="form-control mb-sm-2 mb-0" placeholder="{{__("Qty")}}" wire:model.lazy="qty">
                            <input type="text" class="form-control mb-sm-2 mb-0" placeholder="{{__("Price")}}"
                                   wire:model.lazy="price">
                            <input type="text" class="form-control mb-sm-2 mb-0" placeholder="{{__("Discount")}}"
                                   wire:model.lazy="discount">
                            <input type="text" class="form-control mb-sm-2 mb-0" placeholder="{{__("Total")}}"
                                   wire:model.lazy="total">

                            <div class="d-block w-100 text-center">
                                <button class="btn btn-outline-secondary"
                                        type="button">{{__("Search")}}</button>
                            </div>
                        </div>

                        @if($order_details->count() > 0)
                            <div class=" table-responsive-sm">
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("order_number")}}</th>
                                        <th>{{__("Qty")}}</th>
                                        <th>{{__("Price")}}</th>
                                        <th>{{__("Discount")}}</th>
                                        <th>{{__("Total")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_details as  $order_detail )
                                        <tr>
                                            <td>{{ $order_detail->id}}</td>
                                            <td>
                                                <a href="{{route('admin.order-details.show', $order_detail->id)}}">{{ $order_detail->product_name ? $order_detail->order->order_number : ''}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.order-details.show', $order_detail->id)}}">{{ $order_detail->qty}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.order-details.show', $order_detail->id)}}">{{ $order_detail->price_string}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.order-details.show', $order_detail->id)}}">{{ $order_detail->discount}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.order-details.show', $order_detail->id)}}">{{ $order_detail->total}}</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info"
                                                   href="{{route('admin.order-details.show', $order_detail->id)}}"
                                                   title="Edit"><i
                                                            class="fa fa-eye"></i> {{__("Show")}}</a>
                                                <a class="btn btn-sm btn-danger" href="#"
                                                   data-id="{{ $order_detail->id}}" data-name="{{ $order_detail->name}}"
                                                   data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                   title="Edit"><i class="fa fa-trash-alt"></i> {{__("Delete")}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger">{{__("Empty list")}}</div>

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
            </div>
            <div class="modal-body">
                {{__("Are you sure delete User")}}:<span class="name"></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger action"
                        wire:click.prevent="delete(id)">{{__("Delete")}}</button>
            </div>
        </div>
    </div>
</div>


@section('js_code')

    <script>
        $(document).ready(function () {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var name = button.data('name') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)

                modal.find('.modal-title').text('{{__("Delete User")}} ' + id)
                modal.find('.modal-body .name').text(name)
                modal.find('.modal-footer .action').attr('wire:click.prevent', 'delete(' + id + ')');
            })

            $('.action').on('click', function () {
                $('#deleteModal').modal("hide");
            });
        });
    </script>

@endsection


