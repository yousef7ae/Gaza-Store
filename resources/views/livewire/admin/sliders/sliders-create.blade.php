
<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label class="control-label">{{ __('Name') }}</label>
                <input value="" wire:model.defer="slider.name" placeholder="{{ __('Add Name') }}"
                       name="name"
                       class="form-control @error('slider.name') is-invalid @enderror" type="text">
                @error('slider.name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            @if (auth()->user()->hasRole('Admin'))
                <div class="form-group">
                    <label class="control-label">{{__("Store")}}</label>
                    <select wire:model="slider.store_id"
                            class="form-control @error('slider.store_id') is-invalid @enderror" type="text">
                        <option value="">{{__("Select")}}</option>
                        @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                        @endforeach
                    </select>
                    @error('slider.store_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            @endif

            @if($products)
                <div class="form-group">
                    <label class="control-label">{{__("Product")}}</label>
                    <select wire:model="slider.product_id"
                            class="form-control @error('slider.product_id') is-invalid @enderror" type="text">
                        <option value="">{{__("Select")}}</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    @error('slider.product_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            @endif

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card d-table p-1 m-auto">
                            @if($imageTemp)
                                <img width="150" class="img-fluid rounded"
                                     src="{{ $imageTemp->temporaryUrl() }}"
                                     data-holder-rendered="true">

                            @else
                                <img width="200" class="img-fluid rounded"
                                     src="{{ $image ? url($image) : url('dashboard/images/image1.png')}}"
                                     data-holder-rendered="true">
                            @endif
                        </div>

                        <div class="d-table p-1 m-auto uniform-uploader">
                            <input type="file" wire:model.defer="imageTemp"
                                   class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                                   data-fouc=""
                            >
                            <span class="filename">{{__("File Image")}}</span>
                            <span class="filename">{{__("Image size")}} 1100X500</span>

                            @error('imageTemp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>
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
        <button wire:loading.attr="disabled" class="btn btn-primary"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

