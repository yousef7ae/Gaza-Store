<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach(config('app.locales') as $locale => $language)
                <button class="nav-link {{$locale == app()->getLocale() ? 'active' : ''}}" id="nav-lang-{{$locale}}-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-lang-{{$locale}}" type="button" role="tab"
                        aria-controls="nav-lang-{{$locale}}" aria-selected="true">
                    {{$locale}}</button>
            @endforeach
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        @foreach(config('app.locales') as $locale => $locale)
            <div class="tab-pane fade {{$locale == app()->getLocale() ? 'show active' : ''}}" id="nav-lang-{{$locale}}"
                 role="tabpanel" aria-labelledby="nav-lang-{{$locale}}-tab">

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">{{ __('Title') }}</label>
                            <input value="" wire:model.defer="menu.title.{{$locale}}"
                                   placeholder="{{ __('Add Title') }}"
                                   name="title"
                                   class="form-control @error('menu.title.'.$locale) is-invalid @enderror" type="text">
                            @error('menu.title.'.$locale)
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>

                    </div>
                </div>

                <div class="row">

                    @foreach($menu['submenus'] as $key => $submenu)

                        <div class="col-md-1">
                            <button class="btn btn-danger btn-xs mt-4" type="button"
                                    wire:click="removeSubmenu({{$key}})"><i class="fa fa-trash"></i></button>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label class="control-label">{{ __('Name ') }} {{$key}}</label>
                                <input placeholder="{{ __('Add Name') }}"
                                       wire:model.defer="menu.submenus.{{$key}}.name.{{$locale}}"
                                       name="name"
                                       class="form-control @error('menu.submenus.{{$key}}.name.{{$locale}}') is-invalid @enderror"
                                       type="text">
                                @error('menu.submenus.{{$key}}.name.{{$locale}}')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">{{ __('Url ') }} {{$key}}</label>
                                <input placeholder="{{ __('Add Url') }}"
                                       wire:model.defer="menu.submenus.{{$key}}.url.{{$locale}}"
                                       name="name"
                                       class="form-control @error('menu.submenus.{{$key}}.url.{{$locale}}') is-invalid @enderror"
                                       type="text">
                                @error('menu.submenus.{{$key}}.url.{{$locale}}')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                    @endforeach
                    <div>
                        <button type="button" class="btn btn-warning m-2" wire:click="addSubmenu">+{{__('submenu')}}</button>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div>
        <button wire:loading.attr="disabled" class="btn btn-info submit"
                type="submit">{{__("Store")}}</button>
    </div>
</form>


