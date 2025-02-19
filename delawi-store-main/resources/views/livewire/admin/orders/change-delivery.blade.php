<div>
    <a class="btn btn-primary btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#ChangeDelivery"
        title="{{ __('Edit') }}"><i class="fa fa-edit"></i> </a>
    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="ChangeDelivery" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Delivery') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form class="mt-2 w-100" method="post" wire:submit.prevent="update">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ __('Delivery') }}</label>
                                <select class="form-control @error('delivery_id') is-invalid @enderror"
                                    wire:model.defer="delivery_id">
                                    <option value="">{{ __('Select Delivery') }}...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('delivery_id')
                                    <span class="invalid-feedback"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{ __('Loading please wait') }} ...
                        </div>
                    </div>

                    <button wire:loading.attr="disabled" class="btn btn-success"
                        type="submit">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
