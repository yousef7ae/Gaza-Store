<div class="container" style="margin-top: 150px;">
    <h1>{{__("My Favorites")}}</h1>
    @if($carts->count() > 0)
        <table class="table">
            <tr>
                <th>{{__("id")}}</th>
                <th>{{__("Name")}}</th>
                <th>{{__("Price")}}</th>
                <th></th>
            </tr>
            @foreach($carts as $cart)
                <tr>
                    <td>{{$cart->id}}</td>
                    <td>{{$cart->product ? $cart->product->name : ''}}</td>
                    <td>{{$cart->product ? $cart->product->price_string : ''}}</td>
                    <td><a href="#" wire:click.prevent="remove('{{$cart->id}}')"><i class="fa fa-times"></i></a></td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-danger m-4 rounded-pill">{{__("Empty list")}}</div>
    @endif
</div>
