<div class="container">
    <div class="d-flex vh-100 align-items-center flex-column">
        <div class="row w-100 py-3">
            <div class="col-md-6">
                <div class="mx-auto p-md-3">
                <h3 class="fw-bold title-signIn position-relative d-inline-block"> {{__('Create Account')}}</h3>
                <p class="fw-bold"> {{__('Do You Have Account?')}}<a class="nav-link d-inline-block text-primary" href="sign-in.html">{{__('Login')}}</a> </p>
                 <form wire:submit.prevent="register" method="post" class="mb-3 px-md-0 px-3">
                 @csrf
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="name-o"> {{__("Full Name")}} </label>
                       <input type="text" wire:model.defer="user.name" class="form-control @error('user.name') is-invalid @enderror form-control-lg fs-6" id="name-o" placeholder=' {{__("Full Name")}}'>
                       @error('user.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                     <div class="form-group mb-2">
                         <label class="text-dark mb-2" for="phone-o"> {{__('Mobile Number')}} </label>
                         <input type="text" wire:model.defer="user.mobile" class="form-control @error('user.mobile') is-invalid @enderror form-control-lg fs-6" id="phone-o" placeholder="{{__('Mobile Number')}}">
                         @error('user.mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                     </div>
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="EMail-Or-Number"> {{__("Email")}} </label>
                       <input type="email" wire:model.defer="user.email" class="form-control @error('user.email') is-invalid @enderror form-control-lg fs-6 text-start" id="EMail-Or-Number" placeholder='{{__("Email")}}'>
                       @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="confirm-Password">{{__("Password")}}</label>
                       <input type="password" wire:model.defer="user.password" class="form-control @error('user.password') is-invalid @enderror form-control-lg fs-6" id="confirm-Password" placeholder='{{__("Password")}}'>
                       @error('user.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                     <div class="form-group mb-2">
                       <label class="text-dark mb-2" for="Password">{{__("Confirm Password")}}</label>
                       <input type="password" wire:model.defer="user.password_confirmation" class="form-control @error('user.password_confirmation') is-invalid @enderror form-control-lg fs-6" id="Password" placeholder='{{__("Confirm Password")}}'>
                       @error('user.password_confirmation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                     </div>
                        <div class="form-inline pointer mt-3">
                           <input type="checkbox" class="form-check-input pointer" id="email-check">
                           <label class="form-check-label ps-2 pointer" for="email-check">تلقي تحديثات البريد الإلكتروني</label>
                        </div>

                     @if ($errors->any())
                         <div class="alert alert-danger">
                             <ul>
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif

                     <div class="text-end">
                           <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-block"> {{__("Sign up")}} </button>
                     </div>
                    </form>
                    <p class="or-o text-center position-relative"><span class="bg-white px-3">او</span> </p>
                    <div class="">
                        <a href="/auth/facebook/redirect" class="btn btn-primary btn-block w-100 py-2 mb-3"> {{__('Create an Account With Facebook')}}<i class="fa-brands fa-facebook fs-5 ps-2 text-white"></i></a>
                        <a href="/auth/google/redirect" class="btn btn-block border w-100 py-2 mb-3"> {{__('Create an Account with Google')}} <img width="25" src="{{asset('fedi/img/google.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 bg-signIn" style="background-image: url('fedi/img/img-9.png')">
                </div>
            </div>
        </div>
    </div>
</div>


