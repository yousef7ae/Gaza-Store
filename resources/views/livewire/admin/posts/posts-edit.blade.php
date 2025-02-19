<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">

            <div class="form-group" wire:ignore>
                <label class="control-label">{{ __('Description') }}</label>
                <textarea rows="5" value="" wire:model.defer="post.description" placeholder="{{ __('Add Description') }}"
                          id="description2" data-description2="@this"    name="description2"
                          class="form-control  @error('post.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('post.description')
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
                type="submit">{{__("Update")}}</button>
    </div>
</form>

