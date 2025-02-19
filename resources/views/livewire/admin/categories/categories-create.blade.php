<form class="mt-2 w-100" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

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
                                   class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                                   data-fouc=""
                            >
                            @error('imageTemp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
{{--                @if (auth()->user()->hasRole('Admin'))--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">{{__("Store")}}</label>--}}
{{--                            <select wire:model="category.store_id"--}}
{{--                                    class="form-control @error('category.store_id') is-invalid @enderror" type="text">--}}
{{--                                <option value="">{{__("Select")}}</option>--}}
{{--                                @foreach($stores as $store)--}}
{{--                                    <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('category.store_id')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Category")}}</label>
                        <select wire:model="category.category_id"
                                class="form-control @error('category.category_id') is-invalid @enderror"
                                type="text">
                            <option value="0">{{__("Select")}}</option>
                            @foreach($categories as $category_)
                                <option value="{{ $category_->id }}">{{ $category_->name }}</option>
                            @endforeach
                            <option value="other">{{ __("Other") }}</option>
                        </select>
                        @error('category.category_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div> --}}

                {{-- @if($category['category_id'] === 'other') --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("Name Category")}}</label>
                            <input wire:model.defer="category.name" placeholder="{{__("Name Category")}}"
                                   class="form-control @error('category.name') is-invalid @enderror" type="text">
                            @error('category.name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{ __('Description') }}</label>
                            <textarea value="" wire:model.defer="category.description"
                                      placeholder="{{ __('Add Description') }}"
                                      name="description"
                                      class="form-control @error('category.description') is-invalid @enderror"
                                      type="text"></textarea>
                            @error('category.description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                {{-- @endif --}}

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
                type="submit">{{__("Save")}}
        </button>
    </div>
</form>
