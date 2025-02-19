<div class="row no-gutters align-items-center login">
    <div class="col-sm-4">
        <div class="d-flex align-items-center emad vh-100 justify-content-center overlay overflow-hidden mt-5">

            <form wire:submit.prevent="resetPassword" method="post">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">{{__('Email')}}</label>
                    <input type="email" wire:model="email" id="form2Example1" class="form-control @error('email') is-invalid @enderror form-control-lg border-0 shadow-sm" placeholder="E-Mail" />
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                 <div wire:loading>
                        <i class="fas fa-sync fa-spin text-danger"></i>
                        {{__("Loading please wait")}} ...
                 </div>
                <!-- Submit button -->
                <button type="submit" wire:loading.attr="disabled" class="btn btn-danger font-weight-bold btn-block">{{__('Send')}}</button>

            </form>

        </div>
    </div>
</div>



