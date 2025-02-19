<form class="mt-2 w-100" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label class="control-label">{{__("Products")}}</label>
                <select wire:model.lazy="product_id" class="form-control @error('product_id') is-invalid @enderror"
                        type="text">
                    <option value="">{{__("Select")}}</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
                @error('product_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>


            <div class="form-group">
                <label class="control-label">{{__("Name ProductImages")}}</label>
                <input wire:model.lazy="name" placeholder="{{__("Name ProductImages")}}"
                       class="form-control @error('name') is-invalid @enderror" type="text">
                @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

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


        </div>

        <div class="col-md-6">


        </div>
    </div>
    <button class="btn btn-info" type="submit">{{__("Update")}}</button>
</form>
