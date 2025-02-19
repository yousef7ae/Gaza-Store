<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("from")}}</label>
                        <input wire:model.defer="delivery_fee.from" placeholder="{{__("from")}}"

                               class="form-control @error('delivery_fee.from') is-invalid @enderror" type="text">
                        @error('delivery_fee.from')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("to")}}</label>
                        <input wire:model.defer="delivery_fee.to" placeholder="{{__("to")}}"

                               class="form-control @error('delivery_fee.to') is-invalid @enderror" type="text">
                        @error('delivery_fee.to')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">{{__("store_id")}}</label>--}}
{{--                        <input wire:model.defer="delivery_fee.store_id" placeholder="{{__("store_id")}}"--}}

{{--                               class="form-control @error('delivery_fee.store_id') is-invalid @enderror" type="text">--}}
{{--                        @error('delivery_fee.store_id')--}}
{{--                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                        @enderror--}}

{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("value")}}</label>
                        <input wire:model.defer="delivery_fee.value" placeholder="{{__("value")}}"

                               class="form-control @error('delivery_fee.value') is-invalid @enderror" type="number">
                        @error('delivery_fee.value')
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
