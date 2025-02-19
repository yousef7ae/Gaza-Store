<div class="overlay rounded-lg overflow-hidden mb-3">
    <img class="w-100 img-apartment" src="{{$page ? $page['image'] : asset('Dukkan/images/apartment.png') }}" alt="">
    <div class="carousel-caption d-flex h-100 w-100 left-0 top-0 justify-content-start align-items-center">
        <div class="row w-100 justify-content-center align-items-center no-gutters">
            <div class="col-md-6 mb-3">
                <h4 class="font-weight-bold"> {{$page ? $page->title_lang : ""}}
                    <br> {{$page ? $page->description_lang : ""}} </h4>
            </div>
            <div class="col-md-6 mb-3">
                <form class="row no-gutters px-3" method="post" wire:submit.prevent="store">
                    <div class="col-9 mx-auto px-2">
                        <label class="sr-only" for="Subscribe">  {{__("Email address")}}</label>
                        <input type="email" wire:model.defer="user.email"
                               class="form-control @error('user.email') is-invalid @enderror rounded-pill mr-3"
                               id="Subscribe" placeholder="{{__("Enter Your Email")}}">
                        @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin text-danger"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <button type="submit" wire:loading.attr="disabled"
                                class="btn btn-danger rounded-pill">{{__("Subscribe")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
