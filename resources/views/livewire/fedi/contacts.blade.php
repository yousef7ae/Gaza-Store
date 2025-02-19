<section id="contact" class="contact py-5">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4">
            <div class="col-lg-6 col-sm-8 mx-auto">
                <h2 class="text-primary fw-bold">{{__('Connect with us')}}</h2>
                <p> {{$page ? $page['description']: "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص" }}</p>
                <form method="post" wire:submit.prevent="store">
                    <div class="mb-3">
                        <input type="text" wire:model.defer="contact.name" class="form-control @error('contact.name') is-invalid @enderror form-control-lg" placeholder="{{__("Full Name")}}" required>
                        @error('contact.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="email" wire:model.defer="contact.email" class="form-control @error('contact.email') is-invalid @enderror form-control-lg text-start" placeholder="{{__("Email")}}" required>
                        @error('contact.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" wire:model.defer="contact.subject" class="form-control @error('contact.subject') is-invalid @enderror form-control-lg text-start" placeholder="{{__("Title")}}" required>
                        @error('contact.subject')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea wire:model.defer="contact.message" class="form-control @error('contact.message') is-invalid @enderror" rows="6" placeholder="{{__("Message")}}" required></textarea>
                        @error('contact.message')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button class="btn btn-primary px-md-5 px-3" type="submit">{{__("Send")}}</button>
                </form>
            </div>
            <div class="col-md-6 px-4">
{{--                <div class="contact-img h-100" style="background-image: {{$page ? $page['image'] : url('fedi/img/img-7.png') }}"></div>--}}
                    <div class="contact-img h-100">
                        <img class="img-fluid mt-n2" src="{{$page ? $page['image'] : url('fedi/img/img-7.png') }}" alt="">
                    </div>
            </div>
        </div>
    </div>
</section>
