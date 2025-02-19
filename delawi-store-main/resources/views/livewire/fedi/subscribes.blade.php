<section class="bg-light pb-5">
        <div class="container">
            <div class="col-md-7 mx-auto text-center">
                <h2 class=" fw-bold mb-2">اشترك للحصول على التحديثات اليومية</h2>
                <p class="mb-4">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص</p>
                <form method="post" wire:submit.prevent="store" class="d-flex position-relative">
                    <div class="input-group mb-3">
                        <input type="email" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror form-control-lg text-start bg-light" placeholder="ادخال البريد الالكتروني">
                        <button class="input-group-text btn-group-lg px-4 btn-primary" type="submit">{{__('Subscription')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>