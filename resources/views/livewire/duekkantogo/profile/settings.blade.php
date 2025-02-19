<main class="mt-4 pt-2 Privacy">
    <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
        <img class="w-100" src="{{$page ? $page['image'] : asset('Dukkan/images/bg-Profile.png') }}" alt="">
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

            <!-- sidebar -->
            @livewire('site.profile.sidebar')

            <div class="col-lg-8">
                <h4 class="text-secondary mb-4">{{__("Change password")}}</h4>
                <ul class="nav nav-tabs lang-pass" id="myTab" role="tablist">
                    <li class="nav-item nav-link border-0" role="presentation">
                        <a class="btn rounded-0 p-1 mx-3 active text-secondary font-weight-bold" data-toggle="tab"
                           id="pills-Password-tab" role="tab" href="#pills-Password" type="button"
                           aria-controls="pills-Password" aria-selected="false">{{__("Change password")}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pills-Password" role="tabpanel"
                         aria-labelledby="pills-Password-tab">

                        <form action="" class="w-100 mt-3">
                            <div class="mb-1">
                                <label class="mb-2 h6">{{__('Old password')}}</label>
                                <input type="password" class="form-control px-3 py-2">
                            </div>
                            <div class="mb-1">
                                <label class="mb-2 h6">{{__("New password")}}</label>
                                <input type="password" class="form-control px-3 py-2">
                            </div>
                            <div class="mb-1">
                                <label class="mb-2 h6">{{__("Confirm password")}}</label>
                                <input type="password" class="form-control px-3 py-2">
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-danger px-3">{{__("Save")}}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
