<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-12">
            <div class="form-group">
                <div class="card d-table p-1 m-auto">
                    @if($imageTemp)
                        <img width="150" class="img-fluid rounded"
                             src="{{ $imageTemp->temporaryUrl() }}"
                             data-holder-rendered="true">

                    @else
                        @if(!empty($brand['image']))
                            <img width="200" class="rounded-circle img-thumbnail"
                                 src="{{ $brand['image'] }}"
                                 data-holder-rendered="true">
                        @endif
                    @endif
                </div>

                <div class="d-table p-1 m-auto uniform-uploader">
                    <input type="file" wire:model.defer="imageTemp"
                           class="form-input-styled form-control submit2 @error('imageTemp ') is-invalid @enderror"
                           data-fouc=""
                    >
                    <span class="filename" >{{__("File Image")}}</span>
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
                <label class="control-label">{{ __('Name') }}</label>
                <input value="" wire:model.defer="brand.name" placeholder="{{ __('Add Name') }}"
                       name="name"
                       class="form-control @error('brand.name') is-invalid @enderror" type="text">
                @error('brand.name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group" wire:ignore>
                <label class="control-label">{{ __('Description') }}</label>
                <textarea rows="5" value="" wire:model.defer="brand.description" placeholder="{{ __('Add Description') }}"
                          id="description" data-description="@this"    name="description"
                          class="form-control editor @error('brand.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('brand.description')
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

