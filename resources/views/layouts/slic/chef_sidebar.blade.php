<?php
$notifications = DB::table('notifications')
    ->where(['to_user' => Auth::user()->id, 'is_read' => '0'])
    ->count();

$date_now = date("Y-m-d");

$bookings = DB::table('bookings')
    ->join('menus', 'bookings.menu_id', '=', 'menus.id')
    ->where('menus.user_id', Auth::user()->id)
    ->where('bookings.booking_date', ">=", $date_now)
    ->whereIn('bookings.completed', ['confirm-pending'])
    ->select('menus.name', 'bookings.*')
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
                <img alt="profile pic" src="{{asset('public/uploads/profiles')}}/{{Auth::user()->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/img/default-user.png')}}';" />
                @else
                <img width="150" height="150" src="{{asset('public/img/default-user.png')}}" />
                @endif
            </a>
            <h3 class="user-name"><a href="#" class="solid-btn-yellow-h-wl">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a></h3>
        </div>
        <div class="dashboard-menu">
            <ul>
                <li class="{{ (request()->is('chef/profile') || request()->is('chef')) ? 'active' : '' }}"><a href="{{url('/chef/profile')}}" class="account">Profile</a></li>
                <li class="{{ request()->is('chef/menus') ? 'active' : '' }}"><a href="{{route('menus')}}" class="side-menu">Meal</a></li>
                <li class="{{ request()->is('chef/messages') ? 'active' : '' }}"><a href="{{ route('chef-messages') }}" class="messages ">Messages (<span class="umsg">{{$messages}}</span>)</a></li>
                <li class="{{ request()->is('chef/notification') ? 'active' : '' }}"><a href="{{route('chef-notification')}}" class="notification">Notification (<span class="unoti">{{$notifications}}</span>)</a></li>
                <li class="{{ request()->is('chef/requests') ? 'active' : '' }}"><a href="{{ route('chef-requests') }}" class="requests ">Requests ({{$bookings}})</a></li>
                <!--<li class="{{ request()->is('chef/requests') ? 'active' : '' }}"><a  href="{{ route('chef-requests') }}" class="requests ">Requests ({{$bookings}})</a></li>-->
                <li class="{{ request()->is('chef/payment-info') ? 'active' : '' }}"><a href="{{route('payment-info')}}" class="payment">Payment</a></li>
                <li><a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>