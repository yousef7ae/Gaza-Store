<form class="" method="post" wire:submit.prevent="changeconstant">
    <label class="mb-1 text-p">الحجم</label>
        <select class="form-select mb-2" style="width: 100px" wire:model="color" wire:change="changeconstant({{$product->id}})" required>
            <option selected>{{__('Color')}}</option>
            @if($product->ProductDetails->count())
                @foreach($product->ProductDetails->where('unit','color') as $ProductDetail)
                    <option value="{{$ProductDetail->value}}">{{$ProductDetail->value}}</option>
                @endforeach
            @endif
        </select>
         <label class="mb-1 text-p">اللون</label>
        <select class="form-select mb-2" style="width: 100px" wire:model="size" wire:change="changeconstant({{$product->id}})" required>
            <option selected>{{__('Size')}}</option>
            @if($product->ProductDetails->count())
                @foreach($product->ProductDetails->where('unit','size') as $ProductDetail)
                    <option value="{{$ProductDetail->value}}">{{$ProductDetail->value}}</option>
                @endforeach
            @endif
        </select>
</form>
