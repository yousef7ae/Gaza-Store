<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Settings')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Settings')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="container-fluid">

            @include('livewire.admin.alert')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary ">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Settings')}}</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form class="mt-2" method="post" wire:submit.prevent="update">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Site Name")}}</label>
                                            <input value="" wire:model.lazy="site_name"
                                                   placeholder="{{__("Add Site Name")}}"
                                                   name="site_name"
                                                   class="form-control @error('site_name') is-invalid @enderror"
                                                   type="text">
                                            @error('site_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Email")}}</label>
                                            <input value="" wire:model.lazy="email" placeholder="{{__("Add Email")}}"
                                                   name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   type="text">
                                            @error('email')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Mobile")}}</label>
                                            <input wire:model.lazy="mobile" placeholder="{{__("Add Mobile")}}"

                                                   class="form-control @error('mobile') is-invalid @enderror"
                                                   type="text">
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Phone")}}</label>
                                            <input value="" wire:model.lazy="phone" placeholder="{{__("Add Phone")}}"
                                                   name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   type="number">
                                            @error('phone')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Address")}}</label>
                                            <input wire:model.lazy="address" placeholder="{{__("Add Address")}}"
                                                   name="address"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   type="text">
                                            @error('address')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">{{__("Site Description")}}</label>
                                            <textarea wire:model.lazy="description"
                                                      placeholder="{{__("Add Site Description")}}"
                                                      id="summernote" name="description"
                                                      class="form-control summernote @error('description') is-invalid @enderror"
                                                      type="checkbox"></textarea>
                                            @error('description')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("URL Facebook")}}</label>
                                            <input wire:model.lazy="url_facebook" placeholder="{{__("Add Facebook")}}"
                                                   name="url_facebook"
                                                   class="form-control @error('url_facebook') is-invalid @enderror"
                                                   type="text">
                                            @error('url_facebook')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("URL Instagram")}}</label>
                                            <input wire:model.lazy="url_instagram" placeholder="{{__("Add Instagram")}}"
                                                   name="url_instagram"
                                                   class="form-control @error('url_instagram') is-invalid @enderror"
                                                   type="text">
                                            @error('url_instagram')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("URL Twitter")}}</label>
                                            <input wire:model.lazy="url_twitter" placeholder="{{__("Add Twitter")}}"
                                                   name="url_twitter"
                                                   class="form-control @error('url_twitter') is-invalid @enderror"
                                                   type="text">
                                            @error('url_twitter')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("URL WhatsApp")}}</label>
                                            <input wire:model.lazy="url_whatsapp" placeholder="{{__("Add WhatsApp")}}"
                                                   name="url_whatsapp"
                                                   class="form-control @error('url_whatsapp') is-invalid @enderror"
                                                   type="text">
                                            @error('url_whatsapp')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("URL Map")}}</label>
                                            <input wire:model.lazy="url_map" placeholder="{{__("Add Map")}}"
                                                   name="url_map"
                                                   class="form-control @error('url_map') is-invalid @enderror"
                                                   type="text">
                                            @error('url_map')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Points Merchant")}}</label>
                                            <input wire:model.lazy="points_merchant" placeholder="{{__('Points Merchant')}}"
                                                   name="points_merchant"
                                                   class="form-control @error('points_merchant') is-invalid @enderror"
                                                   type="text">
                                            @error('points_merchant')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Points Delivery")}}</label>
                                            <input wire:model.lazy="points_delivery" placeholder="{{__('Points Delivery')}}"
                                                   name="points_delivery"
                                                   class="form-control @error('points_delivery') is-invalid @enderror"
                                                   type="text">
                                            @error('points_delivery')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Points Customer")}}</label>
                                            <input wire:model.lazy="points_customer" placeholder="{{__('Points Customer')}}"
                                                   name="points_customer"
                                                   class="form-control @error('points_customer') is-invalid @enderror"
                                                   type="text">
                                            @error('points_customer')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="card d-table p-1 m-auto">
                                                @if($logoTemp)
                                                    <img width="150" class="img-fluid rounded"
                                                         src="{{ $logoTemp->temporaryUrl() }}"
                                                         data-holder-rendered="true">

                                                @else

                                                    <img width="200" class="img-thumbnail"
                                                         src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}"
                                                         data-holder-rendered="true">

                                                @endif
                                            </div>

                                            <div class="d-table p-1 m-auto uniform-uploader">
                                                <input type="file" wire:model.lazy="logoTemp"
                                                       class="form-input-styled form-control @error('logoTemp ') is-invalid @enderror"
                                                       data-fouc=""
                                                >
                                                <span class="filename">{{__("File Image")}}</span>
                                                @error('logoTemp')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="card d-table p-1 m-auto">--}}
{{--                                                @if($qrTemp)--}}

{{--                                                    <img width="150" class="img-fluid rounded"--}}
{{--                                                         src="{{ $qrTemp->temporaryUrl() }}"--}}
{{--                                                         data-holder-rendered="true">--}}
{{--                                                @else--}}

{{--                                                    <img width="200" class="rounded-circle img-thumbnail"--}}
{{--                                                         src="{{ ($qr = \App\Models\Setting::where('name','qr')->first()) ? url("storage/".$qr->value) : url('Dukkan/images/qr.png')}}"--}}
{{--                                                         data-holder-rendered="true">--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div class="d-table p-1 m-auto uniform-uploader">--}}
{{--                                                <input type="file" wire:model.lazy="qrTemp"--}}
{{--                                                       class="form-input-styled form-control @error('qrTemp') is-invalid @enderror"--}}
{{--                                                       data-fouc=""--}}
{{--                                                >--}}
{{--                                                <span class="filename">{{__("Image Qr ")}}</span>--}}
{{--                                                @error('qrTemp')--}}
{{--                                                <span class="invalid-feedback"--}}
{{--                                                      role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                                                @enderror--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>


                                <div class="form-check">
                                    <label class="control-label">{{__("Active")}}</label>
                                    <input value="" wire:model.lazy="active"
                                           name="active"
                                           class="@error('active') is-invalid @enderror"
                                           type="checkbox">
                                    @error('active')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div>
                                <div wire:loading>
                                    <i class="fas fa-sync fa-spin"></i>
                                    {{__("Loading please wait")}} ...
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-success btn-block">{{__("Update")}}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>






