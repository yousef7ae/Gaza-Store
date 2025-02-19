<section class="py-4 take">
    @if($categories->count() > 0)
        <div class="container">
            <h4 class="text-secondary mb-4">{{__("Categories")}}</h4>
            <div class="mb-4 ratings row no-gutters">
                @foreach( $categories as $category)
                    <div class="col-lg-2 col-md-3 col-4 p-1 mb-3">
                        <div
                            class="d-flex h-100 rounded justify-content-center align-items-center text-center position-relative">
                            <a class="text-white overflow-hidden d-flex justify-content-center align-items-center shadow-sm h-180p"
                               href="{{route('stores',['category_id'=>$category->id])}}">
                                <img class="img-fluid cover"
                                     src="{{ $category->image ? $category->image : url('assets/images/image.png')}}"
                                     alt="">
                                <h5 class="fw-bold mx-1 p-2 w-100 mb-0"
                                    style="position: absolute;background: rgb(255 255 255 / 50%);bottom: -4px;color: #000">{{$category->name}}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
