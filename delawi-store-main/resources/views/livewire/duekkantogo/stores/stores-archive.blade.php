<div class="mt-5">
    <section>
        <div class="">
            <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
                <img class="w-100" src="{{$page_data->image}}" alt="">
                <div
                    class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
                    <div class="container text-left">
                        <h1 class="font-weight-bold">{{$page_data->title_lang}}</h1>
                        <p>{{$page_data->description_lang}}</p>
                    </div>
                </div>
            </div>
        </div>
        <form class="container mt-4">
            <div class="row no-gutters filter">
                <div class="col-md-9">
                    <div class="rounded-top-right bg-light p-3">
                        <div class="row">
                            <div class="col">
                                <label class="mb-3" for="Country">{{__("Country")}}</label>
                                <select wire:model="user.country_id"
                                        class="form-control @error('user.country_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                                    <option value="0">{{__('Select Country')}}...</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <img width="32" class="mt-n5 pt-3 ml-1 position-absolute"
                                     src="{{asset('assets/flags/'.$user_country_code.'.png')}}" alt="">
                            </div>
                            <div class="col">
                                <label class="mb-3" for="City">{{__("City")}}</label>
                                <select wire:model="user.city_id"
                                        class="form-control @error('user.city_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                                    <option value="0">{{__('Select City')}}...</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mb-3" for="Brands">{{__("Brands")}}</label>
                                <select wire:model="user.brand_id"
                                        class="form-control @error('user.city_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                                    <option value="0">{{__('Select Brand')}}...</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mb-3" for="Categories">{{__("Categories")}}</label>
                                <select wire:model="user.category_id"
                                        class="form-control @error('user.city_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                                    <option value="0">{{__('Select Category')}}...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mb-4" for="Categories">{{__("Rate")}}</label>
                                <div class="position-relative mb-4 w-110p mx-auto">
                                    <span wire:click="changeRate(5)" class="{{$rate >= 5 ? 'star2' : 'star1'}}"
                                          style="width: 100%"></span>
                                    <span wire:click="changeRate(4)" class="{{$rate >= 4 ? 'star2' : 'star1'}}"
                                          style="width: 80%"></span>
                                    <span wire:click="changeRate(3)" class="{{$rate >= 3 ? 'star2' : 'star1'}}"
                                          style="width: 60%"></span>
                                    <span wire:click="changeRate(2)" class="{{$rate >= 2 ? 'star2' : 'star1'}}"
                                          style="width: 40%"></span>
                                    <span wire:click="changeRate(1)" class="{{$rate >= 1 ? 'star2' : 'star1'}}"
                                          style="width: 20%"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    @if(count($stores) > 0)
        <section class="py-4 stores">
            <div class="container">
                <div class="row overflow-hidden px-3 py-1">
                    @foreach( $stores as $store )

                        <div class="col-lg-4 col-6 mb-3 mt-5 p-md-3 p-2">
                            <div class="box-store  card h-100 border-light rounded-lg shadow-sm">
                                <div class="card-body mb-2">
                                    <img src="{{ $store->image ? url($store->image) : url('assets/images/image.png')}}"
                                         class="rounded-circle overflow-hidden mb-md-4 mb-2" alt="{{$store->name}}">
                                    <h5 class="card-title text-secondary">{{$store->name}}</h5>
                                    <a href="{{route('stores-single',$store->id)}}" class="stretched-link"></a>
                                    <div class="clearfix">
                                        <span class="float-left h5 pl-110p text-secondary ml-3">{{$store->rate}}</span>
                                        <div class="position-relative mb-4 w-110p">
                                            <span class="star1"></span>
                                            <span class="star2" style="width: {{$store->rate*20}}%"></span>
                                        </div>
                                    </div>
                                    <p><i class="fas fa-map-marker-alt text-secondary"></i> {{$store->address}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                {{--        <nav aria-label="Page navigation example">--}}
                {{--            <ul class="pagination justify-content-end">--}}
                {{--                <li class="page-item mx-md-2 mx-1"><a class="page-link border-0 text-dark rounded" href="#">Page</a></li>--}}
                {{--                <li class="page-item mx-md-2 mx-1"><a class="page-link text-dark rounded active" href="#"> {{ $st->links() }}</a></li>--}}
                {{--                <li class="page-item mx-md-2 mx-1"><a class="page-link border-0 text-dark rounded" href="#">NEXT</a></li>--}}
                {{--            </ul>--}}
                {{--        </nav>--}}
            </div>
        </section>

    @endif

</div>
