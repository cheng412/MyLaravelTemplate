<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{url('/' . $page='index')}}">
            <img src="{{URL::asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Admintro logo">
            <img src="{{URL::asset('assets/images/brand/logo1.png')}}" class="header-brand-img dark-logo" alt="Admintro logo">
            <img src="{{URL::asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Admintro logo">
            <img src="{{URL::asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Admintro logo">
        </a>
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="user-pic">
                <img src="{{ auth()->user()->avatar_url }}" alt="user-img" class="avatar-xl rounded-circle mb-1">
            </div>
            <div class="user-info">
                <h5 class=" mb-1">
                    {{ auth()->user()->fullname }} 
                    <i class="ion-checkmark-circled  text-success fs-12"></i>
                </h5>
                <!-- <span class="text-muted app-sidebar__user-name text-sm">Web Designer</span> -->
            </div>
        </div>
        <div class="sidebar-navs w-50 center-block">
            <ul class="nav nav-pills-circle">
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Edit Profile">
                    <a class="icon" href="{{ route('profile') }}">
                        <i class="fe fe-user header-icons"></i>
                    </a>
                </li>
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Sign Out" onclick="logout()">
                    <a class="icon" href="javascript:void(0)">
                        <i class="fe fe-log-out header-icons"></i>
                    </a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" id="form-logout">
                @csrf
            </form>
        </div>
    </div>
    <ul class="side-menu app-sidebar3">
        <li class="slide mt-4">
            <a class="side-menu__item"  href="{{ route('dashboard') }}">
                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z"/></svg>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="side-item side-item-category">Main</li>
        <li class="slide">
            <a class="side-menu__item @if(Request::is('users*')) active @endif" href="{{ route('users') }}">
                <i class="fe fe-user side-menu__icon"></i>
                <span class="side-menu__label">Users</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item @if(Request::is('groups*')) active @endif" href="{{ route('groups') }}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">Groups</span>
            </a>
        </li>
    </ul>
</aside>
<!--aside closed-->