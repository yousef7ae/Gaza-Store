<main class="mt-4 pt-2 Privacy">
    <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
        <img class="w-100" src="{{$page ? $page['image'] : asset('Dukkan/images/bg-Profile.png') }}" alt="">
        <div
            class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
            <div class="container text-left">
                <h1 class="font-weight-bold">{{$page ? $page->title_lang : ""}}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="filter max-w-950p mb-4">
            <div class="rounded-top-right bg-light p-3">
                <p class="p-3">{{$page ? $page->description_lang : ""}}</p>
            </div>
        </div>
        <div class="row">

            <!-- sidebar -->
            @livewire('site.profile.sidebar')

            <div class="col-lg-8">
                <h4 class="text-secondary mb-4">{{__("My Points")}}</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 bg-danger pt-2 text-white">
                            <div class="card-body text-center">
                                <h3><span class="display-4 font-weight-bold pr-3">0</span>{{__("Points")}}</h3>
                                <p>{{__('The Points Will Be Immediately Converted Into Credit For You, Dear')}}</p>
                                <p><img width="29" src="{{asset('Dukkan/images/icon1.png')}}"
                                        alt="">{{__("Enjoy With us The Balance At 22 Euros")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4 class="text-secondary">{{__("Details")}}</h4>
                        <div class="card border-0 bg-warning mb-3">
                            <div class="p-2 text-white">
                                <h2 class="font-weight-bold">0</h2>
                                <p>{{__("Number Of Products")}}</p>
                            </div>
                        </div>
                        <div class="card border-0 bg-info">
                            <div class="p-2 text-white">
                                <h2 class="font-weight-bold d-inline-block pr-2 mb-1">0 </h2>
                                <p class="d-inline-block mb-1">{{__("Euros")}}</p>
                                <p>{{__("Paid Money")}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
