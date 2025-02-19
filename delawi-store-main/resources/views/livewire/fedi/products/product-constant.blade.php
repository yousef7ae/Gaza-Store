<form method="post" wire:submit.prevent="changeconstant">

<div class="border-bottom border-light">
        <div class="form-check-inline mb-2 me-md-1 me-0">
            @if($product->ProductDetails->count())
                @foreach($product->ProductDetails->where('unit','size') as $ProductDetail)
                    <input class="form-check-input position-absolute opacity-0" wire:model="size" wire:change="changeconstant({{$product->id}})" id="Size_{{$product->id}}" type="radio" value="{{$ProductDetail->value}}">
                    <label class="form-option-label rounded-circle" for="Size{{$product->id}}"><span class="form-option-Size rounded-circle"><span class="mb-0 fw-bold text-white">{{$ProductDetail->value}}</span> <span class="mb-0">قدم</span> </span> </label>
                @endforeach
            @endif
        </div>
    </div>

    <div class="d-flex align-items-center py-2">
        @if($product->ProductDetails->where('unit','color')->count())
        <p class="text-danger font-weight-bold mt-2 me-2">اللون </p>
        @endif
        <div class="form-check-inline me-1">
            @if($product->ProductDetails->count())
                @foreach($product->ProductDetails->where('unit','color') as $ProductDetail)
                    <input class="form-check-input position-absolute opacity-0" wire:model="color" wire:change="changeconstant({{$product->id}})" type="radio" id="color_{{$product->id}}" value="{{$ProductDetail->value}}">
                    <label class="form-option-label rounded-circle" for="color{{$product->id}}"><span class="form-option-color rounded-circle border border-secondary" style="background-color: {{$ProductDetail->value}};"></span></label>
                @endforeach
            @endif
        </div>
    </div>

</form>
