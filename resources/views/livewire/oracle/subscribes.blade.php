<div class="wrap-footer-item footer-item-second">
    <h3 class="item-header">Sign up for newsletter</h3>
    <div class="item-content">
        <div class="wrap-newletter-footer">
            <form method="post" wire:submit.prevent="store" class="frm-newletter" id="frm-newletter">
                <input wire:model.lazy="email" placeholder="{{__("Add Email")}}"

                       class="form-control @error('email') is-invalid @enderror" type="text">
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <button class="btn-submit" style="padding: 6px;" type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</div>
