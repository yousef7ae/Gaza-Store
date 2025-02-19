<div class="row no-gutters align-items-center login">
    <div class="col-sm-12 order-sm-2 order-1 h-100 text-left">
        <div class="mx-auto p-3 max-w-650p">
            <form class="mb-3 px-md-0 px-3" wire:submit.prevent="select_country">

                <div class="row">
                    <h6 class="text-secondary">{{$page ? $page->title_lang : ""}}</h6>
                    <p>
                        {{$page ? $page->description_lang : ""}}
                    </p>
                    <div class="form-group mb-3 col-6">
                        <label class="mb-3 text-secondary" for="Country">{{ __('Select Country') }}</label>
                        <select wire:model="user.country_id"
                                class="form-control @error('user.country_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                            <option value="0">{{__('Select Country')}}...</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <img width="32" class="mt-n5 pt-3 ml-1 position-absolute"
                             src="{{asset('assets/flags/'.$user_country_code.'.png')}}" alt="">
                        @error('user.country_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-3 col-6">
                        <label class="text-secondary" for="City">{{ __('Select City') }}</label>
                        <select wire:model="user.city_id"
                                class="form-control @error('user.city_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                            <option value="0">{{__('Select City')}}...</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('user.city_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                </div>


                <div>
                    <div wire:loading>
                        <i class="fas fa-sync fa-spin text-secondary"></i>
                        {{__("Loading please wait")}} ...
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                        class="btn btn-danger font-weight-bold btn-block">{{__('Ok')}}</button>

            </form>

        </div>
    </div>
</div>



