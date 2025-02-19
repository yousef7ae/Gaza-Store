<section class="">
@if($categories->count() > 0)
        <div class="container">
            <div class="row">
             @foreach($categories as $category)
                <div class="col-md-4 col-6">
                    <div class="card layout my-3 shadow-sm d-flex justify-content-center align-items-center h-300p overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                        <a class="text-center mx-auto stretched-link" href="{{route('stores-single',$category->store_id)}}?category_id={{$category->id}}">
                            <img class="cover" src="{{ $category->image ? $category->image : url('fedi/img/img-2.png')}}" alt="">
                            <div class="carousel-caption text-white">
                                <h4 class="text-white fw-bold"> {{$category->name}} </h4>
                                <p>{{$category->description}}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>




<!-- <div>
@if($categories->count() > 0)
    <section class="partners py-5">
        <header class="text-center">
            <h2></h2>
        </header>
        <div class="container">
            <div class="owl-carousel owl-theme" id="site-ratings">
                @foreach($categories as $category)
                    <div class="item">
                        <div class="card my-3 shadow-sm d-flex justify-content-center align-items-center h-300p overflow-hidden">
                            <a class="text-center mx-auto stretched-link" href="{{route('stores-single',$category->store_id)}}?category_id={{$category->id}}">
                                <img class="min-h-300p cover" src="{{ $category->image ? $category->image : url('assets/img/woman-accessories.jpg')}}" alt="">
                                <div class="carousel-caption">
                                    <h4>{{$category->name}}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
</div> -->




