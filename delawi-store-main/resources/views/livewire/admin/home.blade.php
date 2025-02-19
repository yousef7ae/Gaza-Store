<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__("Dashboard")}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__("Dashboard")}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->

    <section class="content">
        <div class="container-fluid">
            @include('livewire.admin.alert')

            <div class="row">

                <!-- ./col -->
                @foreach($models as $index => $model)
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="activity"></i></div>
                                <div class="media-body"><span class="m-0">{{$model}}</span>
                                    <h4 class="mb-0 counter">{{__($index)}}</h4><i class="icon-bg" data-feather="activity"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
        <!--/. container-fluid -->
    </section>
</div>


