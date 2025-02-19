<main class="mt-4 pt-2 Privacy">
    <div class="d-flex align-items-center overlay overflow-hidden" style="height: 400px;">
        <img class="w-100" src=" {{$page ? $page['image'] : asset('Dukkan/images/Privacy-Policy.png') }} " alt="">
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

        @livewire('site.subscribe-newsletter')

        @if($posts->count() > 0)
            @foreach($posts as $post)
                <div class="card card-body rounded-lg border-0 mb-3">
                    <p> {{$post->description}} </p>
                </div>
            @endforeach

        @endif


    </div>

</main>
