<form class="mt-2 w-100" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("code")}}</label>
                        <input wire:model.defer="voucher.code" placeholder="{{__("code")}}"

                               class="form-control @error('voucher.code') is-invalid @enderror" type="text">
                        @error('voucher.code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("value")}}</label>
                        <input wire:model.defer="voucher.value" placeholder="{{__("value")}}"

                               class="form-control @error('voucher.value') is-invalid @enderror" type="number">
                        @error('voucher.value')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("type")}}</label>
                        <input wire:model.defer="voucher.type" placeholder="{{__("type")}}"

                               class="form-control @error('voucher.type') is-invalid @enderror" type="number">
                        @error('voucher.type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("count")}}</label>
                        <input wire:model.defer="voucher.count" placeholder="{{__("count")}}"

                               class="form-control @error('voucher.count') is-invalid @enderror" type="number">
                        @error('voucher.count')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("used")}}</label>
                        <input wire:model.defer="voucher.used" placeholder="{{__("used")}}"

                               class="form-control @error('voucher.used') is-invalid @enderror" type="text">
                        @error('voucher.used')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("expiration")}}</label>
                        <input value="" wire:model.defer="voucher.expiration"
                               class="form-control @error('voucher.expiration') is-invalid @enderror"
                               type="datetime-local">

                        @error('voucher.expiration')
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
                type="submit">{{__("Store")}}</button>
    </div>
</form>
