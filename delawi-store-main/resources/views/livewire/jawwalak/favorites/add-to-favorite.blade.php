@if($is_favorite)
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="delete({{$product->id}})"
       class="ml-auto h4 @if(!$string) w-35p h-35p @endif px-0 py-1 d-flex justify-content-center align-items-center">
        <i class="fas fa-heart font-20 text-secondary"></i>
         @if($string)
        <span class="mt-2 d-inline-flex text-secondary pl-2">{{__("Remove from favorite")}}</span>
    @endif
    </a>
@else
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="add({{$product->id}})"
       class="ml-auto h4 @if(!$string) w-35p h-35p @endif px-0 py-1 d-flex justify-content-center align-items-center">
        <i class="far fa-heart text-secondary bg-light p-2 rounded-circle font-20"></i>
         @if($string)
            <span class="mt-2 d-inline-flex text-secondary pl-2">{{__("Add to favorite")}}</span>
        @endif
    </a>
@endif
