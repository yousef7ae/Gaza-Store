<div key="{{rand(1,1000000)}}">
    <nav class="container py-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary fw-bold" href="#">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">المنتجات</li>
        </ol>
    </nav>
    <section class="container active-o py-4">
        <div class="row">
            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-6">

                <livewire:site.products.product-card :product_id="$product" :count="4"
                                                     :key="'product-card-'.rand(1,1000)"></livewire:site.products.product-card>
                </div>
            @endforeach
        </div>
    </section>
    <ul class="pagination justify-content-center">
        {{$products->links()}}
    </ul>

{{--    <nav aria-label="Page navigation example">--}}
{{--        <ul class="pagination justify-content-center">--}}
{{--            <li class="page-item mx-1 active"><a class="page-link rounded" href="#">1</a></li>--}}
{{--            <li class="page-item mx-1"><a class="page-link rounded" href="#">2</a></li>--}}
{{--            <li class="page-item mx-1"><a class="page-link rounded" href="#">3</a></li>--}}
{{--        </ul>--}}
{{--    </nav>--}}

</div>
