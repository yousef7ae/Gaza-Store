<form class="mt-2 w-100" method="post" wire:submit.prevent="store">
    {{csrf_field()}}

    @include('livewire.admin.alert')

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card d-table p-1 m-auto">
                            @if($imageTemp)
                                <img width="150" class="img-fluid rounded"
                                     src="{{ $imageTemp->temporaryUrl() }}"
                                     data-holder-rendered="true">

                            @else
                                <img width="200" class="rounded-circle img-thumbnail img-fluid"
                                     src="{{ empty(['image']) ? url(empty(['image'])) : url('dashboard/images/image1.png')}}"
                                     data-holder-rendered="true">
                            @endif
                        </div>

                        <div class="d-table p-1 m-auto uniform-uploader">
                            <input type="file" wire:model.defer="imageTemp"
                                   class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                                   data-fouc="">
                            @error('imageTemp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Name Store")}}</label>
                        <input wire:model.defer="store.name" placeholder="{{__("Name Store")}}"
                               class="form-control @error('store.name') is-invalid @enderror" type="text">
                        @error('store.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                @if(auth()->user()->hasRole('Admin'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">{{__("User")}}</label>
                            <select wire:model="store.user_id" placeholder="{{__("User")}}"
                                   class="form-control @error('store.user_id') is-invalid @enderror">
                                <option value="">{{__("Select User")}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} : {{$user->email}}</option>
                                @endforeach
                            </select>
                            @error('store.user_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Phone")}}</label>
                        <input wire:model.defer="store.phone" placeholder="{{__("Phone")}}"
                               class="form-control @error('store.phone') is-invalid @enderror" type="text">
                        @error('store.phone')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Mobile")}}</label>
                        <input wire:model.defer="store.mobile" placeholder="{{__("Mobile")}}"
                               class="form-control @error('store.mobile') is-invalid @enderror" type="text">
                        @error('store.mobile')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Email")}}</label>
                        <input wire:model.defer="store.email" placeholder="{{__("Email")}}"
                               class="form-control @error('store.email') is-invalid @enderror" type="text">
                        @error('store.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Store Type') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('store.store_type_id') is-invalid @enderror"
                                wire:model="store.store_type_id">
                            <option value="0">{{__('Select Store Type')}}...</option>
                            @foreach($types as $type)
                                <option
                                    value="{{$type->id}}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('store.store_type_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Store Category') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('store.store_category_id') is-invalid @enderror"
                                wire:model="store.store_category_id">
                            <option value="0">{{__('Select Store Type')}}...</option>
                            @foreach($store_categories as $store_category)
                                <option
                                    value="{{$store_category->id}}">{{ $store_category->name }}</option>
                            @endforeach
                        </select>
                        @error('store.store_category_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Select Country') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('store.country_id') is-invalid @enderror"
                                wire:model="store.country_id">
                            <option value="0">{{__('Select Country ')}}...</option>
                            @foreach($countries as $country)
                                <option
                                    value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('store.country_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Select City') }}</label>
                        <select type="text"
                                class="form-control form-control-sm @error('store.city_id') is-invalid @enderror"
                                wire:model="store.city_id">
                            <option value="0">{{__('Select City ')}}...</option>
                            @foreach($cities as $city)
                                <option
                                    value="{{$city->id}}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('store.city_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{__("Address")}}</label>
                        <input wire:model.defer="store.address" placeholder="{{__("Address")}}"
                               class="form-control @error('store.address') is-invalid @enderror" type="text">
                        @error('store.address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('store.lat') is-invalid @enderror" wire:ignore>
                    <label class="control-label">{{ __('Map') }}</label>

                    <div id="store_map" style="height:200px;"></div>

                    @error('store.lat')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Description') }}</label>
                        <textarea value="" wire:model.defer="store.description"
                                  placeholder="{{ __('Add Description') }}"
                                  name="description"
                                  class="form-control @error('store.description') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('store.description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <button wire:loading.attr="disabled" wire:click.prevent="ActiveTab(1)"  class="btn @if ($active == 1) btn-success disabled @else btn-primary @endif   mb-2" type="submit"><i class="fab fa-facebook-f"></i></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button wire:loading.attr="disabled" wire:click.prevent="ActiveTab(2)"  class="btn @if ($active == 2) btn-success disabled @else btn-primary @endif   mb-2" type="submit"><i class="fab fa-instagram"></i></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button wire:loading.attr="disabled" wire:click.prevent="ActiveTab(3)"  class="btn @if ($active == 3) btn-success disabled @else btn-primary @endif   mb-2" type="submit"><i class="fab fa-whatsapp"></i></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button wire:loading.attr="disabled" wire:click.prevent="ActiveTab(4)"  class="btn @if ($active == 4) btn-success disabled @else btn-primary @endif   mb-2" type="submit"><i class="fab fa-twitter"></i></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button wire:loading.attr="disabled" wire:click.prevent="ActiveTab(5)"  class="btn @if ($active == 5) btn-success disabled @else btn-primary @endif   mb-2" type="submit"><i class="fab fa-telegram-plane"></i></button>
                    </div>
                </div>
                </div>

                @if($active == 1)

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("URL Facebook")}}</label>
                            <input wire:model.defer="store.url_facebook" placeholder="{{__("Add Facebook")}}"
                                   name="store.url_facebook"
                                   class="form-control @error('store.url_facebook') is-invalid @enderror"
                                   type="text">
                            @error('store.url_facebook')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                @elseif($active == 2)

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("URL Instagram")}}</label>
                            <input wire:model.defer="store.url_instagram" placeholder="{{__("Add Instagram")}}"
                                   name="store.url_instagram"
                                   class="form-control @error('store.url_instagram') is-invalid @enderror"
                                   type="text">
                            @error('store.url_instagram')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                @elseif($active == 3)

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("URL WhatsApp")}}</label>
                            <input wire:model.defer="store.url_whatsapp" placeholder="{{__("Add WhatsApp")}}"
                                   name="store.url_whatsapp"
                                   class="form-control @error('store.url_whatsapp') is-invalid @enderror"
                                   type="text">
                            @error('store.url_whatsapp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                @elseif($active == 4)

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("URL Twitter")}}</label>
                            <input wire:model.defer="store.url_twitter" placeholder="{{__("Add Twitter")}}"
                                   name="store.url_twitter"
                                   class="form-control @error('store.url_twitter') is-invalid @enderror"
                                   type="text">
                            @error('store.url_twitter')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                @elseif($active == 5)

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">{{__("URL Telegram")}}</label>
                            <input wire:model.defer="store.url_telegram" placeholder="{{__("Add Telegram")}}"
                                   name="store.url_telegram"
                                   class="form-control @error('store.url_telegram') is-invalid @enderror"
                                   type="text">
                            @error('store.url_telegram')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                @else
                @endif
            </div>
        </div>
    </div>
    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div>
        <button wire:loading.attr="disabled" class="btn btn-primary submit"
                type="submit">{{__("Save")}}</button>
    </div>
</form>

<script>
    function initMapLocations(lat,lng,div) {
        const myLatlng = {lat: lat, lng: lng};
        const map = new google.maps.Map(document.getElementById(div), {
            zoom: 12,
            center: myLatlng,

        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title: "name",
            draggable: true,
        });

        google.maps.event.addListener(marker, 'dragend', function (ev) {
            @this.set('store.lat', marker.getPosition().lat());
            @this.set('store.lng', marker.getPosition().lng());
        });

    }

    initMapLocations(31.4417483,34.3865385,"store_map")
</script>
