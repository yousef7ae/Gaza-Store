
<div>
    <div wire:ignore.self class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="serch"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-body">
                    <div class="card rounded-xl mt-3 p-3 rounded-10">
                                <button type="button" class="btn-close btn position-absolute left-0 px-4 text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <form class="col-md-6 col-10 mx-auto mb-md-5 mb-3">
                                <div class="d-flex position-relative">
                                    <input type="text" placeholder="{{__('Search')}}.." wire:model="search_string" class="form-control rounded-pill pe-5">
                                    <button type="submit" class="btn btn-outline-primary px-3 rounded-pill border-0 h-100 position-absolute top-0 left-0"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <h3 class="pb-2">{{__("Categories")}}</h3>
                                @if($categories and $categories->count() > 0)
                                    <ul class="nav flex-column">
                                        @foreach($categories as $category)
                                            <li class="text-left nav-item mb-2">
                                                <a class="text-decoration-none d-flex nav-link text-black" href="{{route('stores-single',$category->store_id)}}?category_id={{$category->id}}">
                                                    <img src="{{$category->image}}" alt="{{$category->name}}" width="50" height="50" class="img-thumbnail h-50p overflow-hidden rounded-circle border border-white shadow me-3" />
                                                    {{$category->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h3 class="pb-2">{{__("Brands")}}</h3>
                                @if($brands and $brands->count() > 0)
                                    <ul class="nav flex-column">
                                        @foreach($brands as $brand)
                                            <li class="text-left nav-item mb-2">
                                                <a class="text-decoration-none d-flex nav-link text-black" href="{{route('stores-single',$brand->store_id)}}?brand_id={{$brand->id}}">
                                                    <img src="{{$brand->image}}" alt="{{$brand->name}}" width="50" height="50" class="img-thumbnail h-50p overflow-hidden rounded-circle border border-white shadow me-3"/>
                                                    {{$brand->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h3 class="pb-2">{{__("Products")}}</h3>
                                @if($products and $products->count() > 0)
                                    <ul class="nav flex-column">
                                        @foreach($products as $product)
                                            <li class="text-left nav-item nav-item mb-2">
                                                <a class="text-decoration-none d-flex text-black" href="/products/{{$product->id}}">
                                                    <img src="{{$product->image}}" alt="{{$product->name}}" width="50" height="50" class="img-thumbnail h-50p overflow-hidden rounded-circle border border-white shadow me-3"/>
                                                    {{$product->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
