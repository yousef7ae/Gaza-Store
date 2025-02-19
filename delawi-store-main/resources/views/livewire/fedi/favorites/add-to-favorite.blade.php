@if($is_favorite)
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="delete({{$product->id}})" class="btn px-0 ms-2 btn-outline-primary rounded-circle w-35p h-35p"><i class="fas fa-heart font-20 "></i></a>
@else
    <a href="#" key="add-to-favorite-{{rand(1,1000)}}" wire:click.prevent="add({{$product->id}})" class="btn px-0 ms-2 btn-outline-primary rounded-circle w-35p h-35p"><i class="far fa-heart font-20"></i></a>
@endif

