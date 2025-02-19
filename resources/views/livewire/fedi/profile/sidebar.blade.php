<ul class="nav flex-column pt-3">
    <li class="nav-item border-bottom py-2 mb-1 {{ Route::currentRouteNamed( 'profile' ) ?  'active' : '' }}">
        <a href="{{route('profile')}}" class="nav-link text-dark text-capitalize mb-0 fw-bold {{request()->is('profile') ? 'font-weight-bold' : ''}}"><i class="far fa-user text-primary me-2"></i>  {{__("Personal Information")}}</a>
    </li>
    <li class="nav-item border-bottom py-2 mb-1 {{ Route::currentRouteNamed( 'profile.orders' ) ?  'active' : '' }}">
        <a href="{{route('profile.orders')}}" class="nav-link text-dark text-capitalize mb-0 fw-bold {{request()->is('profile/orders') ? 'font-weight-bold' : ''}}"><i class="fa-solid fa-bag-shopping text-primary me-2"></i>{{__("Orders")}}</a>
    </li>
    <li class="nav-item border-bottom py-2 mb-1 {{ Route::currentRouteNamed( 'profile.my-points' ) ?  'active' : '' }}">
        <a href="{{route('profile.my-points')}}" class="nav-link text-dark text-capitalize mb-0 fw-bold {{request()->is('profile/my-points') ? 'font-weight-bold' : ''}}"><i class="fas fa-cog text-primary me-2"></i>{{__("My Points")}} </a>
    </li>
    <li class="nav-item border-bottom py-2 mb-1 {{ Route::currentRouteNamed( 'profile.settings' ) ?  'active' : '' }}">
        <a href="{{route('profile.settings')}}" class="nav-link text-dark text-capitalize mb-0 fw-bold {{request()->is('profile/settings') ? 'font-weight-bold' : ''}}"><i class="fas fa-cog text-primary me-2"></i>{{__("Settings")}}</a>
    </li>
    <li class="nav-item py-2 {{ Route::currentRouteNamed( 'admin.logout' ) ?  'active' : '' }}">
        <a href="{{ route('admin.logout') }}" class="nav-link text-dark text-capitalize mb-0 fw-bold" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket text-primary me-2"></i> {{__("Logout")}} </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>

