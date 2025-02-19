<main>
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('My Points')}}</li>
            </ol>
        </nav>
    </div>
    <img class="img-fluid w-100" src="{{$page ? $page['image'] : asset('fedi/img/img-11.jpg') }}" style="max-height: 460px" alt="">
    <div class="container Privacy">
        <div class="row">
            <aside class="col-lg-4 mb-4">
                <div class="card border-0 bg-light rounded-3">
                    <div class="text-center py-3">
                        @livewire('site.profile.avatar')
                    </div>
                    @livewire('site.profile.sidebar')
                </div>
            </aside>
            <div class="col-lg-8 mb-4">
                <div class="card card-body border-0 bg-light rounded-3">
                    <h1 class="h4 mt-2 mb-4">{{__('My Points')}} </h1>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border rounded-2 pt-2 bg-danger">
                                <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                    <h3 class="text-white fw-bold"> {{__("Points")}} {{$orders->sum('total')}}</h3>
                                    <p class="mb-1 text-white">{{__('The Points Will Be Immediately Converted Into Credit For You, Dear')}}</p>
                                    <p class="mb-1 text-white">{{__("Enjoy With us The Balance At 22 Euros")}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border rounded-2 bg-success mb-3">
                                <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                    <p class="text-white mb-0">  {{$orders->count()}}  {{__('Products')}} </p>
                                    <h4 class="fw-bold text-white mb-0">{{__("Number Of Products")}}</h4>
                                </div>
                            </div>
                            <div class="card border rounded-2 bg-primary text-white">
                                <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                    <p class="mb-0 text-white"> {{$orders->sum('total')}} {{$stores->currency->code}}</p>
                                    <h4 class="fw-bold text-white mb-0">{{__("Paid Money")}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-md-5 mt-md-5"></div>
</main>

