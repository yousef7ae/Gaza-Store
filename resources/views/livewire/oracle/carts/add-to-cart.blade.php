<a href="#" key="cart-{{rand(1,1000)}}" wire:click.prevent="add({{$product->id}})" class="px-1 h4 text-warning">
    <img src="{{ asset('assets/images/sell-stock-50.png') }}" class="contain" width="25px" alt="">
    @if($string)
        <span class="mt-2 d-inline-flex pl-2">Add to cart</span>
    @endif
</a>
