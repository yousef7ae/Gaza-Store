<li class="onhover-dropdown" wire:poll.10000ms>
    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
    <ul class="notification-dropdown onhover-show-div">

        <li>
            <p class="f-w-700 mb-0"> {{__('You have')}} {{\App\Models\User::where('status',0)->count()}} {{__('User')}}<span
                    class="pull-right badge badge-primary badge-pill">{{\App\Models\User::count()}}</span>
            </p>
        </li>

        <li class="noti-primary">
            <div class="media">
                <a href=""{{route('admin.users',['status' => 0])}}""> <span class="notification-bg bg-light-secondary"><i data-feather="check"></i></span> <a/>
                <div class="media-body">

                    <a href="{{route('admin.users',['status' => 0])}}" class="onhover-dropdown">
                        <i class="noti-primary"></i>{{\App\Models\User::where('status',0)->count()}} {{__("Pending Users")}}
                        <span>{{($applicant = \App\Models\User::where('status',0)->orderBy('id','DESC')->first()) ? $applicant->created_at->diffForHumans() : ""}}</span>
                    </a>

                </div>
            </div>
        </li>
        <li class="noti-primary">
            <div class="media">
                <a href=""{{route('admin.users',['status' => 1])}}""> <span class="notification-bg bg-light-success"><i data-feather="alert-triangle"></i></span> <a/>
                <div class="media-body">

                    <a href="{{route('admin.users',['status' => 1])}}" class="onhover-dropdown">
                        <i class="noti-primary"></i>{{\App\Models\User::where('status',1)->count()}} {{__('Approved Users')}}
                        <span>{{($applicant = \App\Models\User::where('status',0)->orderBy('id','DESC')->first()) ? $applicant->created_at->diffForHumans() : ""}}</span>
                    </a>

                </div>
            </div>
        </li>

        <li class="noti-primary">
            <div class="media">
                <a href=""{{route('admin.users',['status' => -1])}}""> <span class="notification-bg bg-light-danger"><i data-feather="alert-circle"></i></span> <a/>
                <div class="media-body">

                    <a href="{{route('admin.users',['status' => -1])}}" class="onhover-dropdown">
                        <i class="noti-primary"></i>{{\App\Models\User::where('status',-1)->count()}} {{__('Decline Users')}}
                        <span>{{($applicant = \App\Models\User::where('status',0)->orderBy('id','DESC')->first()) ? $applicant->created_at->diffForHumans() : ""}}</span>
                    </a>

                </div>
            </div>
        </li>

    </ul>
</li>


