<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">{{__("Unit")}}</label>
                <input wire:model.lazy="unit" placeholder="{{__("Unit")}}"

                       class="form-control @error('unit') is-invalid @enderror" type="text">
                @error('unit')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">{{__("Value")}}</label>
                <input wire:model.lazy="value" placeholder="{{__("Value")}}"

                       class="form-control @error('value') is-invalid @enderror" type="text">
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <div class="card d-table p-1 m-auto">
                @if($imageTemp)
                    <img width="200" class="img-fluid rounded"
                         src="{{ $imageTemp->temporaryUrl() }}"
                         data-holder-rendered="true">

                @else
                    <img width="200" class="img-fluid rounded"
                         src="{{ $image ? url("storage/".$image) : url('assets/images/image.png')}}"
                         data-holder-rendered="true">
                @endif
            </div>

            <div class="d-table p-1 m-auto uniform-uploader">
                <input type="file" wire:model.lazy="imageTemp"
                       class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                       data-fouc=""
                >
                <span class="filename" style="user-select: none;">{{__("File Image")}}</span>
                <span class="action btn bg-pink-400" style="user-select: none;">{{__("Choose File")}}</span>
                @error('imageTemp')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>


        {{--        <div class="col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <label class="control-label">{{__("Price")}}</label>--}}
{{--                <input wire:model.lazy="price" placeholder="{{__("Price")}}"--}}

{{--                       class="form-control @error('price') is-invalid @enderror" type="text">--}}
{{--                @error('price')--}}
{{--                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--        </div>--}}
    </div>
    <button class="btn btn-info" type="submit">{{__("Store")}}</button>
</form>
