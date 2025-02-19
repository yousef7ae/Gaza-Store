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
        <div class="card-header">{{ __("Coupons") }}</div>
        <div class="card-body">
            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("code")}}: </label>
                        <b>{{$item->code}}</b>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("value")}}: </label>
                        <b>{{$item->value}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("type")}}: </label>
                        <b>{{$item->type}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("count")}}: </label>
                        <b>{{$item->count}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("used")}}: </label>
                        <b>{{$item->used}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("expiration")}}: </label>
                        <b>{{$item->expiration}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("product_id")}}: </label>
                        <b>{{$item->product_id}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("user_id")}}: </label>
                        <b>{{$item->user_id}}</b>
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

        </div>
    </div>
</div>
