<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Store")}}</label>
                        <select wire:model="arrest_receipt.store_id"
                                class="form-control @error('arrest_receipt.store_id') is-invalid @enderror" type="text">
                            <option value="">{{__("Select")}}</option>
                            @foreach($stores as $store)
                                <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                        @error('arrest_receipt.store_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Amount")}}</label>
                        <input wire:model.defer="arrest_receipt.amount"
                               placeholder="{{__("Amount")}}"
                               name="amount"
                               class="form-control @error('arrest_receipt.amount') is-invalid @enderror"
                               type="text">
                        @error('arrest_receipt.amount')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">{{__("Date")}}</label>
                    <input value="" wire:model.defer="arrest_receipt.date"
                           class="form-control @error('arrest_receipt.date') is-invalid @enderror"
                           type="date">

                    @error('arrest_receipt.date')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <label>
                    {{__("Note")}}
                    <textarea class="form-control" wire:model.defer="arrest_receipt.note"></textarea>
                </label>


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
                type="submit">{{__("Save")}}</button>
    </div>
</form>
