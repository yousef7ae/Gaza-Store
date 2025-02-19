<div>
<h6 class="fw-bold text-dark mb-4">اشترك في صحيفتنا الإخبارية <br>اشترك معنا في القائمة البريدية ليصلك كل جديد</h6>
<form class="d-flex position-relative" method="post" wire:submit.prevent="store">
    <div class="input-group mb-3">
        <input type="email" wire:model.defer="user.email" class="form-control @error('user.email') is-invalid @enderror form-control-lg text-start bg-light" placeholder="{{__('Email')}}">
        @error('user.email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        <button class="input-group-text btn-group-lg px-4 btn-primary" type="submit" wire:loading.attr="disabled">{{__('Subscription')}}</button>
    </div>
</form>
</div>



