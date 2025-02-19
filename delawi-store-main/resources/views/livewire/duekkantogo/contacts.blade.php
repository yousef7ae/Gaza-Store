<main>
    <div class="">
        <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
            <img class="w-100" src="{{$page ? $page['image'] : asset('Dukkan/images/bg-contacts.png') }} " alt="">
            <div
                class="carousel-caption d-flex pb-0 h-100 justify-content-start align-items-sm-center align-items-end w-100 left-0">
                <div class="container text-left">
                    <h1 class="font-weight-bold">{{$page ? $page->title_lang : ""}}</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="filter max-w-950p mb-4">
                <div class="rounded-top-right bg-light p-3">
                    <p class="p-3">{{$page ? $page->description_lang : ""}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form method="post" wire:submit.prevent="store" class="mb-3 px-md-0 px-3">
                        <div class="form-group mb-4">
                            <label class="text-secondary" for="full-name">{{__("Full Name")}}</label>
                            <input type="text" wire:model.defer="contact.name"
                                   class="form-control @error('contact.name') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="full-name" placeholder="{{__("Full Name")}}">
                            @error('contact.name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-secondary" for="exampleInputEmail1">{{__("Email")}}</label>
                            <input type="email" wire:model.defer="contact.email"
                                   class="form-control @error('contact.email') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__("Email")}}">
                            <small id="emailHelp" class="form-text text-muted sr-only-focusable"></small>
                            @error('contact.email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-secondary" for="Title">{{__("Title")}}</label>
                            <input type="text" wire:model.defer="contact.subject"
                                   class="form-control @error('contact.subject') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                   id="Title" placeholder="{{__("Title")}}">
                            @error('contact.subject')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-secondary" for="textarea-d">{{__("Message")}}</label>
                            <textarea rows="6" wire:model.defer="contact.message"
                                      class="form-control @error('contact.message') is-invalid @enderror form-control-lg border-0 shadow-sm"
                                      id="textarea-d" placeholder="{{__("Write Here Message")}}"></textarea>
                            @error('contact.message')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">{{__("Send")}}</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="rounded-bottom-right overflow-hidden">
                        <iframe src="{!! ($setting = \App\Models\Setting::where('name',"url_map")->first()) ? $setting->value : '' !!}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <a href="tel:{{($setting = \App\Models\Setting::where('name',"phone")->first()) ? $setting->value : __("#")}}"
                               class="nav-item nav-link px-2 text-dark d-flex align-items-center "><i
                                    class="fas fa-phone-volume fs-25p pr-3 text-secondary"></i> {{($setting = \App\Models\Setting::where('name',"phone")->first()) ? $setting->value : __("Empty")}}
                            </a>
                            <a href="#" class="nav-item nav-link px-2 text-dark d-flex align-items-center "><i
                                    class="fas fa-map-marker-alt fs-25p pr-3 text-secondary"></i> {{($setting = \App\Models\Setting::where('name',"address")->first()) ? $setting->value : __("Empty")}}
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="mailto:{{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : __("#")}}"
                               class="nav-item nav-link px-2 text-dark d-flex align-items-center "><i
                                    class="far fa-envelope fs-25p pr-3 text-secondary"></i> {{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : __("Empty")}}
                            </a>
                            <a href="{{($setting = \App\Models\Setting::where('name',"url_whatsapp")->first()) ? $setting->value : '#'}}"
                               target="_blank" class="nav-item nav-link px-2 text-dark d-flex align-items-center "><i
                                    class="fab fa-whatsapp fs-25p pr-3 text-secondary"></i> {{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}
                            </a>
                        </div>
                        <div class="col-12">
                            <p>
                                <a class="nav-link d-inline-block px-2"
                                   href="{{($setting = \App\Models\Setting::where('name',"url_facebook")->first()) ? $setting->value : '#'}}"
                                   target="_blank">
                                    <i class="fab fa-facebook-f fs-25p text-secondary"></i>
                                </a>
                                <a class="nav-link d-inline-block px-2"
                                   href="{{($setting = \App\Models\Setting::where('name',"url_instagram")->first()) ? $setting->value : '#'}}"
                                   target="_blank">
                                    <i class="fab fa-instagram fs-25p text-secondary"></i>
                                </a>
                                <a class="nav-link d-inline-block px-2"
                                   href="{{($setting = \App\Models\Setting::where('name',"url_twitter")->first()) ? $setting->value : '#'}}"
                                   target="_blank">
                                    <i class="fab fa-twitter fs-25p text-secondary"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
