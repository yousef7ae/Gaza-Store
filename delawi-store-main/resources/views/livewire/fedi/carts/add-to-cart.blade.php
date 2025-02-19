<div>
    @if($product->is_cart and $product->is_cart->id)

        <button key="cart-{{rand(1,1000)}}" wire:click.prevent="remove({{$product->id}})"
                class="btn btn-theme btn-danger d-block">

            {{__('Remove From cart')}}
            @if($string)
                <span class="mt-2 d-inline-flex pl-sm-2">{{__("Remove to cart")}}</span>
            @endif

        </button>

    @else

        <button key="cart-{{rand(1,1000)}}" wire:click.prevent="add({{$product->id}})" class="btn btn-theme btn-primary d-block">

            {{__('Add to cart')}}<i class="fas fa-shopping-cart pl-sm-2"></i>
            @if($string)
                <span class="mt-2 d-inline-flex pl-sm-2">{{__("Add to cart")}} </span>
            @endif

        </button>

    @endif

</div>




