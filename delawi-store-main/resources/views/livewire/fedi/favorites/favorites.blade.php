<main :key="{{rand(1,1000)}}">
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">المفضلة</li>
          </ol>
        </nav>
    </div>
    <section>
        <div :key="{{rand(1,1000)}}" class="container">
            <h1 class="mb-4 fw-bold"> {{__("My Favorites")}} </h1>
            <div class="row g-md-4 g-2">
                @if($favorites->count() > 0)
                    @foreach($favorites as $favorite)
                        <div class="col-lg-3 col-md-4 col-6">
                            @livewire('site.products.product-card',['product_id' => $favorite->product])
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-danger mt-3"> {{__("Empty Favorite")}}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>


