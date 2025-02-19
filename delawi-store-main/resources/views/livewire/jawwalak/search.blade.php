<div>
    <div wire:ignore.self class="modal fade serch-o" id="search" tabindex="-1" role="dialog" aria-labelledby="serch"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content border-0 bg-transparent">
                <div class="pb-3">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row no-gutters border-bottom border-secondary">
                        <div class="col-10">
                            <input type="text" placeholder="Search.." wire:model="search_string"
                                   class="form-control form-control-lg rounded-0  text-white" style="background: none ; border:0">
                        </div>
                        <div class="col-2 text-right">
                            <button type="submit" class="btn text-white rounded-0"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </form>
                    <div class="card mt-3 p-3 rounded-10">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="pb-2 border-bottom">{{__("Stores")}}</h3>
                                @if($stores and $stores->count() > 0)
                                    <ul class="">
                                        @foreach($stores as $store)
                                            <li class="text-left mb-2"><a href="/stores/{{$store->id}}"><img src="{{$store->image}}" width="50" height="50" class="img-thumbnail mr-2" style="height: 50px"/>{{$store->name}}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h3 class="pb-2 border-bottom">{{__("Categories")}}</h3>
                                @if($categories and $categories->count() > 0)
                                    <ul class="">
                                        @foreach($categories as $category)
                                            <li class="text-left mb-2"><a href="/stores?category_id={{$category->id}}"><img src="{{$category->image}}" width="50" height="50" class="img-thumbnail mr-2" style="height: 50px"/>{{$category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h3 class="pb-2 border-bottom">{{__("Brands")}}</h3>
                                @if($brands and $brands->count() > 0)
                                    <ul class="">
                                        @foreach($brands as $brand)
                                            <li class="text-left mb-2"><a href="/stores?brand_id={{$brand->id}}"><img src="{{$brand->image}}" width="50" height="50" style="height: 50px" class="img-thumbnail mr-2"/>{{$brand->name}}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-danger">{{__("No results")}}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h3 class="pb-2 border-bottom">{{__("Products")}}</h3>
                                @if($products and $products->count() > 0)
                                    <ul class="">
                                        @foreach($products as $product)
                                            <li class="text-left mb-2"><a href="/products/{{$product->id}}"><img src="{{$product->image}}" width="50" height="50" style="height: 50px" class="img-thumbnail mr-2"/>{{$product->name}}</a></li>
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
