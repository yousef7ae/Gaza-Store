<div class="row no-gutters align-items-center login">
    <div class="col-sm-4">
        <div
            class="d-flex align-items-center emad bg-Forget-Password vh-100 justify-content-center overlay overflow-hidden">
            <div
                class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
                <div class="container">
                    <img width="90" class="mb-sm-5"
                         src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}"
                         alt="">
                    <nav class="nav flex-column mx-auto" style="max-width: 70%;">
                        <p class="nav-link mb-1 text-left">{{__("Register via")}} ...</p>
                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white"
                           href="/auth/google/redirect"><i class="fab fa-google-plus-g"></i> Google</a>
                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white"
                           href="/auth/facebook/redirect"><i class="fab fa-facebook-f"></i> Facebook</a>
                        {{--                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white" href="#"><i class="fab fa-twitter"></i>  Twitter</a>--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8  h-100 ">
        <div class="mx-auto px-3 py-1 max-w-650p py-3">
            <h3 class="text-danger">{{$page ? $page->title_lang : ""}}</h3>
            <p class="mb-0">{{$page ? $page->description_lang : ""}}</p>
            <form wire:submit.prevent="register" method="post">
                @csrf
                <div class="row">
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="full-name">{{__("Full Name")}}</label>
                        <input type="text" wire:model.defer="user.name"
                               class="form-control  @error('user.name') is-invalid @enderror border-0 shadow-sm"
                               id="full-name" placeholder="{{__("Full Name")}}">
                        @error('user.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="exampleInputEmail1">{{__("Email")}}</label>
                        <input type="email" wire:model.defer="user.email"
                               class="form-control @error('user.email') is-invalid @enderror border-0 shadow-sm"
                               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@example.com">
                        <small id="emailHelp" class="form-text text-muted sr-only-focusable"></small>
                        @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="Country">{{ __('Select Country') }}</label>
                        <select wire:model="user.country_id"
                                class="form-control @error('user.country_id') is-invalid @enderror rounded-0 border-0 col-sm-12 col-12 pl-5">
                            <option value="0">{{__('Select Country ')}}...</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <img width="32" class="mt-n5 pt-3 ml-1 position-absolute"
                             src="{{asset('assets/flags/'.$user_country_code.'.svg')}}" alt="">
                        @error('user.country_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="City">{{ __('Select City') }}</label>
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
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="Street">{{__("Address")}}</label>
                        <input type="text" wire:model.defer="user.address"
                               class="form-control @error('user.address') is-invalid @enderror border-0 shadow-sm"
                               id="Street" placeholder="">
                        @error('user.address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="Postal-Code">{{__("Postal Code")}}</label>
                        <input type="text" wire:model.defer="user.postal_code"
                               class="form-control @error('user.postal_code') is-invalid @enderror border-0 shadow-sm"
                               id="Postal-Code" placeholder="G-0000">
                        @error('user.postal_code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="Mobile-Number">{{__("Mobile Number")}}</label>
                        <div class="row shadow-sm rounded no-gutters overflow-hidden">
                            <select wire:model="user.country_id"
                                    class="form-control rounded-0 border-0 col-sm-5 col-4 pl-5">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <img width="32" class="mt-1 pt-2 ml-1 position-absolute"
                                 src="{{asset('assets/flags/'.$user_country_code.'.svg')}}" alt="">
                            <input type="text" wire:model.defer="user.mobile"
                                   class="form-control @error('user.mobile') is-invalid @enderror col px-2 rounded-0 border-0 shadow-sm"
                                   id="Mobile-Number" placeholder="597   5848   515">
                            @error('user.mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-1 col-6">
                        <label class="text-danger" for="Password">{{__("Password")}}</label>
                        <input type="password" wire:model.defer="user.password"
                               class="form-control @error('user.password') is-invalid @enderror border-0 shadow-sm"
                               id="Password" placeholder="*******">
                        @error('user.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-12">
                        <label class="text-danger" for="Confirm-Password">{{__("Confirm Password")}}</label>
                        <input type="password" wire:model.defer="user.password_confirmation"
                               class="form-control @error('user.password_confirmation') is-invalid @enderror border-0 shadow-sm"
                               id="Confirm-Password" placeholder="*******">
                        @error('user.password_confirmation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-1 col-12">
                        <div class="form-inline pl-sm-0 pl-4 my-2">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">{{__("Attach to all")}}</label>
                            <a class="text-danger font-weight-bold mx-2" data-toggle="modal" data-target="#conditions"
                               href="#">{{__("Terms & Conditions")}}</a>
                        </div>
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin text-danger"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        <button type="submit" wire:loading.attr="disabled"
                                class="btn btn-danger btn-block">{{__("Sign up")}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--  Modal  -->
    <div wire:ignore.self class="modal fade " dat id="conditions" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center"
                        id="exampleModalLongTitle">{{ __('Terms & Conditions') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{__("Loading please wait")}} ...
                        </div>
                    </div>
                    @livewire('site.auth.terms-and-conditions')
                </div>
            </div>
        </div>
    </div>
    <!--  Modal  -->

</div>



