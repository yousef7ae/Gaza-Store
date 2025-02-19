<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    @include('livewire.admin.alert')

    <div class="row">
        <div class="col-md-12">


            <div class="row">
                @foreach($store->store_time_works as $store_time_work)
                    <div class="col-md-12">
                        <label><input type="checkbox" wire:model.lazy="store_time_works.{{$store_time_work->day}}.status"
                                      value="1">
                            <h3 class="d-inline">{{__($store_time_work->day)}}</h3></label>
                    </div>
                    @if(!empty($store_time_works) and !empty($store_time_works[$store_time_work->day]) and !empty($store_time_works[$store_time_work->day]['status']) and $store_time_works[$store_time_work->day]['status'])
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">{{__('From')}}</label>
                                <input class="form-control" type="time"
                                       wire:model.defer="store_time_works.{{$store_time_work->day}}.from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">{{__("To")}}</label>
                                <input class="form-control" type="time"
                                       wire:model.defer="store_time_works.{{$store_time_work->day}}.to">
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>

    <button wire:loading.attr="disabled" class="btn btn-info" wire:click="update" type="submit">{{__("Update")}}</button>
</form>

