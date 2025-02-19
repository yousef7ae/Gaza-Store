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
                            <input value="" wire:model.defer="page.title.{{$locale}}"
                                   placeholder="{{ __('Add Title') }}"
                                   name="title"
                                   class="form-control @error('page.title.'.$locale) is-invalid @enderror" type="text">
                            @error('page.title.'.$locale)
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>

                    </div>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">{{ __('Description') }}</label>
                            <textarea value="" wire:model.defer="page.description.{{$locale}}"
                                   placeholder="{{ __('Add Title') }}"
                                   name="title"
                                      class="form-control @error('page.description.'.$locale) is-invalid @enderror" rows="5"></textarea>
                            @error('page.description.'.$locale)
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>

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
        <button wire:loading.attr="disabled" class="btn btn-info"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        if (CKEDITOR.instances['description']) {
            CKEDITOR.remove(CKEDITOR.instances['description']);
        }

        CKEDITOR.replace(document.querySelector('#description'), {
            // language: 'ar',
        });

        CKEDITOR.instances['description'].on('change', function (event) {
        @this.set('page.description', event.editor.getData());
            CKEDITOR.remove(CKEDITOR.instances['description']);
        });
    });
</script>
