{{--
<form class="mt-2 w-100" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{__("code")}}</label>
                    <input wire:model.defer="coupon.code" placeholder="{{__("code")}}" class="form-control @error('coupon.code') is-invalid @enderror" type="text">
                    @error('coupon.code')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{__("Products")}}</label>
                    <select wire:model.defer="coupon.product_id" class="form-control @error('coupon.product_id') is-invalid @enderror" type="text">
                        <option value="">{{__("Select")}}</option>
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    @error('coupon.product_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            --}}
            {{-- @if(auth()->user()->hasRole('Admin'))--}}{{--

--}}
            {{-- <div class="col-md-6">--}}{{--

--}}
            {{-- <div class="form-group">--}}{{--

--}}
            {{-- <label class="control-label">{{__("Users")}}</label>--}}{{--

--}}
            {{-- <select wire:model.defer="coupon.user_id"--}}{{--

--}}
            {{-- class="form-control @error('coupon.user_id') is-invalid @enderror" type="text">--}}{{--

--}}
            {{-- <option value="">{{__("Select")}}</option>--}}{{--

--}}
            {{-- @foreach($users as $user)--}}{{--

--}}
            {{-- <option value="{{$user->id}}">{{$user->name}}</option>--}}{{--

--}}
            {{-- @endforeach--}}{{--

--}}
            {{-- </select>--}}{{--

--}}
            {{-- @error('coupon.user_id')--}}{{--

--}}
            {{-- <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}{{--

--}}
            {{-- @enderror--}}{{--

--}}
            {{-- </div>--}}{{--

--}}
            {{-- </div>--}}{{--

--}}
            {{-- @endif--}}{{--

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("value")}}</label>
            <input wire:model.defer="coupon.value" placeholder="{{__("value")}}" class="form-control @error('coupon.value') is-invalid @enderror" type="number">
            @error('coupon.value')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    --}}
    {{-- <div class="col-md-6">--}}{{--

--}}
    {{-- <div class="form-group">--}}{{--

--}}
    {{-- <label class="control-label">{{__("type")}}</label>--}}{{--

--}}
    {{-- <input wire:model.defer="coupon.type" placeholder="{{__("type")}}"--}}{{--


--}}
    {{-- class="form-control @error('coupon.type') is-invalid @enderror" type="number">--}}{{--

--}}
    {{-- @error('coupon.type')--}}{{--

--}}
    {{-- <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}{{--

--}}
    {{-- @enderror--}}{{--

--}}
    {{-- </div>--}}{{--

--}}
    {{-- </div>--}}{{--


--}}
    {{-- <div class="col-md-6">--}}{{--

--}}
    {{-- <div class="form-group">--}}{{--

--}}
    {{-- <label class="control-label">{{__("count")}}</label>--}}{{--

--}}
    {{-- <input wire:model.defer="coupon.count" placeholder="{{__("count")}}"--}}{{--


--}}
    {{-- class="form-control @error('coupon.count') is-invalid @enderror" type="number">--}}{{--

--}}
    {{-- @error('coupon.count')--}}{{--

--}}
    {{-- <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}{{--

--}}
    {{-- @enderror--}}{{--

--}}
    {{-- </div>--}}{{--

--}}
    {{-- </div>--}}{{--


--}}
    {{-- <div class="col-md-6">--}}{{--

--}}
    {{-- <div class="form-group">--}}{{--

--}}
    {{-- <label class="control-label">{{__("used")}}</label>--}}{{--

--}}
    {{-- <input wire:model.defer="coupon.used" placeholder="{{__("used")}}"--}}{{--


--}}
    {{-- class="form-control @error('coupon.used') is-invalid @enderror" type="text">--}}{{--

--}}
    {{-- @error('coupon.used')--}}{{--

--}}
    {{-- <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}{{--

--}}
    {{-- @enderror--}}{{--

--}}
    {{-- </div>--}}{{--

--}}
    {{-- </div>--}}{{--


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("expiration")}}</label>
    <input value="" wire:model.defer="coupon.expiration" class="form-control @error('coupon.expiration') is-invalid @enderror" type="date">

    @error('coupon.expiration')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
</div>
</div>
</div>
</div>

<div>
    <div wire:loading>
        <i class="fas fa-sync fa-spin"></i>
        {{__("Loading please wait")}} ...
    </div>
</div>
<div>
    <button wire:loading.attr="disabled" class="btn btn-primary submit" type="submit">{{__("Store")}}</button>
</div>
</form>
--}}





















<form class="mt-2 w-100" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("code")}}</label>
                        <input wire:model.defer="coupon.code" placeholder="{{__("code")}}" class="form-control @error('coupon.code') is-invalid @enderror" type="text">
                        @error('coupon.code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                {{-- @if (auth()->user()->hasRole('Admin'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">{{__("Store")}}</label>
                <select wire:change="setProduct" wire:model="coupon.store_id" class="form-control @error('coupon.store_id') is-invalid @enderror" type="text">
                    <option value="">{{__("Select")}}</option>
                    @if($stores->count() > 0)
                    @foreach($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                    @endforeach
                    @endif
                </select>
                @error('coupon.store_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        @endif --}}
        {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Category")}}</label>
        <select wire:change="setProduct" wire:model="coupon.category_id" class="form-control @error('coupon.category_id') is-invalid @enderror" type="text">
            <option value="">{{__("Select")}}</option>
            @if($categories->count() > 0)
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            @endif
        </select>
        @error('coupon.category_id')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    </div> --}}

    {{-- <div class="col-md-6">--}}
    {{-- <div class="form-group">--}}
    {{-- <label class="control-label">{{__("Brand")}}</label>--}}
    {{-- <select wire:change = "setProductB" wire:model="coupon.brand_id"--}}
    {{-- class="form-control @error('coupon.brand_id') is-invalid @enderror" type="text">--}}
    {{-- <option value="">{{__("Select")}}</option>--}}
    {{-- @foreach($brands as $brand)--}}
    {{-- <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
    {{-- @endforeach--}}
    {{-- </select>--}}
    {{-- @error('coupon.brand_id')--}}
    {{-- <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
    {{-- @enderror--}}
    {{-- </div>--}}
    {{-- </div>--}}

    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{{__("Products")}}</label>
            <select wire:model.defer="coupon.product_id" class="form-control @error('coupon.product_id') is-invalid @enderror" type="text">
                <option value="">{{__("Select")}}</option>
                @if($products and $products->count() > 0)
                @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
                @endif
            </select>
            @error('coupon.product_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{{__("value")}}</label>
            <input wire:model.defer="coupon.value" placeholder="{{__("value")}}" class="form-control @error('coupon.value') is-invalid @enderror" type="number">
            @error('coupon.value')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{{__("expiration")}}</label>
            <input value="" wire:model.defer="coupon.expiration" class="form-control @error('coupon.expiration') is-invalid @enderror" type="datetime-local">

            @error('coupon.expiration')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    </div>
    </div>
    </div>

    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div>
        <button wire:loading.attr="disabled" class="btn btn-primary submit" type="submit">{{__("Store")}}</button>
    </div>
</form>
