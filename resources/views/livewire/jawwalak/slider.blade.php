<section class="container">
    @if($sliders->count() > 0)
        <div class="owl-carousel owl-theme" id="slider">
            @foreach($sliders as $slider)
                <div class="item">
                    <div class="d-flex align-items-center  overlay overflow-hidden">
                        <img class="w-100"
                             src="{{ $slider->image ? $slider->image : url('assets/images/image.png')}}"
                             alt="{{$slider->name}}">
                        <div class="carousel-caption d-flex  justify-content-start align-items-center">
                            <div class="container text-left">
                                @if(!empty($slider->url))
                                    <a class="text-white" href="{{$slider->url}}">
                                    <span class="rounded-circle p-edit bg-danger w-30p h-30p text-center mx-1">
                                        <i class="fas fa-arrow-right"></i>
                                    </span> {{__("Show Details")}} </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
