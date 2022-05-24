<?php
$notifications = DB::table('notifications')
    ->where(['to_user' => Auth::user()->id, 'is_read' => '0'])
    ->count();

$messages = DB::table('messages')
    ->where(['receiver' => Auth::user()->id, 'is_read' => '0'])
    ->count();
?>
<div class="col-md-4 col-lg-3 left-section">
    <div class="left-section-inner">
        <div class="profile-img">
            <a href="#">
				@if(Auth::user()->profile_pic)
					<img alt="profile pic" src="{{asset('public/uploads/profiles')}}/{{Auth::user()->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/img/default-user.png')}}';"  />
				@else
					<img alt="profile pic" width="150" height="150" src="{{asset('public/img/default-user.png')}}"/>
				@endif
            </a>
            <h3 class="user-name"><a class="solid-btn-yellow-h-wl" href="#">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a></h3>
        </div>
        <div class="dashboard-menu">
            <ul>
                <li class="{{ (request()->is('user/profile') || request()->is('user')) ? 'active' : '' }}"><a href="{{url(Auth::user()->user_type)}}" class="account">Profile</a></li>

                <li class="{{ request()->is('user/notification') ? 'active' : '' }}"><a href="{{route('user-notification')}}" class="notification">Notification (<span class="unoti">{{$notifications}}</span>)</a></li>
                <li class="{{ request()->is('user/favorites') ? 'active' : '' }}"><a href="{{route('user-favorites')}}" class="favorite">Favorite</a></li>
                <li class="{{ request()->is('user/messages') ? 'active' : '' }}"><a href="{{route('user-messages')}}" class="messages">Messages (<span class="umsg">{{$messages}}</span>)</a></li>
                <li class="{{ request()->is('user/requests') ? 'active' : '' }}"><a href="{{ route('user-requests') }}" class="requests">Requests</a></li>
               
                <li><a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form></li>
            </ul>
        </div>
    </div>
</div>