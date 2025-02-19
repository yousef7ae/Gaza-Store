<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}


    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <div class="card d-table p-1 m-auto">
                    @if($imageTemp)
                        <img width="150" class="img-fluid rounded"
                             src="{{ $imageTemp->temporaryUrl() }}"
                             data-holder-rendered="true">

                    @else

                        @if(!empty($ad['image']))
                            <img width="200" class="rounded-circle img-thumbnail"
                                 src="{{ $ad['image'] }}"
                                 data-holder-rendered="true">
                        @endif
                    @endif
                </div>

                <div class="d-table p-1 m-auto uniform-uploader">
                    <input type="file" wire:model.defer="imageTemp"
                           class="form-input-styled form-control submit2 @error('imageTemp') is-invalid @enderror"
                           data-fouc=""
                    >
                    <span class="filename">{{__("File Image")}}</span>
                    <span class="filename">{{__("Image size")}} 1100X250</span>

                    @error('imageTemp')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ __('Title') }}</label>
                <input value="" wire:model.defer="ad.title" placeholder="{{ __('Add Title') }}"
                       name="title"
                       class="form-control @error('ad.title') is-invalid @enderror" type="text">
                @error('ad.title')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

{{--            @if (auth()->user()->hasRole('Admin'))--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">{{__("Store")}}</label>--}}
{{--                    <select wire:model="ad.store_id"--}}
{{--                            class="form-control @error('ad.store_id') is-invalid @enderror" type="text">--}}
{{--                        <option value="">{{__("Select")}}</option>--}}
{{--                        @foreach($stores as $store)--}}
{{--                            <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @error('ad.store_id')--}}
{{--                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--            @endif--}}

{{--            @if($products)--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">{{__("Product")}}</label>--}}
{{--                    <select wire:model="ad.product_id"--}}
{{--                            class="form-control @error('ad.product_id') is-invalid @enderror" type="text">--}}
{{--                        <option value="">{{__("Select")}}</option>--}}
{{--                        @foreach($products as $product)--}}
{{--                            <option value="{{$product->id}}">{{$product->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @error('ad.product_id')--}}
{{--                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="form-group" wire:ignore>
                <label class="control-label">{{ __('Description') }}</label>
                <textarea rows="5" value="" wire:model.defer="ad.description" placeholder="{{ __('Add Description') }}"
                          id="description2" data-description2="@this" name="description2"
                          class="form-control editor @error('ad.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('ad.description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

            <div class="form-group">
                <label class="control-label">{{__("Date")}}</label>
                <input value="" wire:model.defer="ad.date" class="form-control @error('ad.date') is-invalid @enderror"
                       type="date">

                @error('ad.date')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
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

