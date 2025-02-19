<div>
    <section>
        <div class="">
            <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
                <img class="w-100" src="{{asset('fedi/assets/img/testimonials-bg.jpg')}}" alt="">
                <div
                    class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
                    <div class="container text-left">
                        <h1 class="font-weight-bold">{{__("Stores")}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($stores) > 0)
        <section class="py-4 stores">
            <div class="container">
                <div class="row overflow-hidden px-3 py-1">
                    @foreach( $stores as $store )

                        <div class="col-lg-4 col-6 mb-3 p-md-3 p-2">
                            <div class="box-store mt-md-5 mt-3 card border-light rounded-lg shadow-sm">
                                <div class="card-body mb-2">
                                    <img src="{{ $store->image ? url($store->image) : url('assets/images/image.png')}}" width="100" height="100"
                                         class="rounded-circle overflow-hidden mb-md-4 mb-2" alt="{{$store->name}}">
                                    <h5 class="card-title text-danger">{{$store->name}}</h5>
                                    <a href="{{route('stores-single',$store->id)}}" class="stretched-link"></a>
                                    <div class="clearfix">
                                        <span class="float-left h5 pl-110p text-danger ml-3">{{$store->rate}}</span>
                                        <div class="position-relative mb-4 w-110p">
                                            <span class="star1"></span>
                                            <span class="star2" style="width: {{$store->rate*20}}%"></span>
                                        </div>
                                    </div>
                                    <p><i class="fas fa-map-marker-alt text-danger"></i> {{$store->address}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </section>

    @endif

</div>
