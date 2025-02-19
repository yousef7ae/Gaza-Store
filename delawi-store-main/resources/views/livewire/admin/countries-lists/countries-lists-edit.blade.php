<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="country.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('country.name') is-invalid @enderror" type="text">
                        @error('country.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('iso2') }}</label>
                        <input value="" wire:model.defer="country.iso2" placeholder="{{ __('Add iso2') }}"
                               name="iso2"
                               class="form-control @error('country.iso2') is-invalid @enderror" type="text">
                        @error('country.iso2')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('iso3') }}</label>
                        <input value="" wire:model.defer="country.iso3" placeholder="{{ __('Add iso3') }}"
                               name="iso3"
                               class="form-control @error('country.iso3') is-invalid @enderror" type="text">
                        @error('country.iso3')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('phone_code') }}</label>
                        <input value="" wire:model.defer="country.phone_code" placeholder="{{ __('Add phone_code') }}"
                               name="phone_code"
                               class="form-control @error('country.phone_code') is-invalid @enderror" type="number">
                        @error('country.phone_code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('region') }}</label>
                        <input value="" wire:model.defer="country.region" placeholder="{{ __('Add region') }}"
                               name="region"
                               class="form-control @error('country.region') is-invalid @enderror" type="text">
                        @error('country.region')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('sub region') }}</label>
                        <input value="" wire:model.defer="country.sub_region" placeholder="{{ __('Add sub_region') }}"
                               name="sub_region"
                               class="form-control @error('country.sub_region') is-invalid @enderror" type="text">
                        @error('country.sub_region')
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

