<div style="display: contents">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="fa fa-arrow-right6 mr-2"></i> <span class="font-weight-semibold">{{ __('Home') }}</span>
                    -
                    {{ __('Dashboard') }}</h4>
                <a href="{{ route('admin.home') }}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb ml-2">
                    <a href="{{ route('admin.home') }}" class="breadcrumb-item"><i class="fa fa-home2 mr-2"></i>
                        {{ __('Home') }}</a>
                    <span class="breadcrumb-item active">{{ __('Store') }}</span>
                </div>
                <a href="{{ route('admin.home') }}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="card">
        <div class="card-header">{{ __('Store') }}</div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}: </label>
                        <b>{{ $store->name }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('Description') }}: </label>
                        <b>{{ $store->description }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('created_at') }}: </label>
                        <b>{{ $store->created_at->diffForHumans() }}</b>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('updated_at') }}: </label>
                        <b>{{ $store->updated_at->diffForHumans() }}</b>
                    </div>
                </div>
            </div>

            <a href="#" data-bs-toggle="modal" data-bs-target="#EditModalStore" title="{{ __('Edit') }}"
                class="btn btn-info float-right">
                <i class="fa fa-edit"></i>
                {{ __('Edit') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="statistics-tab" data-bs-toggle="pill"
                        href="#statistics" role="tab" aria-controls="statistics" aria-selected="true"><i
                            class="fas fa-id-card"></i> {{ __('Statistics') }}
                    </a></li>

                @if (auth()->guard('web')->user()->can('brands show'))
                    <li class="nav-item"><a class="nav-link" id="brands-tab" data-bs-toggle="pill" href="#brands"
                            role="tab" aria-controls="brands" aria-selected="false"><i class="fas fa-history"></i>
                            {{ __('Brands') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('categories show'))
                    <li class="nav-item"><a class="nav-link" id="categories-tab" data-bs-toggle="pill"
                            href="#categories" role="tab" aria-controls="categories" aria-selected="false"><i
                                class="fas fa-history"></i> {{ __('Categories') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('products show'))
                    <li class="nav-item"><a class="nav-link" id="products-tab" data-bs-toggle="pill" href="#products"
                            role="tab" aria-controls="products" aria-selected="false"><i class="fas fa-history"></i>
                            {{ __('Products') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('orders show'))
                    <li class="nav-item"><a class="nav-link" id="orders-tab" data-bs-toggle="pill" href="#orders"
                            role="tab" aria-controls="orders" aria-selected="false"><i class="fas fa-history"></i>
                            {{ __('Orders') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('carts show'))
                    <li class="nav-item"><a class="nav-link" id="carts-tab" data-bs-toggle="pill" href="#carts"
                            role="tab" aria-controls="carts" aria-selected="false"><i class="fas fa-history"></i>
                            {{ __('Carts') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('users show'))
                    <li class="nav-item"><a class="nav-link" id="users-tab" data-bs-toggle="pill" href="#users"
                            role="tab" aria-controls="users" aria-selected="false"><i
                                class="fas fa-history"></i> {{ __('Users') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('coupons show'))
                    <li class="nav-item"><a class="nav-link" id="coupons-tab" data-bs-toggle="pill" href="#coupons"
                            role="tab" aria-controls="coupons" aria-selected="false"><i
                                class="fas fa-history"></i> {{ __('Coupons') }}</a></li>
                @endif

                @if (auth()->guard('web')->user()->can('ads show'))
                    <li class="nav-item"><a class="nav-link" id="ads-tab" data-bs-toggle="pill" href="#ads"
                            role="tab" aria-controls="ads" aria-selected="false"><i class="fas fa-history"></i>
                            {{ __('Ads') }}</a></li>
                @endif

                <li class="nav-item"><a class="nav-link" id="sliders-tab" data-bs-toggle="pill" href="#sliders"
                        role="tab" aria-controls="sliders" aria-selected="false"><i class="fas fa-history"></i>
                        {{ __('Sliders') }}</a></li>

                <li class="nav-item"><a class="nav-link" id="store_time_work-tab" data-bs-toggle="pill"
                        href="#store_time_work" role="tab" aria-controls="store_time_work"
                        aria-selected="false"><i class="fas fa-history"></i> {{ __('Work Times') }}</a></li>

                <li class="nav-item"><a class="nav-link" id="currency-tab" data-bs-toggle="pill" href="#currency"
                        role="tab" aria-controls="currency" aria-selected="false"><i class="fas fa-history"></i>
                        {{ __('Currency') }}</a></li>

                {{-- <li class="nav-item">
                    <a class="nav-link" id="delivery-fees-tab" data-bs-toggle="pill" href="#delivery-fees"
                        role="tab" aria-controls="delivery-fees" aria-selected="false"><i
                            class="fas fa-history"></i> {{ __('Delivery Fees') }}
                    </a>
                </li> --}}
            </ul>

            <div class="tab-content" id="pills-warningtabContent">

                <div class="tab-pane fade show active" id="statistics" role="tabpanel"
                    aria-labelledby="statistics-tab">

                    <div class="row">
                        @foreach ($models as $index => $model)
                            <div class="col-sm-6 col-xl-3 col-lg-6">
                                <div class="card o-hidden border-0">
                                    <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                            <div class="align-self-center text-center"><i data-feather="activity"></i>
                                            </div>
                                            <div class="media-body"><span class="m-0">{{ $model }}</span>
                                                <h4 class="mb-0 counter">{{ __($index) }}</h4><i class="icon-bg"
                                                    data-feather="activity"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <br>
                    @livewire('admin.orders.orders', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="carts" role="tabpanel" aria-labelledby="carts-tab">
                    <br>
                    @livewire('admin.carts.carts', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                    <br>
                    @livewire('admin.users.users', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <br>
                    @livewire('admin.products.products', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab">
                    <br>
                    @livewire('admin.brands.brands', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                    <br>
                    @livewire('admin.categories.categories', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                    <br>
                    @livewire('admin.coupons.coupons', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="ads" role="tabpanel" aria-labelledby="ads-tab">
                    <br>
                    @livewire('admin.ads.ads', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="sliders" role="tabpanel" aria-labelledby="sliders-tab">
                    <br>
                    @livewire('admin.sliders.sliders', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="store_time_work" role="tabpanel"
                    aria-labelledby="store_time_work-tab">
                    <br>
                    @livewire('admin.stores.stores-time-work', [
                        'store_id' => $store->id,
                    ])
                </div>

                <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="currency-tab">
                    <br>
                    @livewire('admin.stores.stores-currency', [
                        'store_id' => $store->id,
                    ])
                </div>

                {{-- <div class="tab-pane fade" id="delivery-fees" role="tabpanel" aria-labelledby="delivery-fees-tab">
                    <br>
                    @livewire('admin.delivery-fees.delivery-fees', [
                        'store_id' => $store->id,
                    ])
                </div> --}}
            </div>
        </div>
    </div>

    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="EditModalStore" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Products') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{ __('Loading please wait') }} ...
                        </div>
                    </div>
                    @if ($store->id)
                        @livewire('admin.stores.stores-edit', [$store->id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->

</div>
