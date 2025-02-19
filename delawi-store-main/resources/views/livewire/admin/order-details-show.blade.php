<div style="display: contents">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="fa fa-arrow-right6 mr-2"></i> <span class="font-weight-semibold">{{__("Home")}}</span> -
                    {{__("Dashboard")}}</h4>
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

    <div class="card">
        <div class="card-header">{{ __("OrdersDetails") }}</div>
        <div class="card-body">
            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("product_name")}}: </label>
                        <b>{{$item->product_name}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Qty")}}: </label>
                        <b>{{$item->qty}}</b>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Price")}}: </label>
                        <b>{{$item->price_string}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Discount")}}: </label>
                        <b>{{$item->discount}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Total")}}: </label>
                        <b>{{$item->total}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("created_at")}}: </label>
                        <b>{{$item->created_at->diffForHumans()}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("updated_at")}}: </label>
                        <b>{{$item->updated_at->diffForHumans()}}</b>
                    </div>
                </div>


            </div>
            <a href="{{route('admin.order-details')}}" class="btn btn-info float-right" type="submit"><i
                    class="fa fa-edit"></i> {{__("Back")}}</a>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
