<footer class="pt-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-md-start text-center">
                    <div class="py-3">
                        <a href="{{route('home')}}">
                            <img class="img-fluid mb-3" width="100" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('fedi/img/logo.png')}}" alt="footer">
                        </a>
                        <div class="text-md-start text-center">
                            <a class="nav-link text-primary fw-bold pb-0" href="tel:{{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}">  {{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}+ <i class="fa-solid fa-phone ps-2"></i> </a>
                            <a class="nav-link text-primary fw-bold mb-3" href="mailto:{{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : __("Empty")}}">  {{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : __("Empty")}} <i class="fa-regular fa-envelope"></i> </a>
                            <ul class="nav justify-content-md-start justify-content-center social">
                                <li class="nav-item">
                                    <a class="nav-link mx-2 rounded-circle" href="{{($setting = \App\Models\Setting::where('name',"url_instagram")->first()) ? $setting->value : '#'}}" target="_blank"> <i class="fa-brands text-white fa-instagram"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-2 rounded-circle" href="{{($setting = \App\Models\Setting::where('name',"url_whatsapp")->first()) ? $setting->value : '#'}}" target="_blank"> <i class="fa-brands text-white fa-whatsapp"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-2 rounded-circle" href="{{($setting = \App\Models\Setting::where('name',"url_twitter")->first()) ? $setting->value : '#'}}" target="_blank"> <i class="fa-brands text-white fa-twitter"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-2 rounded-circle" href="{{($setting = \App\Models\Setting::where('name',"url_facebook")->first()) ? $setting->value : '#'}}" target="_blank"> <i class="fa-brands text-white fa-facebook-f"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="py-3">
                        <h5 class="fw-bold ps-3 text-dark">{{__('Sections')}}</h5>
                        <ul class="nav list flex-column">
                        @if($sections and $sections->submenus)
                            @foreach($sections->submenus as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link fw-bold mx-2 rounded-circle" href="{{$submenu['url'][app()->getLocale()]}}"><i class="fa-solid fa-angle-right pe-2"></i> {{$submenu['name'][app()->getLocale()]}}</a>
                                </li>
                            @endforeach
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    @livewire('site.subscribe-newsletter')
                    <!-- <h6 class="fw-bold text-dark mb-4">اشترك في صحيفتنا الإخبارية <br>اشترك معنا في القائمة البريدية ليصلك كل جديد</h6>
                    <form method="post" wire:submit.prevent="store" class="d-flex position-relative">
                        <div class="input-group mb-3">
                            <input type="email" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror form-control-lg text-start bg-light" placeholder="ادخال البريد الالكتروني">
                            <button class="input-group-text btn-group-lg px-4 btn-primary" type="submit">{{__('Subscription')}}</button>
                        </div>
                    </form> -->
                </div>

            </div>
        </div>
        <div class="border-top py-3">
            <p class="text-center text-primary fw-bold mb-0"> {{date("Y")}} {{__('All rights reserved to Oracle Media Store')}} </p>
        </div>
    </footer>


