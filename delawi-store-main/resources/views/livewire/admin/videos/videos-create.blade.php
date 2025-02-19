<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card d-table p-1 m-auto">
                        @if($imageTemp)
                            <img width="150" class="img-fluid rounded"
                                 src="{{ $imageTemp->temporaryUrl() }}"
                                 data-holder-rendered="true">

                        @else
                            <img width="200" class="img-fluid rounded"
                                 src="{{ empty(['image']) ? url(empty(['image'])) : url('dashboard/images/image1.png')}}"
                                 data-holder-rendered="true">
                        @endif
                    </div>

                    <div class="d-table p-1 m-auto uniform-uploader">
                        <input type="file" wire:model.defer="imageTemp"
                               class="form-input-styled form-control submit @error('imageTemp ') is-invalid @enderror"
                               data-fouc=""
                        >
                        @error('imageTemp')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{ __('Title') }}</label>
                <input value="" wire:model.defer="video.title" placeholder="{{ __('Add Title') }}"
                       title="title"
                       class="form-control @error('video.title') is-invalid @enderror" type="text">
                @error('video.title')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>
            <div class="form-group">

                    <div class="form-group" wire:ignore>
                        <label class="control-label">{{ __('Description') }}</label>
                        <textarea rows="5" value="" wire:model.defer="video.description" placeholder="{{ __('Add Description') }}"
                                  id="description" data-description="@this"    name="description"
                                  class="form-control  @error('video.description') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('video.description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

            </div>
            <div class="form-group">
                <label class="control-label">{{ __('Url') }}</label>
                <input value="" wire:model.defer="video.url" placeholder="{{ __('Add Url') }}"
                       title="url"
                       class="form-control @error('video.url') is-invalid @enderror" type="text">
                @error('video.url')
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
        <button wire:loading.attr="disabled" class="btn btn-primary"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

