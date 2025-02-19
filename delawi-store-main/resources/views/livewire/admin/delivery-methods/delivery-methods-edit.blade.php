<form class="mt-2" method="post" wire:submit.prevent="update">
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
                            @if(!empty($payment_gateway['image']))
                                <img width="200" class="rounded-circle img-thumbnail"
                                     src="{{ $payment_gateway['image'] }}"
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

            <div class="form-group">
                <label class="control-label">{{ __('Name Payment Gateway') }}</label>
                <input value="" wire:model.defer="payment_gateway.name"
                       placeholder="{{ __('Add Name Payment Gateway') }}"
                       name="name"
                       class="form-control @error('payment_gateway.name') is-invalid @enderror" type="text">
                @error('payment_gateway.name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

            <div class="form-group">
                <label class="control-label">{{ __('Description') }}</label>
                <textarea value="" wire:model.defer="payment_gateway.description"
                          placeholder="{{ __('Add Description') }}"
                          name="description"
                          class="form-control @error('payment_gateway.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('payment_gateway.description')
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

