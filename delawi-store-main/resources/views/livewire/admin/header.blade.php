<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="{{route('admin.home')}}">
                    <img class="img-fluid" style="height: 29px;width: 90px;background: #24695c;padding: 4px;"
                         src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('Dukkan/images/logo-white.svg')}}"
                         alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                                           id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">

        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">

                @livewire('admin.layouts.header-notifications')

                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>


                <li class="onhover-dropdown p-0">

                    <a href="{{ route('admin.logout') }}" class="btn btn-primary-light"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i> {{__("Logout")}} </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
