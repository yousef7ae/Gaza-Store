<div style="display: contents">


    <!-- Page header -->
    <!-- /page header -->

    <div class="card">
        <div class="breadcrumb-line header-elements-md-inline" style="padding-top: 10px">
            <div class="d-flex">
                <div class="breadcrumb ml-2">
                    <a href="{{route('admin.home')}}" class="breadcrumb-item"><i
                            class="fa fa-home2 mr-2" style="font-size: 17px !important"></i> {{__("Home")}}</a>
                    <span class="breadcrumb-item active">{{__("Dashboard")}}</span>
                    <span class="breadcrumb-item active">{{__('SchoolTypes')}}</span>
                </div>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered mb-4">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="w-25">{{__("Name SchoolTypes")}}:</th>
                            <td colspan="2" class="w-50">{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">{{__("Description")}}:</th>
                            <td colspan="2" class="w-50">{{$item->description}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">{{__("created_at")}}:</th>
                            <td colspan="2">{{$item->created_at->diffForHumans()}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">{{__("updated_at")}}:</th>
                            <td colspan="2">{{$item->updated_at->diffForHumans()}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
            <a href="{{route('admin.payment-gateways')}}" class="btn btn-info float-right" type="submit"><i
                    class="fa fa-edit"></i> {{__("Back")}}</a>

        </div>
    </div>
</div>

