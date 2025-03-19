<div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
        <div class="header innerpage-style">
            <div class="menu_and_widgets">
                <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
                    <a class="menubar" href="#menu"><img src="{{asset('agent/images/mobile-dark-nav-icon.svg')}}" alt=""></a>
                    <a class="mobile_logo" href="#"><img src="{{asset('agent/images/header-logo2.svg')}}" alt=""></a>
                    <!--                    <a href="login"><span class="icon fz18 far fa-user-circle"></span></a>-->
                    @if(Auth::user())
                        <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">
                            <li class=" user_setting">
                                <div class="dropdown">
                                    <a class="btn p-0 pt-0 h-unset" href="#" data-bs-toggle="dropdown">
                                        <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover" src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png')  }}" alt="">
                                    </a>
                                    <div class="dropdown-menu mobile_dropdown">
                                        <div class="user_setting_content">
                                            <a class="dropdown-item mb-2" href="{{url('profile')}}">{{__('user.My Profile')}}</a>
                                            <a class="dropdown-item" href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @else
                        <div class="d-flex align-items-center">
                            <a class="login-info d-flex align-items-center " href="{{route('login')}}"
                               role="button"><span class=" d-xl-block">{{__('user.Login')}}</span></a>
                            <span class="login-info ">/</span>
                            <a class="login-info d-flex align-items-center" href="{{route('register')}}"
                               role="button"><span class="d-xl-block">{{__('user.Register')}}</span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.mobile-menu -->
    <nav id="menu" class="">
        <ul>
            <li> <a href="{{route('/')}}"><span>{{__('user.home')}}</span></a></li>
            <li> <a href="{{route('properties')}}"><span>{{__('user.properties')}}</span></a></li>
            <li> <a href="{{route('about')}}"><span>{{__('user.about')}}</span></a></li>
            <li><a  href="{{route('favorite')}}"><span>{{__('user.Favourites')}}</span></a></li>
{{--            <li> <a href="{{route('contact')}}"><span>{{__('user.contact')}}</span></a></li>--}}
{{--            <li> <a href="{{route('view_agents')}}"><span>{{__('user.agents')}}</span></a></li>--}}
            @if(Auth::user())
                <li><span class="title">{{__('user.dashboard')}}</span>
                    <ul>
                        @if(Auth::user()->user_type == 1)
                            <li><a href="{{route('dashboard')}}">{{__('user.admin dashboard')}}</a></li>
                        @endif
                        <li><a href="{{route('dashboard')}}">{{__('user.dashboard')}}</a></li>
                        <li><a href="{{route('add_property')}}">{{__('user.add new property')}}</a></li>
{{--                        <li><a href="{{route('messages')}}">{{__('user.messages')}}</a></li>--}}
                        <li><a href="{{route('notifications')}}">{{__('user.notifications')}}</a></li>
                        <li><a href="{{route('my_properties')}}">{{__('user.my properties')}}</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>
