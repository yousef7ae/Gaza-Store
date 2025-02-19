<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">

{{--                @if(auth()->user()->hasRole('Admin'))--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">{{__("User")}}</label>--}}
{{--                            <select wire:model="product.user_id"--}}
{{--                                    class="form-control @error('product.user_id') is-invalid @enderror" type="text">--}}
{{--                                <option value="">{{__("Select")}}</option>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('product.user_id')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                    <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">{{__("Store")}}</label>--}}
{{--                        <select wire:model="product.store_id"--}}
{{--                                class="form-control @error('product.store_id') is-invalid @enderror" type="text">--}}
{{--                            <option value="">{{__("Select")}}</option>--}}
{{--                            @foreach($stores as $store)--}}
{{--                                <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('product.store_id')--}}
{{--                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Category")}}</label>
                        <select wire:model.defer="product.category_id"
                                class="form-control @error('product.category_id') is-invalid @enderror" type="text">
                            <option value="">{{__("Select")}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('product.category_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">{{__("Brand")}}</label>--}}
{{--                        <select wire:model.defer="product.brand_id"--}}
{{--                                class="form-control @error('product.brand_id') is-invalid @enderror" type="text">--}}
{{--                            <option value="">{{__("Select")}}</option>--}}
{{--                            @foreach($brands as $brand)--}}
{{--                                <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('product.brand_id')--}}
{{--                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Name Product")}}</label>
                        <input value="" wire:model.defer="product.name"
                               placeholder="{{__("Name Product")}}"
                               name="description"
                               class="form-control @error('product.name') is-invalid @enderror"
                               type="text">
                        @error('product.name')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Old Price")}}</label>
                        <input wire:model.defer="product.old_price"
                               placeholder="{{__("Old Price")}}"
                               name="description"
                               class="form-control @error('product.old_price') is-invalid @enderror"
                               type="text">
                        @error('product.old_price')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Price")}}</label>
                        <input wire:model.defer="product.price"
                               placeholder="{{__("Price")}}"
                               name="description"
                               class="form-control @error('product.price') is-invalid @enderror"
                               type="text">
                        @error('product.price')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Code")}}</label>
                        <input value="" wire:model.defer="product.code"
                               placeholder="{{__("Code")}}"
                               name="description"
                               class="form-control @error('product.code') is-invalid @enderror"
                               type="text">
                        @error('product.code')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input class="form-check-input @error('product.new_product') is-invalid @enderror" type="checkbox" wire:model.defer="product.new_product" value="1">
                            {{ __('New Product') }}
                        </label>
                    </div>
                    @error('product.new_product')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input class="form-check-input @error('product.most_wanted') is-invalid @enderror" type="checkbox" wire:model.defer="product.most_wanted" value="1">
                            {{ __('Most Wanted') }}
                        </label>
                    </div>
                    @error('product.most_wanted')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input class="form-check-input @error('product.order_status') is-invalid @enderror" type="checkbox" wire:model.defer="product.order_status" value="1">
                            {{ __('Order Status') }}
                        </label>
                    </div>
                    @error('product.order_status')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Description') }}</label>
                        <textarea value="" wire:model.defer="product.description"
                                  placeholder="{{ __('Add Description') }}"
                                  name="description"
                                  class="form-control @error('product.description') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('product.description')
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
        <button wire:loading.attr="disabled" class="btn btn-primary submit"
                type="submit">{{__("Update")}}</button>
    </div>
</form>
