<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form  class="theme-form login-form"  wire:submit.prevent="login" method="post" >
                        @csrf
                        <div class="text-center mb-3">
                            <img style="background: #24695c;padding: 10px;border-radius: 5px;" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : '' }}" class="img-circle " width="50%">
                        </div>
                        <div class="form-group">
                            <label>{{__('Email')}}</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control @error('email') is-invalid @enderror " type="email" wire:model="email" placeholder="{{__('Email')}}" required >
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label>{{__('Password')}}</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control @error('password') is-invalid @enderror " type="password" name="password" wire:model="password" placeholder="{{__('Password')}}" required >
                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input  type="checkbox" id="remember" name="remember" wire:model="remember">
                                <label for="remember"> {{__('Remember')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{__('Sign in')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
