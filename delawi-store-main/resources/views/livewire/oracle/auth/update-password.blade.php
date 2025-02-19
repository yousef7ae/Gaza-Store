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
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8  h-100 ">
        <div class="mx-auto p-3 max-w-650p">
            <h3 class="text-danger">{{$page ? $page->title_lang : ""}}</h3>
            <p>{{$page ? $page->description_lang : ""}}</p>
            <form class="mb-3 px-md-0 px-3" wire:submit.prevent="updatePassword" method="post">
                @csrf

                <div class="form-group mb-3">
                    <label class="text-danger" for="Password">Password</label>
                    <input type="password" wire:model.defer="password"
                           class="form-control @error('password') is-invalid @enderror border-0 shadow-sm" id="Password"
                           placeholder="*******">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="text-danger" for="Confirm-Password">Confirm Password</label>
                    <input type="password" wire:model.defer="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror border-0 shadow-sm"
                           id="Confirm-Password" placeholder="*******">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div>
                    <div wire:loading>
                        <i class="fas fa-sync fa-spin text-danger"></i>
                        {{__("Loading please wait")}} ...
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                        class="btn btn-danger font-weight-bold btn-block">{{__('Send')}}</button>

            </form>
        </div>
    </div>
</div>
