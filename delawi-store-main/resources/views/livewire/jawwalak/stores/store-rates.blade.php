<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            @include('livewire.admin.alert')

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{__("rate")}}</label>
                        <select wire:model.defer="store_rate.rate"
                                class="form-control form-control-sm @error('store_rate.rate') is-invalid @enderror">
                            <option value="0">{{__("Rate")}} ...</option>
                            @for ($i = 0; $i <= 5 ; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        @error('store_rate.rate')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Comment') }}</label>
                        <textarea rows="5" value="" wire:model.defer="store_rate.comment"
                                  placeholder="{{ __('Add Comment') }}"
                                  name="description"
                                  class="form-control @error('store_rate.comment') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('store_rate.comment')
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
        <button wire:loading.attr="disabled" class="btn btn-warning"
                type="submit">{{__("Store")}}</button>
    </div>
</form>





