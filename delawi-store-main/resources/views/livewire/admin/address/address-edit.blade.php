<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{__("Name")}}</label>
                <input wire:model.defer="address.name" placeholder="{{__("Name")}}"
                       class="form-control @error('address.name') is-invalid @enderror" type="text">
                @error('address.name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

            <div class="form-group">
                <label class="control-label">{{__("Email")}}</label>
                <input wire:model.defer="address.email" placeholder="{{__("Email")}}"

                       class="form-control @error('address.email') is-invalid @enderror" type="text">
                @error('address.email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

            <div class="form-group">
                <label class="control-label">{{__("Mobile")}}</label>
                <input wire:model.defer="address.mobile" placeholder="{{__("Mobile")}}"

                       class="form-control @error('address.mobile') is-invalid @enderror" type="text">
                @error('address.mobile')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">{{__("Country")}}</label>
                <input wire:model.defer="address.country" placeholder="{{__("Country")}}"

                       class="form-control @error('address.country') is-invalid @enderror" type="text">
                @error('address.country')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>


            <div class="form-group">
                <label class="control-label">{{__("City")}}</label>
                <input wire:model.defer="address.city" placeholder="{{__("City")}}"

                       class="form-control @error('address.city') is-invalid @enderror" type="text">
                @error('address.city')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>


            <div class="form-group">
                <label class="control-label">{{__("Address")}}</label>
                <input wire:model.defer="address.location" placeholder="{{__("Address")}}"

                       class="form-control @error('address.location') is-invalid @enderror" type="text">
                @error('address.location')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">{{__("zip_code")}}</label>
                <input wire:model.defer="address.zip_code" placeholder="{{__("zip_code")}}"

                       class="form-control @error('address.zip_code') is-invalid @enderror" type="text">
                @error('address.zip_code')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">{{__("Note")}}</label>
                <textarea wire:model.defer="address.note" placeholder="{{__("Note")}}"

                          class="form-control @error('address.note') is-invalid @enderror" type="text">
                                    @error('address.note')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    </textarea>
            </div>

        </div>

    </div>
    <button class="btn btn-info" type="submit">{{__("Update")}}</button>
</form>
