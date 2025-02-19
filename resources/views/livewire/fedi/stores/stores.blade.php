@if($stores->count() > 0)
<section class="partners py-5">
    <header class="text-center">
        <h2>{{$page ? $page->title_lang : ""}}</h2>
    </header>
    <div class="container">
        <div class="owl-carousel owl-theme" id="site-ratings">
            @foreach($stores as $store)
            <div class="item">
                <div class="card my-3 shadow-sm d-flex justify-content-center align-items-center h-300p overflow-hidden">
                    <a class="text-center mx-auto stretched-link" href="{{route('stores-single',$store->id)}}">
                        <img class="min-h-300p cover" src="{{ $store->image ? $store->image : url('assets/img/woman-accessories.jpg')}}" alt="">
                        <div class="carousel-caption">
                            <h4>{{$store->name}}</h4>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

