
<main>
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('Personal Information')}}</li>
            </ol>
        </nav>
    </div>
    <img class="img-fluid w-100" src="{{$page ? $page['image'] : asset('fedi/img/img-11.jpg') }}" style="max-height: 460px" alt="">
    <div class="container Privacy">
        <div class="row">
            <aside class="col-lg-4 mb-4">
                <div class="card border-0 bg-light rounded-3">
                    <div class="text-center py-3">
                        @livewire('site.profile.avatar')
                    </div>
                    @livewire('site.profile.sidebar')

                </div>
            </aside>
            <div class="col-lg-8 mb-4">
                <form wire:submit.prevent="update">
                    <div class="card card-body border-0 bg-light rounded-3">
                        <h1 class="h4 mt-2 mb-4">عرض البيانات الشخصية </h1>
                        <div class="row px-3">
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="name">{{__("Full Name")}}</label>
                                <input type="text" wire:model.defer="user.name" class="form-control @error('user.name') is-invalid @enderror py-3 rounded-2" id="name" placeholder="{{__("Full Name")}}">
                                @error('user.name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="email">{{__("E-Mail")}} </label>
                                <input type="email" wire:model.defer="user.email" class="form-control @error('user.email') is-invalid @enderror py-3 rounded-2" id="email" placeholder="{{__("E-Mail")}}">
                                @error('user.email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="state1">{{ __('Select Country') }} </label>
                                <select type="text" wire:model="user.country_id" class="form-control py-3 rounded-2" id="state1">
                                    <option value="0">{{__('Select Country ')}}...</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('user.country_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="state2"> {{ __('Select City') }} </label>
                                <select wire:model="user.city_id" type="text" class="form-control @error('user.city_id') is-invalid @enderror py-3 rounded-2" id="state2" placeholder="رام الله ">
                                    <option value="0">{{__('Select City')}}...</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('user.city_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="state3">{{__("Street / Building No.")}} </label>
                                <input type="text" wire:model.defer="user.address" class="form-control  @error('user.address') is-invalid @enderror py-3 rounded-2" id="state3" placeholder="{{__("Street / Building No.")}}">
                                @error('user.address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="pin">{{__("Postal Code")}}</label>
                                <input type="text" wire:model.defer="user.postal_code" class="form-control @error('user.postal_code') is-invalid @enderror py-3 rounded-2" id="pin" placeholder="{{__("Postal Code")}}">
                                @error('user.postal_code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-6 mb-4">
                                <label class="text-dark mb-2" for="phone"> {{__("Mobile Number")}} </label>
                                <input wire:model.defer="user.mobile" type="text" class="form-control @error('user.mobile') is-invalid @enderror py-3 rounded-2" id="phone" placeholder="{{__("Mobile Number")}}">
                                @error('user.mobile')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
{{--                            <div class="form-group col-6 mb-4">--}}
{{--                                <label class="text-dark mb-2" for="passowrd1">كلمة السر   </label>--}}
{{--                                <input type="password" class="form-control py-3 rounded-2" id="passowrd1" placeholder="********">--}}
{{--                            </div>--}}

                            <div class="text-center">
                                <button wire:loading.attr="disabled" type="submit" class="btn btn-primary py-2 w-25 ">{{__("Edit profile")}} </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="py-md-5 mt-md-5"></div>
</main>




{{--<main class="mt-4 pt-2 Privacy">--}}
{{--    <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">--}}
{{--        <img class="w-100" src="{{$page ? $page['image'] : asset('Dukkan/images/bg-Profile.png') }}" alt="">--}}
{{--        <div--}}
{{--            class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">--}}
{{--            <div class="container text-left">--}}
{{--                <h1 class="font-weight-bold">{{$page ? $page->title_lang : ""}}</h1>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="container">--}}
{{--        <div class="filter max-w-950p mb-4">--}}
{{--            <div class="rounded-top-right bg-light p-3">--}}
{{--                <p class="p-3">{{$page ? $page->description_lang : ""}}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}

{{--            <!-- sidebar -->--}}
{{--            @livewire('site.profile.sidebar')--}}

{{--            <div class="col-lg-8">--}}
{{--                <form wire:submit.prevent="update">--}}
{{--                    <img class="img-fluid gray" src="{{asset('Dukkan/images/Grid-1.png')}}" alt="">--}}
{{--                    <div class="clearfix">--}}
{{--                        <div class="media ml-sm-5 ml-3">--}}
{{--                            @livewire('site.profile.avatar')--}}

{{--                            <div class="media-body  pt-3">--}}
{{--                                <h5 class="mb-0 text-danger">{{auth()->user()->name}}</h5>--}}
{{--                                <p>{{auth()->user()->country?auth()->user()->country->name : __("Empty")}}--}}
{{--                                    - {{auth()->user()->city?auth()->user()->city->name : __("Empty")}}--}}
{{--                                    - {{auth()->user()->address}} </p>--}}
{{--                            </div>--}}
{{--                            <button wire:loading.attr="disabled" type="submit"--}}
{{--                                    class="btn btn-outline-danger text-uppercase float-right">{{__("Edit profile")}}</button>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <div wire:loading>--}}
{{--                                <i class="fas fa-sync fa-spin"></i>--}}
{{--                                {{__("Loading")}} ...--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    </div>--}}
{{--                    <div class="row mt-3">--}}
{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="text-danger" for="full-name">{{__("Full Name")}}</label>--}}
{{--                            <input type="text" wire:model.defer="user.name"--}}
{{--                                   class="form-control @error('user.name') is-invalid @enderror form-control-lg border-0 shadow-sm"--}}
{{--                                   id="full-name" placeholder="{{__("Full Name")}}">--}}
{{--                            @error('user.name')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="text-danger" for="exampleInputEmail1">{{__("E-Mail")}}</label>--}}
{{--                            <input type="email" wire:model.defer="user.email"--}}
{{--                                   class="form-control @error('user.email') is-invalid @enderror form-control-lg border-0 shadow-sm"--}}
{{--                                   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__("E-Mail")}}">--}}
{{--                            <small id="emailHelp" class="form-text text-muted sr-only-focusable"></small>--}}
{{--                            @error('user.email')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="mb-3 text-danger" for="Country">{{ __('Select Country') }}</label>--}}
{{--                            <select wire:model="user.country_id"--}}
{{--                                    class="form-control @error('user.country_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">--}}
{{--                                <option value="0">{{__('Select Country ')}}...</option>--}}
{{--                                @foreach($countries as $country)--}}
{{--                                    <option value="{{$country->id}}">{{ $country->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('user.country_id')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                            <img width="32" class="mt-n5 pt-3 ml-1 position-absolute"--}}
{{--                                 src="{{asset('assets/flags/'.$user_country_code.'.svg')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="text-danger" for="City">{{ __('Select City') }}</label>--}}
{{--                            <select wire:model="user.city_id"--}}
{{--                                    class="form-control @error('user.city_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">--}}
{{--                                <option value="0">{{__('Select City')}}...</option>--}}
{{--                                @foreach($cities as $city)--}}
{{--                                    <option value="{{$city->id}}">{{ $city->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('user.city_id')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="text-danger" for="Street">{{__("Street / Building No.")}}</label>--}}
{{--                            <input type="text" wire:model.defer="user.address"--}}
{{--                                   class="form-control @error('user.address') is-invalid @enderror form-control-lg border-0 shadow-sm"--}}
{{--                                   id="Street" placeholder="{{__("Street / Building No.")}}">--}}
{{--                            @error('user.address')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 col-6">--}}
{{--                            <label class="text-danger" for="Postal-Code">{{__("Postal Code")}}</label>--}}
{{--                            <input type="text" wire:model.defer="user.postal_code"--}}
{{--                                   class="form-control  @error('user.postal_code') is-invalid @enderror form-control-lg border-0 shadow-sm"--}}
{{--                                   id="Postal-Code" placeholder="{{__("Postal Code")}}">--}}
{{--                            @error('user.postal_code')--}}
{{--                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 col-12">--}}
{{--                            <label class="mb-3 text-danger" for="Mobile-Number">{{__("Mobile Number")}}</label>--}}
{{--                            <div class="row shadow-sm rounded no-gutters overflow-hidden">--}}
{{--                                <select wire:model="user.country_id"--}}
{{--                                        class="form-control rounded-0 border-0 col-sm-3 col-4 form-control-lg pl-5">--}}
{{--                                    @foreach($countries as $country)--}}
{{--                                        <option value="{{$country->id}}">{{ $country->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <img width="32" class="mt-1 pt-2 ml-1 position-absolute"--}}
{{--                                     src="{{asset('assets/flags/'.$mobile_country_code.'.svg')}}" alt="">--}}
{{--                                <input type="text" wire:model.defer="user.mobile"--}}
{{--                                       class="form-control @error('user.mobile') is-invalid @enderror col px-2 rounded-0 form-control-lg border-0 shadow-sm"--}}
{{--                                       id="Mobile-Number" placeholder="{{__("Mobile Number")}}">--}}
{{--                                @error('user.mobile')--}}
{{--                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</main>--}}
