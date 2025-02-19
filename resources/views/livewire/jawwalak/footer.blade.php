<footer class="position-relative overflow-hidden">
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 text-sm-left text-center">
{{--                  <img class="mb-3" width="140" src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}" alt="" style="padding: 10px;border-radius: 5px;">                    --}}
                    <img class="mb-3" width="170" src="{{asset('jawwalak/img/logo.png')}}" alt="" style="padding: 10px;border-radius: 5px;">
                    <p class="max-w-300p mb-1">{{($setting = \App\Models\Setting::where('name',"description")->first()) ? $setting->value : __("Empty")}}</p>
                    <img width="58"
                         src="{{ ($logo = \App\Models\Setting::where('name','qr')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/qr.png')}}"
                         alt="">
                </div>
                <div class="col-lg-2 col-sm-3 col-6 text-sm-left text-center">
                    <h5 class="text-secondary">{{__("Sections")}}</h5>
                    <ul class="nav flex-column">

                        @if($sections and $sections->submenus)
                            @foreach($sections->submenus as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link px-0 text-dark pb-0"
                                       href="{{$submenu['url'][app()->getLocale()]}}"><small>{{$submenu['name'][app()->getLocale()]}}</small></a>
                                </li>
                            @endforeach
                        @endif

                    </ul>


                </div>
                <div class="col-lg-2 col-sm-3 col-6 text-sm-left text-center">
                    <h5 class="text-secondary">{{__("Legals")}}</h5>
                    <ul class="nav flex-column">

                        @if($legals and $legals->submenus)
                            @foreach($legals->submenus as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link px-0 text-dark pb-0"
                                       href="{{$submenu['url'][app()->getLocale()]}}"><small>{{$submenu['name'][app()->getLocale()]}}</small></a>
                                </li>
                            @endforeach
                        @endif


                    </ul>
                </div>
                <div class="col-lg-4 col-7 mx-auto">
                    <h5 class="text-secondary text-sm-left text-center">{{__("Contacts")}}</h5>
                    <ul class="nav flex-column text-sm-left text-center">
                        <li class="nav-item d-flex align-items-center">
                            <i class="fas text-secondary  fs-25p fa-map-marker-alt pr-3"></i> <a
                                class="nav-link px-0 text-dark pb-0"
                                href="#"><small> {{($setting = \App\Models\Setting::where('name',"address")->first()) ? $setting->value : __("Empty")}} </small></a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <i class="fas fa-phone-volume fs-25p text-secondary pr-3"></i> <a
                                class="nav-link px-0 text-dark pb-0"
                                href="#"><small>{{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : __("Empty") }}</small></a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <i class="far fa-envelope fs-25p text-secondary pt-2 pr-3"></i> <a
                                class="nav-link px-0 text-dark pb-0"
                                href="#"><small>{{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : __("Empty")}}</small></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
