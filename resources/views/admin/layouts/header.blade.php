<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('/')}}" class="logo d-flex align-items-center">
            @if($settings->logo !="")
                <img src="{{asset($settings->logo)}}" alt="Logo">
            @else
                <img src="{{asset('admin/assets/img/logo.png')}}" alt="Logo">
            @endif

            <span class="d-none d-lg-block text-dark">{{$settings->site_name}}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                    @if (Auth::user()->image_path!="")
                        <img style="width: 50px; height: 50px; max-height: unset !important;" src="{{asset(Auth::user()->image_path)}}"  class="myImage rounded-circle" alt="Profile">
                    @else
                        <img style="width: 50px; height: 50px; max-height: unset !important;" src="{{asset('admin/assets/img/avatar.png')}}" class="myImage rounded-circle" alt="Profile">
                    @endif

                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile')}}">
                            <i class="bi bi-person"></i>
                            <span>{{__('admin.My Profile')}}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{__('admin.Sign Out')}}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<style>
    .active>.page-link, .page-link.active {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: #000 !important;
        border-color: #000 !important;
    }
    .page-link:focus-visible ,.page-link:focus{
        border: unset !important;
        box-shadow: unset !important;
        outline: unset !important;
    }
</style>
