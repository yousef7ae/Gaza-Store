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
                    <span class="breadcrumb-item active">{{__("Dashboard")}}</span>
                </div>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="card">
        <div class="card-header">{{ __('Manage Users') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Name")}}: </label>
                        <b>{{$user->name}}</b>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Email")}}: </label>
                        <b>{{$user->email}}</b>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Mobile")}}: </label>
                        <b>{{$user->mobile}}</b>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("Status")}}: </label>
                        <b>{{ \App\Models\User::statusList($user->status) }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("created_at")}}: </label>
                        <b>{{\Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->locale('ar_AR')->diffForHumans()}}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{__("updated_at")}}: </label>
                        <b>{{\Carbon\Carbon::createFromTimeStamp(strtotime($user->updated_at))->locale('ar_AR')->diffForHumans()}}</b>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <div>
        @livewire('admin.orders.orders',['user_id' => $user->id])
    </div>

    <div>
        @livewire('admin.transactions.transactions',[$user->id])
    </div>

    <div>
        @livewire('admin.carts.carts',[$user->id])
    </div>

</div>

