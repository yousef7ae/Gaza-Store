
<main class="single-o">
    <nav class="container mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary fw-bold" href="#">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('My requests')}}</li>
        </ol>
    </nav>
    <section class="">
        {{-- start osama--}}
        <div class="container my-4 shopping">
            @if($carts->count() > 0)
            <h3 class="fw-bold mb-4"> عربة التسوق ({{$carts->count()}}) </h3>
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="bg-light border rounded-3 p-2 table-responsive-sm">
                        @if($carts->count() > 0)
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="text-p" scope="col">المنتج</th>
                                <th class="text-p" scope="col">اللون</th>
                                <th class="text-p" scope="col">الحجم</th>

                                <th class="text-p" scope="col">الكمية</th>
                                <th class="text-p" scope="col">الاجمالي</th>
{{--                                <th class="text-p" scope="col">الحذف</th>--}}
                            </tr>
                            </thead>
                            <tbody class="border-top">

                            @foreach($carts as $cart)
                            <tr>
                                <th class="align-middle" style="max-width: 150px">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5">
                                            <div class="overflow-hidden pe-2">
                                                <img
                                                    src="{{$cart->product->image}}"
                                                    class="img-fluid" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="pb-4 position-relative">
                                                <p class="h6 card-title mb-2">{{$cart->name}}</p>
                                                <p class="card-text text-p mb-1"><small>{{$cart->product_name}}</small></p>
                                                <div class="position-relative stars w-80p">
                                                    <span class="star1"></span>
                                                    <span class="star2" style="width:{{($cart->product->rate/5)*100}}%"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <p class="mb-0 fw-bold text-p">{{$cart->constant['color'] ??''}} </p>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 fw-bold text-p">{{$cart->constant['color'] ??''}} قدم</p>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 fw-bold text-p">{{$cart->qty}}</p>
                                </td>
                                <td class="align-middle"><p class="mb-0 fw-bold text-p">{{$cart->price}} {{$cart->product->store ? $cart->product->store->currency->code : ""}}</p></td>
{{--                                <td class="align-middle">--}}
{{--                                    <button class="btn btn-danger rounded-circle"><i--}}
{{--                                            class="fa-solid fa-trash-can"></i></button>--}}
{{--                                </td>--}}
                            </tr>
                            @endforeach

                            </tbody>
                        </table>

                        @else
                            <div class="col-lg-7">
                                <div class="alert alert-danger mt-3"> {{__("Empty Cart")}}</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="bg-light border rounded-3 p-3 mb-4">
                        <h5 class="text-dark mb-3">التسليم إلى العنوان </h5>
                            @foreach($address as $address_)
                                <label class="mb-3 pointer">
                                    <input class="me-2" type="radio" wire:model="address_id" name="address_id" value="{{$address_->id}}"/>{{$address_->name}}
                                    , {{$address_->location}}
                                    ,{{$address_->email}}
                                    ,{{$address_->mobile}}
                                </label>
                            @endforeach

                                    <button type="button" wire:click="$set('add_new_address', {{!$add_new_address}})"
                                            class="btn btn-primary mb-3">{{__("Add New Address")}}</button>

                                    @if($add_new_address)
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="firstName">{{__("Name")}}<span>*</span></label>
                                                    <input type="text" id="name" wire:model.defer="new_address.name"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{__("Email")}}<span>*</span></label>
                                            <input type="email" id="email" wire:model.defer="new_address.email"
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="Country">{{__("Address")}}
                                                <span>*</span></label>
                                            <input type="text" id="location" wire:model.defer="new_address.location"
                                                   class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{__("Zip code")}}<span>*</span></label>
                                            <input type="text" id="zip_code" wire:model.defer="new_address.zip_code"
                                                   class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{__("Note")}}<span>*</span></label>
                                            <input type="text" id="note" wire:model.defer="new_address.note"
                                                   class="form-control"
                                                   placeholder="">
                                        </div>

                                        <div class="input-group row g-0">
                                            <div class="col-12">
                                                <label for="phoneNumber">{{__("Mobile")}}<span>*</span>
                                                </label>
                                                <input class="form-control" type="number" id="mobile"
                                                       wire:model.defer="new_address.mobile" placeholder="+970 59123456"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary"
                                                    wire:click.prevent="saveAddress">{{__("Save Address")}}</button>
                                        </div>
                                    @endif
                    </div>

                    <div class="bg-light border rounded-3 p-3 mb-4">
                                            <h5>الملخص</h5>
                                            <div class="border-bottom p-3">
                                                <div class="d-flex justify-content-between fw-bold">
                                                    <p> السعر الكلي </p>
                                                    <p class="text-dark">{{$total}} {{$cart->product->store ? $cart->product->store->currency->code : ""}}</p>
                                                </div>
                                                <div class="d-flex justify-content-between fw-bold">
                                                    <p> سعر التوصيل  </p>
                                                    <p class="text-dark"> {{$cart->product->store ? $cart->product->store->need_delivery : ""}} {{$cart->product->store ? $cart->product->store->currency->code : ""}} </p>
                                                </div>
                                            </div>

                                            <div class="my-3">
{{--                                                <h5 class="fw-bold mb-3"> كود الخصم </h5>--}}
{{--                                                <form method="post">--}}
{{--                                                <div class="d-flex justify-content-between">--}}
{{--                                                    <input class="form-control rounded-pill me-2" type="text" placeholder="c-00000">--}}
{{--                                                    <button class="btn px-md-5 px-3 rounded-pill btn-primary" type="submit">تطبيق</button>--}}
{{--                                                </div>--}}
{{--                                                </form>--}}

                                            </div>
                                            <div class="d-flex justify-content-between fw-bold">
                                                <p> اجمالي القيمة المضافة</p>
                                                <p class="text-primary">{{$total}} {{$cart->product->store ? $cart->product->store->currency->code : ""}}</p>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button class="btn btn-dark w-90 mx-auto rounded-pill" wire:click.prevent="confirm">قم الان بالدفع </button>
                                            </div>
                                        </div>
                </div>
            </div>
            @else
                <div class="col-lg-7">
                    <div class="alert alert-danger mt-3"> {{__("Empty Cart")}}</div>
                </div>
            @endif
        </div>
        {{--  end osama--}}

    </section>
</main>

