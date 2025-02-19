<aside class="col-lg-3">
    <ul class="nav flex-column">
        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">
            <a href="{{route('profile')}}"
               class="nav-link text-dark text-capitalize mb-0 {{request()->is('profile') ? 'font-weight-bold' : ''}}"><i
                    class="far fa-user text-secondary mr-2"></i>{{__("Personal Information")}}</a>
        </li>
        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">
            <a href="{{route('profile.orders')}}"
               class="nav-link text-dark text-capitalize mb-0 {{request()->is('profile/orders') ? 'font-weight-bold' : ''}}"><i
                    class="fas fa-layer-group text-secondary mr-2"></i> {{__("Orders")}}</a>
        </li>
        {{--        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">--}}
        {{--            <a href="#" class="nav-link text-dark text-capitalize mb-0"><i class="fas fa-poll text-secondary mr-2 "></i> {{__("Statistics")}}</a>--}}
        {{--        </li>--}}
        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">
            <a href="{{route('profile.my-points')}}"
               class="nav-link text-dark text-capitalize mb-0 {{request()->is('profile/my-points') ? 'font-weight-bold' : ''}}"><i
                    class="fas fa-donate text-secondary mr-2"></i> {{__("My Points")}}</a>
        </li>
        {{--        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">--}}
        {{--            <a href="#" class="nav-link text-dark text-capitalize mb-0"><i class="far fa-comment-dots text-secondary mr-2"></i> {{__("Chat")}}</a>--}}
        {{--        </li>--}}
        <li class="nav-item bg-white py-1 shadow-sm rounded mb-2">
            <a href="{{route('profile.settings')}}"
               class="nav-link text-dark text-capitalize mb-0 {{request()->is('profile/settings') ? 'font-weight-bold' : ''}}"><i
                    class="fas fa-cog text-secondary mr-2"></i> {{__("Settings")}}</a>
        </li>
    </ul>
</aside>
