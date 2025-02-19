<main>
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-p" href="#">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('Settings')}}</li>
            </ol>
        </nav>
    </div>
    <img class="img-fluid w-100" src="{{$page ? $page['image'] : asset('fedi/img/img-11.jpg') }}" style="max-height: 460px" alt="">

    {{--    <img class="img-fluid " src="{{$page ? $page['image'] : asset('fedi/img/img-11.jpg') }}" alt="">--}}
    <div class="container Privacy">
        <div class="row">
            <aside class="col-lg-4 mb-4">
                <div class="card border-0 bg-light rounded-3">
                    <div class="text-center py-3">
                        @livewire('site.profile.avatar')
                    </div>
                    @livewire('site.profile.sidebar')
                </div>
            </aside>
            <div class="col-lg-8 mb-4">
                <form wire:submit.prevent="update">
                    <div class="card card-body border-0 bg-light rounded-3">
                        <h1 class="h4 mt-2 mb-4">{{__("Change password")}}</h1>
                        <div class="form-group mb-4">
                            <label class="text-dark mb-2" for="old-price">{{__('Old password')}}</label>
                            <input wire:model.defer="user.password" type="password" class="form-control py-3 rounded-2" id="old-price" placeholder="ادخل كلمة المرور القديمة ">
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-dark mb-2" for="new-price">{{__("New password")}}</label>
                            <input wire:model.defer="user.new_password" type="password" class="form-control py-3 rounded-2" id="new-price" placeholder="ادخل كلمة المرور الجديدة  ">
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-dark mb-2" for="confirm-price">{{__("Confirm password")}} </label>
                            <input wire:model.defer="user.new_password_confirmation" type="password" class="form-control py-3 rounded-2" id="confirm-price" placeholder="إعادة كلمة المرور الجديدة  ">
                        </div>
                        <div class="text-center">
                            <button wire:loading.attr="disabled" type="submit" type="submit" class="btn btn-primary py-2 w-25 ">{{__("Save")}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="py-md-5 mt-md-5"></div>
</main>

