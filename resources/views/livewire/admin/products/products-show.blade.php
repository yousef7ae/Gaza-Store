<div style="display: contents">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="fa fa-arrow-right6 mr-2"></i> <span class="font-weight-semibold">{{__("Home")}}</span> -
                    {{__("Dashboard")}}</h4>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>


        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb ml-2">
                    <a href="{{route('admin.home')}}" class="breadcrumb-item"><i
                            class="fa fa-home2 mr-2"></i> {{__("Home")}}</a>
                    <span class="breadcrumb-item active">{{__("Products")}}</span>
                </div>
                <a href="{{route('admin.home')}}" class="header-elements-toggle text-default d-md-none"><i
                        class="fa fa-more"></i></a>
            </div>
        </div>
        @include('livewire.admin.alert')
    </div>
    <!-- /page header -->

    <div class="content p-2">
        <div class="card">
            <div class="card-header">{{ __("Products") }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("Name")}}: </label>
                            <b>{{$item->name}}</b>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("Price")}}: </label>
                            <b>{{$item->price_string}}</b>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("Code")}}: </label>
                            <b>{{$item->code}}</b>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("Description")}}: </label>
                            <b>{{$item->description}}</b>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("created_at")}}: </label>
                            <b>{{$item->created_at->diffForHumans()}}</b>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">{{__("updated_at")}}: </label>
                            <b>{{$item->updated_at->diffForHumans()}}</b>
                        </div>
                    </div>


                </div>


                <a href="#" data-bs-toggle="modal" data-bs-target="#EditModalProduct" wire:click="EditModal({{$item->id}})"
                   title="{{__("Edit")}}" class="btn btn-info float-right">
                    <i class="fa fa-edit"></i>
                    {{__("Edit")}}
                </a>

            </div>
        </div>
        <div>

            @livewire('admin.products.product-details',[
            [
            'product_id' => $item->id,
            'header' => false,
            'url' => request()->route()->getName()
            ]])
        </div>

        <div>
            @livewire('admin.products.product-images',[
            [

            'product_id' => $item->id,
            'header' => false,
            'url' => request()->route()->getName()

            ]])
        </div>


    </div>

</div>

<!--  Modal -->
<div wire:ignore.self class="modal fade " id="EditModalProduct" tabindex="-1" role="dialog"
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
                        {{__("Loading please wait")}} ...
                    </div>
                </div>
                @if($item->id)
                    @livewire('admin.products.products-edit',[ $item->id ])
                @endif
            </div>
        </div>
    </div>
</div>
<!--  Modal -->

@section('js_code')
    <script>
        $('#EditModal').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
@endsection
