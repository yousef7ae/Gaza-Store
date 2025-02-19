<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="role.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('role.name') is-invalid @enderror" type="text">
                        @error('role.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="control-label">{{ __('Permissions') }}</label>
                    @foreach($allPermissions as  $key => $permissions)
                        <h2>{{__(ucwords($key))}}</h2>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <label><input type="checkbox" value="{{$permission['id']}}" wire:model="permissionsList.{{$permission['id']}}"/>{{$permission['name']}}</label>
                                </div>
                            @endforeach
                            <hr>
                        </div>
                    @endforeach
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
        <button wire:loading.attr="disabled" class="btn btn-info"
                type="submit">{{__("Update")}}</button>
    </div>
</form>


