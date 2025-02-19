<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    @include('livewire.admin.alert')

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <select class="form-control" wire:model="currency_id">
                    <option value="{{$currencyDefault->id}}">{{$currencyDefault->name}}</option>
                    @foreach($currencies as $currency)
                        <option value="{{$currency->id}}">{{$currency->name}} ({{$currency->code}})</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>

    <button wire:loading.attr="disabled" class="btn btn-info" type="submit">{{__("Update")}}</button>
</form>

