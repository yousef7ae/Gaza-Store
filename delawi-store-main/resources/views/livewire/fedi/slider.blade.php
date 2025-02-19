<section class="slider">
@if($sliders->count() > 0)
        <div class="slider-box">
            <div class="single-item">
            @foreach($sliders as $slider)
                <div class="item layout" data-aos="fade-right" data-aos-duration="1200" style="background-image: url({{ $slider->image ? $slider->image : 'fedi/img/img-1.gif'}})">
                    <div class="container h-100 position-relative">
                        <img class=" new" src="{{asset('fedi/img/icon-3.png')}}" alt="{{$slider->name}}">
{{--                        {{ $slider->image ? $slider->image : url('fedi/img/img-2.png')}}--}}
                        <div class="box-content text-white fw-bold">
                            <h2 class="fw-bold text-white">{{ $slider->product ? $slider->product->name :""}} </h2>
                            <p class="text-center">{{ $slider->name}} </p>
                            <a href="{{route('site.categories')}}" class="btn fw-bold px-md-5 px-3 py-2 btn-primary rounded-o">تسوق الان </a>
                        </div>
                        <span class="discont">{{ ($coponee = $copone->where('product_id',$slider->product_id)->first()) ? $coponee->value :"0"}}% -</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>


