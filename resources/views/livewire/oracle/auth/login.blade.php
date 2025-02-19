<div class="row no-gutters align-items-center login">
    <div class="col-sm-4">
        <div class="d-flex align-items-center emad vh-100 justify-content-center overlay overflow-hidden">
            <div
                class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
                <div class="container">
                    <img width="90" class="mb-sm-5"
                         src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}"
                         alt="">
                    <nav class="nav flex-column mx-auto" style="max-width: 70%;">
                        <p class="nav-link mb-1 text-left">{{__("Register via")}} ...</p>
                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white"
                           href="/auth/google/redirect"><i
                                class="fab fa-google-plus-g"></i> Google</a>
                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white"
                           href="/auth/facebook/redirect"><i
                                class="fab fa-facebook-f"></i> Facebook</a>
                        {{--                        <a class="nav-link fs-25p border-white btn btn-outline-danger mb-sm-3 mb-1 text-white" href="#"><i--}}
                        {{--                                class="fab fa-twitter"></i> Twitter</a>--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8  h-100 ">
        <div class="mx-auto p-3 max-w-650p">
            <h3 class="text-danger">{{$page ? $page->title_lang : ""}}</h3>
            <p>{{$page ? $page->description_lang : ""}}</p>
            <form class="mb-3 px-md-0 px-3" wire:submit.prevent="login" method="post">
                @csrf
                <div class="form-group mb-2">
                    <label class="text-danger" for="EMail-Or-Number">{{__('Email')}}</label>
                    <input type="text" wire:model="email"
                           class="form-control @error('email') is-invalid @enderror form-control-lg border-0 shadow-sm"
                           id="EMail-Or-Number" placeholder="email@example.com">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label class="text-danger" for="Password">{{__('Password')}}</label>
                    <input type="password" wire:model="password"
                           class="form-control @error('password') is-invalid @enderror form-control-lg border-0 shadow-sm"
                           id="Password" placeholder="*******">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="clearfix mb-3">
                    <div class="form-inline pl-sm-0 pl-4 float-left">
                        <input type="checkbox" class="form-check-input" wire:model="remember" id="remember">
                        <label class="form-check-label">{{__('Remember')}}</label>
                    </div>

                    <a class="float-right text-dark" href="{{route('reset-password')}}"> {{__('Forget Password ?')}}</a>
                </div>
                <div>
                    <div wire:loading>
                        <i class="fas fa-sync fa-spin text-danger"></i>
                        {{__("Loading please wait")}} ...
                    </div>
                </div>
                <button type="submit" wire:loading.attr="disabled"
                        class="btn btn-danger btn-block">{{__('sign in')}}</button>

                <div class="form-inline pl-sm-0 pl-4 my-2 justify-content-center">
                    <label class="form-check-label p-3" for="exampleCheck1">{{__('Create a New Account')}} </label>
                    <a class="text-danger font-weight-bold" href="{{route('register')}}"> {{__('SIGN UP')}} </a>
                </div>
            </form>
        </div>
    </div>
</div>



