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
            <h3 class="text-secondary">{{$page ? $page->title_lang : ""}}</h3>
            <p>{{$page ? $page->description_lang : ""}}</p>
            <form class="mb-3 px-md-0 px-3" wire:submit.prevent="resetPassword" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label class="text-secondary" for="EMail-Or-Number">{{__('E-Mail Or Mobile Number')}}</label>
                    <input type="email" wire:model.defer="email"
                           class="form-control @error('email') is-invalid @enderror form-control-lg border-0 shadow-sm"
                           id="EMail-Or-Number" placeholder="E-Mail">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <div wire:loading>
                        <i class="fas fa-sync fa-spin text-secondary"></i>
                        {{__("Loading please wait")}} ...
                    </div>
                </div>
                <button type="submit" wire:loading.attr="disabled"
                        class="btn btn-danger font-weight-bold btn-block">{{__('Send')}}</button>

            </form>
        </div>
    </div>
</div>
