<input class="d-none" type="file" id="avatar" wire:model="photo"/>
@if($imageTemp)
    <img src="{{ $imageTemp->temporaryUrl() }}" class="rounded-circle border border-primary shadow-sm" width="100" height="100" alt="...">
@else
    <img src="{{auth()->user()->image}}" class="rounded-circle border border-primary shadow-sm" width="100" height="100" alt="...">
@endif
{{--<img class="rounded-circle border border-primary shadow-sm"  width="100" height="100" src="{{asset('fedi/img/person1.jpg')}}" alt="">--}}
<h5 class="mt-3 text-dark fw-bold">{{auth()->user()->name}}</h5>
<p class="text-primary"> {{auth()->user()->country?auth()->user()->country->name : __("Empty")}}
    - {{auth()->user()->city?auth()->user()->city->name : __("Empty")}}
    - {{auth()->user()->address}}
</p>


