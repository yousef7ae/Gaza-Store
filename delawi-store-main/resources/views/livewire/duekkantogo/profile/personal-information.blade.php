<main class="mt-4 pt-2 Privacy">
    <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
        <img class="w-100" src="{{$page ? $page['image'] : asset('Dukkan/images/bg-Profile.png') }}" alt="">
        <div
            class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
            <div class="container text-left">
                <h1 class="font-weight-bold">{{$page ? $page->title_lang : ""}}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="filter max-w-950p mb-4">
            <div class="rounded-top-right bg-light p-3">
                <p class="p-3">{{$page ? $page->description_lang : ""}}</p>
            </div>
        </div>
        <div class="row">

            <!-- sidebar -->
            @livewire('site.profile.sidebar')

            <div class="col-lg-8">
                <form wire:submit.prevent="update">
                    <img class="img-fluid gray" src="{{asset('Dukkan/images/Grid-1.png')}}" alt="">
                    <div class="clearfix">
                        <div class="media ml-sm-5 ml-3">
                            @livewire('site.profile.avatar')

                            <div class="media-body  pt-3">
                                <h5 class="mb-0 text-secondary">{{auth()->user()->name}}</h5>
                                <p>{{auth()->user()->country?auth()->user()->country->name : __("Empty")}}
                                    - {{auth()->user()->city?auth()->user()->city->name : __("Empty")}}
                                    - {{auth()->user()->address}} </p>
                            </div>
                            <button wire:loading.attr="disabled" type="submit"
                                    class="btn btn-outline-danger text-uppercase float-right">{{__("Edit profile")}}</button>
                        </div>

                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading")}} ...
                            </div>
                        </div>


                    </div>
                    <div class="row mt-3">
                        <div class="form-group mb-4 col-6">
                            <label class="text-secondary" for="full-name">{{__("Full Name")}}</label>
                            <input type="text" wire:model.defer="user.name"
                                   class="form-control @error('user.name') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="full-name" placeholder="{{__("Full Name")}}">
                            @error('user.name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 col-6">
                            <label class="text-secondary" for="exampleInputEmail1">{{__("E-Mail")}}</label>
                            <input type="email" wire:model.defer="user.email"
                                   class="form-control @error('user.email') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__("E-Mail")}}">
                            <small id="emailHelp" class="form-text text-muted sr-only-focusable"></small>
                            @error('user.email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-4 col-6">
                            <label class="mb-3 text-secondary" for="Country">{{ __('Select Country') }}</label>
                            <select wire:model="user.country_id"
                                    class="form-control @error('user.country_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                                <option value="0">{{__('Select Country ')}}...</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('user.country_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <img width="32" class="mt-n5 pt-3 ml-1 position-absolute"
                                 src="{{asset('assets/flags/'.$user_country_code.'.svg')}}" alt="">
                        </div>
                        <div class="form-group mb-4 col-6">
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
                        <div class="form-group mb-4 col-6">
                            <label class="text-secondary" for="Street">{{__("Street / Building No.")}}</label>
                            <input type="text" wire:model.defer="user.address"
                                   class="form-control @error('user.address') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="Street" placeholder="{{__("Street / Building No.")}}">
                            @error('user.address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 col-6">
                            <label class="text-secondary" for="Postal-Code">{{__("Postal Code")}}</label>
                            <input type="text" wire:model.defer="user.postal_code"
                                   class="form-control  @error('user.postal_code') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="Postal-Code" placeholder="{{__("Postal Code")}}">
                            @error('user.postal_code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 col-12">
                            <label class="mb-3 text-secondary" for="Mobile-Number">{{__("Mobile Number")}}</label>
                            <div class="row shadow-sm rounded no-gutters overflow-hidden">
                                <select wire:model="user.country_id"
                                        class="form-control rounded-0 border-0 col-sm-3 col-4 form-control-lg pl-5">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <img width="32" class="mt-1 pt-2 ml-1 position-absolute"
                                     src="{{asset('assets/flags/'.$mobile_country_code.'.svg')}}" alt="">
                                <input type="text" wire:model.defer="user.mobile"
                                       class="form-control @error('user.mobile') is-invalid @enderror col px-2 rounded-0 form-control-lg border-0 shadow-sm"
                                       id="Mobile-Number" placeholder="{{__("Mobile Number")}}">
                                @error('user.mobile')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</main>
