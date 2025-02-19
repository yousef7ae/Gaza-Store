<div class="text-center data-profile">
    <label class="position-relative" for="avatar">
        <i class="fas fa-pencil-alt position-absolute bottom-0 left-0 p-2 btn-sm text-danger"
           style="z-index: 2; bottom: 0"></i>
        <input class="d-none" type="file" id="avatar" wire:model="photo"/>
        @if($imageTemp)
            <img src="{{ $imageTemp->temporaryUrl() }}" class="mr-3 shadow-sm rounded-circle w-100p h-100p" alt="...">
        @else
            <img src="{{auth()->user()->image}}" class="mr-3 shadow-sm rounded-circle w-100p h-100p" alt="...">
        @endif
    </label>

</div>

