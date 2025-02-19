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

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Category")}}</label>
                        <select wire:model.defer="city.country_id"
                                class="form-control @error('city.country_id') is-invalid @enderror" >
                            <option value="">{{__("Select")}}</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('city.country_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("States")}}</label>
                        <select wire:model.defer="city.state_id"
                                class="form-control @error('city.state_id') is-invalid @enderror" >
                            <option value="">{{__("Select")}}</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                        @error('city.state_id')
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

