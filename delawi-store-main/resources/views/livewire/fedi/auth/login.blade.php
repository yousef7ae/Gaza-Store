
<div class="container">
    <div class="d-flex pt-md-4 pt-2 align-items-center justify-content-center flex-column">
        <div class="row w-100">
            <div class="col-md-6">
                <div class="mx-auto p-md-3">
                <h3 class="fw-bold title-signIn position-relative d-inline-block"> تسجيل الدخول</h3>
                <p class="fw-bold">{{__('New user?')}}<a class="nav-link d-inline-block text-primary" href="{{route('register')}}"> {{__('Create a New Account')}} </a> </p>
                    <form wire:submit.prevent="login" method="post" class="mb-3 px-md-0 px-3">
                    @csrf
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="EMail-Or-Number"> {{__('Email')}} </label>
                       <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror form-control-lg fs-6" id="EMail-Or-Number" placeholder=" {{__('Email')}} ">
                       @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="Password"> {{__('Password')}} </label>
                       <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror form-control-lg fs-6" id="Password" placeholder=" {{__('Password')}}  ">
                       @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                     <div class="d-flex justify-content-between mb-3">
                           <div class="form-inline pl-sm-0 pl-4 pointer">
                           <input type="checkbox" class="form-check-input pointer" id="remember"  wire:model="remember" checked>
                             <label class="form-check-label pointer" for="exampleCheck1">{{__('Remember')}}</label>
                           </div>
                         <a class="text-dark" href="{{route('reset-password')}}"> {{__('Forget Password ?')}} </a>
                     </div>
                     <div class="text-end">
                           <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-block"> {{__('sign in')}} </button>
                     </div>
                    </form>
{{--                    <p class="or-o text-center position-relative"><span class="bg-white px-3">او</span> </p>--}}
{{--                    <div class="">--}}
{{--                        <a href="/auth/facebook/redirect" class="btn btn-primary btn-block w-100 py-2 mb-3"> دخول عن طريق الفيس بوك<i class="fa-brands fa-facebook fs-5 ps-2 text-white"></i></a>--}}
{{--                        <a href="/auth/google/redirect" class="btn btn-block border w-100 py-2 mb-3"> دخول عن طريق جوجل <img width="25" src="img/google.png" alt=""></a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 bg-signIn" style="background-image: url('fedi/img/img-sign-in.png')">
                </div>
            </div>
        </div>
    </div>
</div>




