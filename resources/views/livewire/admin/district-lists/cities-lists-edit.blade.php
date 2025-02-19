<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="city.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('city.name') is-invalid @enderror" type="text">
                        @error('city.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('delivery_price') }}</label>
                        <input value="" wire:model.defer="city.delivery_price" placeholder="{{ __('delivery_price') }}"
                               name="city.delivery_price"
                               class="form-control @error('city.delivery_price') is-invalid @enderror" type="text">
                        @error('city.delivery_price')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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

