<div class="bg-light py-1 text-end px-3 px-md-3 px-lg-5">
    <div class="d-flex align-items-center justify-content-end gap-3 py-2">

        <select class="language" id="languageDropdown">
            @foreach($language_global as $language)
                <option value="{{$language->short_name}}">{{strtoupper($language->short_name)}}</option>
            @endforeach
        </select>

        <select class="currency" id="currencyDropdown">
            @foreach($currency_global as $currency)
                <option value="{{$currency->code}}">{{$currency->symbol}} {{$currency->code}}</option>
            @endforeach
        </select>
    </div>
</div>
<header class="header-nav nav-innerpage-style menu-home4 dashboard_header main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
        <div class="container-fluid pr30 pr15-xs pl30 posr menu_bdrt1">
            <div class="row align-items-center justify-content-between">
                <div class="col-6 col-lg-auto">
                    <div class="text-center text-lg-start d-flex align-items-center">
                        <div class="dashboard_header_logo position-relative me-2 me-xl-5">
                            <a href="{{route('/')}}" class="logo"><img src="{{asset('agent/images/header-logo2.svg')}}" alt=""></a>
                        </div>
                        <div class="fz20 ms-2 ms-xl-5">
                            <a href="#" class="dashboard_sidebar_toggle_icon text-thm1 vam"><img src="{{asset('agent/images/dark-nav-icon.svg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-auto">
                    <!-- Responsive Menu Structure-->
                    <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                        <li class="visible_list"> <a class="list-item" href="{{route('/')}}"><span class="title">{{__('user.home')}}</span></a></li>
                        <li class="visible_list"> <a class="list-item" href="{{route('properties')}}"><span class="title">{{__('user.properties')}}</span></a></li>
                        <li class="visible_list"> <a class="list-item" href="{{route('about')}}"><span class="title">{{__('user.about')}}</span></a></li>
                        <li class="visible_list"> <a class="list-item" href="{{route('favorite')}}"><span class="title">{{__('user.Favourites')}}</span></a></li>
{{--                        <li class="visible_list"> <a class="list-item" href="{{route('contact')}}"><span class="title">{{__('user.contact')}}</span></a></li>--}}
{{--                        <li class="visible_list"> <a class="list-item" href="{{route('view_agents')}}"><span class="title">{{__('user.agents')}}</span></a></li>--}}
                        @if(Auth::user())
                            <li class="visible_list"> <a class="list-item" href="#"><span class="title">{{__('user.dashboard')}}</span></a>
                                <ul>
                                    @if(Auth::user()->user_type == 1)
                                    <li><a href="{{route('dashboard')}}">{{__('user.admin dashboard')}}</a></li>
                                    @endif
                                    <li><a href="{{route('agent_dashboard')}}">{{__('user.dashboard')}}</a></li>
                                    <li><a href="{{route('add_property')}}">{{__('user.add new property')}}</a></li>
{{--                                    <li><a href="{{route('messages')}}">{{__('user.messages')}}</a></li>--}}
                                    <li><a href="{{route('notifications')}}">{{__('user.notifications')}}</a></li>
                                    <li><a href="{{route('my_properties')}}">{{__('user.my properties')}}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-6 col-lg-auto">
                    <div class="text-center text-lg-end header_right_widgets">
{{--                        <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">--}}
{{--                            <li class=" user_setting">--}}
{{--                                <div class="dropdown">--}}
{{--                                    <a class="btn mt-2" href="#" data-bs-toggle="dropdown">--}}
{{--                                        <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover" src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png')  }}" alt="">--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu">--}}
{{--                                        <div class="user_setting_content">--}}
{{--                                            <p class="fz15 fw400 ff-heading">{{__('agent.MANAGE ACCOUNT')}}</p>--}}
{{--                                            <a class="dropdown-item" href="{{url('profile')}}">{{__('user.My Profile')}}</a>--}}
{{--                                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>--}}
{{--                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                                @csrf--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">
                            <li class=" user_setting">
                                <div class="dropdown">
                                    <a class="btn mt-2" href="#" data-bs-toggle="dropdown">
                                        <img class="" 
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"
                                        src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png') }}"
                                        alt="">
                                   
                                    </a>
                                    <div class="dropdown-menu mobile_dropdown p-2">
                                        <div class="user_setting_content">
                                            {{--                                                <p class="fz15 fw400 ff-heading">{{__('agent.MANAGE ACCOUNT')}}</p>--}}
                                            <a class="dropdown-item mb-1"
                                               href="{{url('profile')}}">{{__('user.My Profile')}}</a>
                                            <a class="dropdown-item" href="{{route('logout')}}"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Menu In Hiddn SideBar -->
<div class="rightside-hidden-bar">
    <div class="hsidebar-header">
        <div class="sidebar-close-icon"><span class="far fa-times"></span></div>
        <h4 class="title">Welcome to TREMLAK360</h4>
    </div>
    <div class="hsidebar-content">
        <div class="hiddenbar_navbar_content">
            <div class="hiddenbar_navbar_menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Apartments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Bungalow</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Houses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Loft</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Office</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Townhome</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button">Villa</a></li>
                </ul>
            </div>
            <div class="hiddenbar_footer position-relative bdrt1">
                <div class="row pt45 pb30 pl30">
                    <div class="col-auto">
                        <div class="contact-info">
                            <p class="info-title dark-color">Total Free Customer Care</p>
                            <h6 class="info-phone dark-color"><a href="tel:+(0) 123 456 7890">+(0) 123 456 7890</a></h6>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="contact-info">
                            <p class="info-title dark-color">Nee Live Support?</p>
                            <h6 class="info-mail dark-color"><a
                                    href="mailto:youremail@gmail.com">youremail@gmail.com</a></h6>
                        </div>
                    </div>
                </div>
                <div class="row pt30 pb30 bdrt1">
                    <div class="col-auto">
                        <div class="social-style-sidebar d-flex align-items-center pl30">
                            <h6 class="me-4 mb-0">Follow us</h6>
                            <a class="me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Menu In Hiddn SideBar -->
