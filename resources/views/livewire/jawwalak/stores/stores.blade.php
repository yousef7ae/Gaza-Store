<div>
    @if($stores->count() > 1)

        <section class="mb-4">

            <div class="container">
                <h2 class="text-secondary font-weight-bold mt-2">{{$page ? $page->title_lang : ""}}</h2>
                <P>{{$page ? $page->description_lang : ""}}</P>

                <div class="owl-carousel owl-theme" id="events">

                    @foreach($stores as $store)

                        <div class="item h-100 z-index-100 ml-4">
                            <div class="card border-light bg-white shadow-sm  padding-14 rounded-10 h-100" data-aos="fade-left">
                                <div class="card-body mb-2 p-0 position-relative">
                                    <div class="d-flex">
                                        <div class="w-30 my-auto">
                                            <div class="overflow-hidden text-center ms-n-2 position-relative z-index-100" style="margin-left: -30px">
                                                <img src="{{ $store->image ? $store->image : url('assets/images/image.png')}}"
                                                     class="rounded-circle w-80-carousel cover bg-light border border-3" width="70px" height="70px"
                                                     alt="{{$store->name}}">
                                            </div>
                                        </div>
                                        <div class="w-68 my-auto">
                                            <div>
                                                <h5 class="card-title text-start text-secondary nowrap ps-3">{{$store->name}}</h5>
                                                <a href="{{route('stores-single',$store->id)}}" class="stretched-link"></a>
                                                <div class="position-relative mb-4 w-110p me-auto ps-3">
                                                    <span class="star1"></span>
                                                    <span class="star2" style="width: 100%"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </section>


        @if($ads->count() > 0)

            <div class="container">
                <div class="row justify-content-between">
                    @foreach($ads->take(2) as $ad)

                        <div class="col-md-6 my-2">
                            <div class="shopping shopping2 overlay px-3 rounded-10" style="background: url({{$ad->image}}) center center no-repeat;">
                                <div class="row align-items-center min-h-250p">
                                    <div class="col-md-8">
                                        <h2 class="text-white">{{$ad->title}}<br>
                                            {{$ad->description}}
                                        </h2>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/stores" class="btn btn-danger py-3">{{__("Start Shopping")}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        @endif

    @endif
</div>
