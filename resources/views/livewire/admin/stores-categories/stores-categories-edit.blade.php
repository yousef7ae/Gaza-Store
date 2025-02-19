<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
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
                        <img width="200" class="rounded-circle img-thumbnail img-fluid"
                             src="{{ empty(['image']) ? url(empty(['image'])) : url('dashboard/images/image1.png')}}"
                             data-holder-rendered="true">
                    @endif
                </div>

                <div class="d-table p-1 m-auto uniform-uploader">
                    <input type="file" wire:model.defer="imageTemp"
                           class="form-input-styled form-control @error('imageTemp') is-invalid @enderror"
                           data-fouc="">
                    @error('imageTemp')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="row">

                {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">{{__("Store")}}</label>
                            <select wire:model="store_category.store_id"
                                    class="form-control @error('store_category.store_id') is-invalid @enderror" type="text">
                                <option value="">{{__("Select")}}</option>
                                @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                @endforeach
                            </select>
                            @error('store_category.store_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div> --}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Store Type') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('store_category.store_type_id') is-invalid @enderror"
                                wire:model="store_category.store_type_id">
                            <option value="0">{{__('Select Store Type')}}...</option>
                            @foreach($store_types as $type)
                                <option
                                    value="{{$type->id}}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('store_category.store_type_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Name Store Category")}}</label>
                        <input wire:model.defer="store_category.name" placeholder="{{__("Name Store Category")}}"
                               class="form-control @error('store_category.name') is-invalid @enderror" type="text">
                        @error('store_category.name')
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
        <button wire:loading.attr="disabled" class="btn btn-primary"
                type="submit">{{__("Store")}}</button>
    </div>
</form>
