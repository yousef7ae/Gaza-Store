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
                    <span class="breadcrumb-item active">{{__("Carts")}}</span>
                </div>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="card">
        <div class="card-header">{{ __("ProductDetail") }}</div>
        <div class="card-body">
            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Name")}}: </label>
                        <b>{{$item->name}}</b>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Value")}}: </label>
                        <b>{{$item->value}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Unit")}}: </label>
                        <b>{{$item->unit}}</b>
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
            <a href="{{route('admin.product-details.edit',$item->id)}}" class="btn btn-info float-right"
               type="submit"><i class="fa fa-edit"></i> {{__("Edit")}}</a>

        </div>
    </div>
</div>

