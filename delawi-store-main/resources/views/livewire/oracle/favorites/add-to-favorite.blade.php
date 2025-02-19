@if($is_favorite > 0)
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="delete({{$product->id}})"
       class="ml-auto h4 @if(!$string) w-35p h-35p @endif px-0 py-1 d-flex justify-content-center align-items-center">
        <i class="fas fa-heart font-20 text-danger"></i>
         @if($string)
        <span class="mt-2 d-inline-flex text-danger pl-2">Add to favorite</span>
    @endif
    </a>
@else
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="add({{$product->id}})"
       class="ml-auto h4 @if(!$string) w-35p h-35p @endif px-0 py-1 d-flex justify-content-center align-items-center">
        <i class="far fa-heart text-danger font-20"></i>
         @if($string)
            <span class="mt-2 d-inline-flex text-danger pl-2">Add to favorite</span>
        @endif
    </a>
@endif
