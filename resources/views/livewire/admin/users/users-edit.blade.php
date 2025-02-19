<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card d-table p-1 m-auto">
                            @if($imageTemp)
                                <img width="150" class="img-fluid rounded"
                                     src="{{ $imageTemp->temporaryUrl() }}"
                                     data-holder-rendered="true">

                            @else
                                @if(!empty($user['image']))
                                    <img width="200" class="rounded-circle img-thumbnail"
                                         src="{{ $user['image'] }}"
                                         data-holder-rendered="true">
                                @endif
                            @endif
                        </div>

                        <div class="d-table p-1 m-auto uniform-uploader">
                            <input type="file" wire:model.defer="imageTemp"
                                   class="form-input-styled form-control submit2 @error('imageTemp ') is-invalid @enderror"
                                   data-fouc=""
                            >
                            <span class="filename">{{__("File Image")}}</span>
                            @error('imageTemp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Name")}}</label>
                        <input wire:model.defer="user.name" placeholder="{{__("Name")}}"
                               class="form-control @error('user.name') is-invalid @enderror" type="text">
                        @error('user.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Mobile")}}</label>
                        <input wire:model.defer="user.mobile" placeholder="{{__("Mobile")}}"

                               class="form-control @error('user.mobile') is-invalid @enderror" type="text">
                        @error('user.mobile')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Email")}}</label>
                        <input wire:model.defer="user.email" placeholder="{{__("Email")}}"

                               class="form-control @error('user.email') is-invalid @enderror" type="text">
                        @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("address")}}</label>
                        <input wire:model.defer="user.address" placeholder="{{__("address")}}"
                               class="form-control @error('user.address') is-invalid @enderror" type="text">
                        @error('user.address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Select Country') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('user.country_id') is-invalid @enderror"
                                wire:model="user.country_id">
                            <option value="0">{{__('Select Country ')}}...</option>
                            @foreach($countries as $country)
                                <option
                                    value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('user.country_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Select City') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('user.city_id') is-invalid @enderror"
                                wire:model="user.city_id">
                            <option value="0">{{__('Select City ')}}...</option>

                            @foreach($cities as $city)
                                <option
                                    value="{{$city->id}}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('user.city_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Postal Code")}}</label>
                        <input wire:model.defer="user.postal_code" placeholder="{{__("Postal Code")}}"
                               class="form-control @error('user.postal_code') is-invalid @enderror" type="text">
                        @error('user.postal_code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Password")}}</label>
                        <input value="" wire:model.defer="user.password" placeholder="{{__("Password")}}"

                               class="form-control @error('user.password') is-invalid @enderror" type="password">
                        @error('user.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Role")}}</label>
                        <select multiple wire:model.defer="user.role_id"
                                class="form-control @error('user.role_id') is-invalid @enderror">
                            <option value="">{{__("Select Role")}} ...</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('user.role_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Status")}}</label>
                        <select wire:model.defer="user.status"
                                class="form-control @error('user.status') is-invalid @enderror">
                            <option value="">{{__("Select Status")}} ...</option>
                            @foreach(\App\Models\User::statusList(false) as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('user.status')
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

    <button wire:loading.attr="disabled" class="btn btn-success" type="submit">{{__("Update")}}</button>
</form>
