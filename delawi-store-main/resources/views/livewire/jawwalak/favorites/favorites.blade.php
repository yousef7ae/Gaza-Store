<div class="container" style="margin-top: 150px;">
    <h1>{{__("My Favorites")}}</h1>
    @if($favorites->count() > 0)
        <div class="row">
        @foreach($favorites as $favorite)
            <div class="col-md-3 col-6 min-h-250p mb-4 overflow-hidden px-md-3 px-2">
                @livewire('site.products.product-card',['product_id' => $favorite->product])
            </div>
        @endforeach
        </div>
    @else
        <div class="alert alert-danger m-4 rounded-pill">{{__("Empty list")}}</div>
    @endif
</div>
